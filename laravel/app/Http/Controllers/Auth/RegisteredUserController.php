<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nik' => ['required', 'string', 'min:16', 'max:16', 'unique:' . User::class . ',nik'],
            'name' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'ktp' => 'required|file|mimes:jpeg,jpg|max:2048',
            'no_wa' => 'required|string|max:16',
        ]);

        $ktpPath = null;
        if ($request->hasFile('ktp')) {
            $ktp = $request->file('ktp');
            $filename = $request->nik . '-ktp.' . $ktp->getClientOriginalExtension();
            $ktp->move(public_path('img/ktp'), $filename);
            $ktpPath = $filename;
        }

        $user = User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->nik . '@desadigital.app',
            'password' => Hash::make($request->password),
            'ktp' => $ktpPath,
            'no_wa' => $request->no_wa,
        ]);

        $user->assignRole('Guest');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
