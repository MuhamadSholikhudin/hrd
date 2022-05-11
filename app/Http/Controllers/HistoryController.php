<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

  

class HistoryController extends Controller
{
    //

    public function index()
    {
        // echo 'oke';

        // $histories = DB::table('histories')->get();
        // $m_histories = DB::table('histories') ->limit(5)->get();

        return view('histories.index', [
            
            
            'histories' => DB::table('histories')->paginate(10),
            'count' => DB::table('histories')->count()
            
             
        ]);

    }

    public function histories_view(Request $request)
    {
        $id = $request->id;

        $sel_histories = DB::table('histories')
            ->where('id', $id )
            ->first();

        $user = DB::table('users')->where('id', $sel_histories->user_id)->first();
        $role = DB::table('roles')->where('id', $sel_histories->role_id)->first();
        $data = [$sel_histories->created_at, $sel_histories->action, $sel_histories->remark,  $user->name,  $role->role];

        return response()->json($data);

    }
}
