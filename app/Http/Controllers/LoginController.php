<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;


class LoginController extends Controller
{
    //

    public function index(){
        Auth::logout();
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

            $tanggal_hari_ini = date('Y-m-d');// pendefinisian tanggal awal

            $countdown_date1 = date('Y-m-d', strtotime('-93 days', strtotime($tanggal_hari_ini))); //operasi penjumlahan tanggal sebanyak 6 hari
          
            $countdown_date2 = date('Y-m-d', strtotime('-120 days', strtotime($tanggal_hari_ini))); //operasi penjumlahan tanggal sebanyak 6 hari
   
            $cari_status_violation = DB::table('violations')
            ->where('date_end_violation', '<', $tanggal_hari_ini)
            ->get(); 

            foreach($cari_status_violation as $sta_vio):
                DB::table('violations')
                    ->where('id',  $sta_vio->id)
                    ->update([
                        'violation_status' => 'notactive'
                    ]);
            endforeach;

           //tampilkan data hire_date
           DB::table('employees')
               ->where('date_out', null)
               ->where('exit_statement', null)
               ->where('hire_date', '>=', $countdown_date2)
               ->where('hire_date', '<=', $countdown_date1)
               ->where('employee_type', 'Probation')
               ->update([
                   'employee_type' => 'Permanent'
           ]);

            $request->session()->regenerate();
            return redirect()->intended('dashboards');
            
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
