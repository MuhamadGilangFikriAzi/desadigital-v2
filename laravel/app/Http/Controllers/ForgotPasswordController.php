<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    // Step 1: Show form request NIK + No WA
    public function showRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Step 2: Verify NIK + No WA, generate token
    public function sendToken(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:20',
            'no_wa' => 'required|string|max:20',
        ]);

        $user = User::where('nik', $request->nik)
            ->where('no_wa', $request->no_wa)
            ->first();

        if (!$user) {
            return back()->withErrors(['nik' => 'NIK atau No. WA tidak cocok dengan data kami.']);
        }

        // Generate 6-digit token
        $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Simpan ke database
        PasswordReset::create([
            'nik' => $request->nik,
            'no_wa' => $request->no_wa,
            'token' => $token,
            'expires_at' => Carbon::now()->addMinutes(15),
        ]);

        // Kirim WA via Fonnte
        $this->sendWhatsApp($user->no_wa, $token);

        // Simpan nik di session buat verifikasi token
        session(['reset_nik' => $request->nik]);

        return redirect()->route('password.verify')
            ->with('success', 'Kode OTP telah dikirim ke WhatsApp Anda.');
    }

    // Step 3: Show form verify token
    public function showVerifyForm()
    {
        if (!session('reset_nik')) {
            return redirect()->route('password.request');
        }
        return view('auth.verify-token');
    }

    // Step 4: Verify token
    public function verifyToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string|size:6',
        ]);

        $nik = session('reset_nik');
        if (!$nik) {
            return redirect()->route('password.request');
        }

        $reset = PasswordReset::where('nik', $nik)
            ->where('token', $request->token)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if (!$reset) {
            return back()->withErrors(['token' => 'Kode OTP tidak valid atau sudah kadaluwarsa.']);
        }

        // Tandai token sudah dipakai
        $reset->update(['used' => true]);

        session(['reset_verified' => true]);

        return redirect()->route('password.reset');
    }

    // Step 5: Show reset password form
    public function showResetForm()
    {
        if (!session('reset_verified')) {
            return redirect()->route('password.request');
        }
        return view('auth.reset-password');
    }

    // Step 6: Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $nik = session('reset_nik');
        if (!$nik || !session('reset_verified')) {
            return redirect()->route('password.request');
        }

        $user = User::where('nik', $nik)->first();
        if (!$user) {
            return redirect()->route('password.request');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Bersihkan session
        session()->forget(['reset_nik', 'reset_verified']);

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login.');
    }

    // Send WhatsApp via Fonnte
    private function sendWhatsApp($noWa, $token)
    {
        $apiKey = env('FONNTE_API_KEY', '');

        // Coba kirim via cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.fonnte.com/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'target' => $noWa,
            'message' => "🔐 *Reset Password - Desa Digital*\n\nKode OTP Anda:\n*{$token}*\n\nKode berlaku selama 15 menit. Jangan bagikan kode ini kepada siapa pun.\n\nAbaikan pesan ini jika Anda tidak meminta reset password.",
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: ' . $apiKey,
        ]);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
