<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function halaman(){
        return view("login");
    }
    function login1(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required'  => 'Email wajib diisi',
            'password.required'  => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' =>  $request->email,
            'password' =>  $request->password,
        ];

        if(Auth::attempt($infologin)){
            return redirect('/index1');
        }else{
            return redirect('')->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }
    //methode menangani username/email untuk login
    public function login(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        // Cek apakah input adalah email atau username
        $loginType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Otentikasi user berdasarkan email atau username
        if (Auth::attempt([$loginType => $login, 'password' => $password], $request->filled('remember'))) {
            return redirect()->intended('dashboard'); // Arahkan ke dashboard setelah login berhasil
        }

        return back()->withErrors([
            'login' => 'Login gagal. Silakan periksa email/username dan password Anda.',
        ]);
    }
      // Method untuk menangani logout
      public function logout(Request $request)
      {
          Auth::logout();
          
          // Regenerate session untuk keamanan
          $request->session()->invalidate();
          $request->session()->regenerateToken();
          
          // Redirect ke halaman login atau halaman lain yang diinginkan
          return redirect('/');
      }
}