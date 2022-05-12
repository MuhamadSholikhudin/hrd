<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    //

    public function index(){
        return view('login.index'
        // , [
            // 'title' => "Login",
            // 'active' => "login"
            // ]
        );
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        // $cek_login = DB::table("users")
        //     ->where('email', $request->email)
        //     ->where('password', $request->password)
        //     ->count();
        // if($cek_login > 0){
        //     $value = $request->session()->get('key');
        //     return redirect()->intended('datamaster/employees');
        // }
 
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password, 'is_active' => 1])) {
            // Authentication was successful...
            $request->session()->regenerate();
            return redirect()->intended('dashboards ');
            
        }

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
 
        //     return redirect()->intended('datamaster/employees ');
        // }

        // dd($oke);
 
        return back()->with(
            'loginError' , 'Username atau password anda salah.',
        );

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
