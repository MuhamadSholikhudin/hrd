<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use Carbon\Carbon;

class HistoryController extends Controller
{
    //

    public function index()
    {

        if(auth()->user()->role_id == 1){
            $histories = DB::table('histories')->oldest();
        
        }else{
            $histories = DB::table('histories')->where('role_id', auth()->user()->role_id)->oldest();
        }

        if(request('search')){
            if(auth()->user()->role_id == 1){
                $histories->where('remark', 'like', '%' . request('search') . '%')
                //   ->orWhere('created_at', 'like', '%' . request('search') . '%')
                  ->orWhere('created_at', 'like', '%' . request('search') . '%');
            }else{
                $histories->where('remark', 'like', '%' . request('search') . '%')
                  ->orWhere('role_id', 'like', '%' . auth()->user()->role_id . '%')
                  ->orWhere('created_at', 'like', '%' . request('search') . '%');
            }
        }

        return view('histories.index', [
            'histories' => $histories->paginate(10)->withQuerystring(),
            'count' => $histories->count()
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
