<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\ToArray;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;


use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

  
class UserController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
        $users = User::get();
  
        return view('users', compact('users'));
    }

    public function list()
    {
        $users = User::get();
  
        if(request('search')){
            $users->where('email', 'like', '%' . request('search') . '%')
                 ->orWhere('name', 'like', '%' . request('search') . '%');
        }

        return view('users.list', [
            'users' => $users,
            'count' => User::count()
        ]);
    }

    public function create()
    {
        $users = User::get();
        
        $is_active = ["active" => 1, "Not active" =>0];
        $roles = DB::table('roles')->get();
        return view('users.create', [
            
            
            'roles' => $roles,
            'is_active' => $is_active,
            'count' => User::count()
        ]);
    }

    public function store(Request $request)
    {
        DB::table('users')->insert([ 
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "role_id" => $request->role_id,
            "is_active" => $request->is_active,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
            ]);

        return redirect('/users');
    }


    public function edit($id)
    {
        $user = User::find($id);

        $is_active = ["active" => 1, "Not active" =>0];
        $roles = DB::table('roles')->get();
        return view('users.edit', [
            
            
            'user' => $user,
            'roles' => $roles,
            'is_active' => $is_active,
            'count' => User::count()
        ]);
    }

    public function update(Request $request)
    {
        DB::table('users')
        ->where('id', $request->id)
        ->update([ 
            "name" => $request->name,
            "email" => $request->email,
            "role_id" => $request->role_id,
            "is_active" => $request->is_active,
            'updated_at' => date('Y-m-d H:i:s')
            ]);

            return redirect('/users');
    }

    public function password($id)
    {
        $user = User::find($id);

        return view('users.changepassword', [
            'user' => $user,
        ]);
    }

    public function changepassword(Request $request)
    {
        DB::table('users')
        ->where('id', $request->id)
        ->update([ 
            "password" => bcrypt($request->password),
            'updated_at' => date('Y-m-d H:i:s')
            ]);

            return redirect('/users');
    }

        
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        // Excel::import(UsersImport, request()->file('file'));
        $rows =  Excel::toArray(new UsersImport, request()->file('file'));
        
        // dd($rows);
        foreach($rows as $row):
            foreach($row as $x):
                DB::table('users')->insert([
                    'name' => $x['name'],
                    'email' =>  $x['email'],
                    'password' => $x['password']
                ]);
                $employee_get = DB::table('users')->where('name', '=', $x['name'])->first();
                
                DB::table('salaries')->insert([
                    'employee_id' => 1,
                    'basic_salary' => $employee_get->id,
                    'positional_allowance' => 3,
                    'transportation_allowance' => 4,
                    'attendance_allowance' => 5,
                    'grade_salary' => 3,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'total_salary' => 0
                ]);

            endforeach;
        endforeach;

        return back();
        redirect('/users');
    }
}
