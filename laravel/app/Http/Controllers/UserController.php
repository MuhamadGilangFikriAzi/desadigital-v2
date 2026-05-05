<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Spatie\Permission\Models\Role;
use GuzzleHttp\Client;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = User::query();
        $filter = [
            'name' => '',
            'created_at' => '',
        ];

        if ($request->name) {
            $list = $list->where('name', 'like', '%' . $request->name . '%');
            $filter['name'] = $request->id;
        }

        if ($request->created_at) {
            $list = $list->whereDate('created_at', $request->created_at);
            $filter['created_at'] = $request->created_at;
        }
        $data = $list->count();

        $list = $list->orderBy('created_at', 'DESC')->paginate('10');

        return view('user.list', compact('list', 'data', 'filter'));
    }

    public function getDataUserByID(Request $request)
    {
        // dd($request);
        $data = User::find($request->id);
        return response()->json(['data' => [
            'data' => $data,
            'role' => $data->roles->pluck('name')[0],
        ]]);
    }

    public function giveUserRole(Request $request)
    {
        $data = User::find($request->id);

        $message = "Halo, *{$data->name}* 👋\n\n";
        $message .= "Data Anda telah berhasil *diverifikasi* oleh staf Desa Telagamurni ✅.\n\n";
        $message .= "Anda sekarang dapat mengakses layanan online desa melalui website resmi:\n";
        $message .= "🌐 https://telagamurni.desaapp.id\n\n";
        $message .= "Terima kasih telah menggunakan layanan digital Desa Telagamurni.\n";
        $message .= "Untuk bantuan lebih lanjut, silakan hubungi staf kami melalui website atau datang langsung ke kantor desa.\n\n";
        $message .= "Salam hangat,\n👩‍💼 Pemerintah Desa Telagamurni";

        $data->roles()->detach();
        $data->assignRole($request->role);
        // dd($data->no_wa);
        $resp = $this->sendWhatsapp($data->no_wa, $message);
        dd($resp);
        return response()->json(['data' => "Success"]);
    }

    public function rejectUser(Request $request)
    {
        $data = User::find($request->id);
        $data->note_reject = $request->reason;
        $data->rejected_at = date('Y-m-d H:i:s');
        $data->update();

        $message = "Halo, *{$data->name}* 👋\n\n";
        $message .= "Mohon maaf, data Anda *belum dapat diverifikasi* oleh staf Desa Telagamurni ❌.\n\n";
        $message .= "*Alasan penolakan:*\n";
        $message .= "{$request->reason}\n\n";
        $message .= "Silakan periksa kembali kelengkapan dan kevalidan dokumen yang Anda kirimkan.\n";
        $message .= "Anda dapat mengunggah ulang atau memperbarui data Anda melalui website resmi:\n";
        $message .= "🌐 https://telagamurni.desaapp.id\n\n";
        $message .= "Jika Anda memerlukan bantuan, jangan ragu untuk menghubungi staf kami melalui website atau datang langsung ke kantor desa.\n\n";
        $message .= "Terima kasih atas partisipasi Anda dalam layanan digital Desa Telagamurni.\n\n";
        $message .= "Salam hormat,\n👩‍💼 Pemerintah Desa Telagamurni";

        $resp = $this->sendWhatsapp($data->no_wa, $message);
        // dd($resp);
        return response()->json(['data' => "Success"]);
    }

    public function edit(User $id)
    {
        $data = Auth::user();
        $listAgama = ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Budha', 'Konghucu'];
        $listJenisKelamin = ['Laki-laki', 'Perempuann'];
        $role = Auth::user()->roles->pluck('name')[0];
        // dd($data);
        return view('user.edit_profile', compact('data', 'role', 'listAgama', 'listJenisKelamin'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $data = $request->except('_token', 'submit', 'password', 'repassword', 'ktp');

        $fileKtp = $request->file('ktp');
        if ($request->hasfile('ktp')) {
            $path = public_path('/img/ktp/');

            $originalImage = $fileKtp;
            $Image = Image::make($originalImage);
            $Image->resize(540, 360);
            $fileName = $data['nik'] . "-ktp-." . $originalImage->getClientOriginalExtension();
            if (!file_exists($path)) {
                mkdir($path, 666, true);
            }
            $Image->save($path . $fileName);
            $data['ktp'] = $fileName;
        }

        if ($request->password != null) {
            $data['password'] = bcrypt($request->password);
        }

        $data['rejected_at'] = null;

        // dd($data);
        $user = User::find($id)->update($data);

        return redirect('/surat');
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->rejected_at = null;
        $user->save();
        
        // Assign role User when approved
        $user->roles()->detach();
        $user->assignRole('User');
        
        return redirect()->back()->with('success', 'User berhasil di-approve!');
    }

    public function sendWhatsapp($target, $message)
    {
        $client = new Client();

        $baseUrl = 'https://api.fonnte.com/send'; // env('FONNTE_BASE_URL', 'https://api.fonnte.com/send');
        $token = 'G6M7b8KR3jcFmLKeF5VQ'; //env('FONNTE_BASE_URL', 'G6M7b8KR3jcFmLKeF5VQ');
        $countryCode = '62'; //env('FONNTE_BASE_URL', '62');

        try {
            $response = $client->request('POST', $baseUrl, [
                'headers' => [
                    'Authorization' => $token,
                ],
                'form_params' => [
                    'target' => $target,
                    'message' => $message,
                    'countryCode' => $countryCode,
                ],
                'verify' => false // <--- This disables SSL verification (use only for local testing)
            ]);
            // dd($response);
            $result = json_decode($response->getBody(), true);
            // dd($result);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        if (Surat::where('user_id', $id)->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak bisa menghapus user ini karna sudah pernah membuat surat'
            ], 422);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan.'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil dihapus.'
        ], 200);
    }
}
