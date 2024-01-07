<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            Alert::success('Login Berhasil');

            return redirect()->intended('/');
        }

        Alert::error('Login Gagal', 'Alamat email atau kata sandi salah');

        return back()->withInput();
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $user = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|numeric',
            'address' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user['password'] = Hash::make($user['password']);

        DB::beginTransaction();
        try {
            $newUser = new User();
            $newUser->fill($user);
            $newUser->save();
            DB::commit();


            auth()->login($newUser);

            Alert::success('Registrasi Berhasil');

            return redirect()->intended('/');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Registrasi Gagal', 'Terjadi kesalahan saat menyimpan data');

            return back()->withInput();
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::success('Logout Berhasil');

        return redirect()->route('login');
    }
}
