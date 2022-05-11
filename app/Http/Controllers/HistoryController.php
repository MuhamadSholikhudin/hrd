<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    //

    public function index()
    {
        // echo 'oke';

        // $histories = DB::table('histories')->get();

        return view('histories.index', [
            'histories' => DB::table('histories')->paginate(10),
            'count' => DB::table('histories')->count()
             
        ]);

    }

    public function histories_view(Request $request)
    {
        $id = $request->id;

        // $sel_histories = DB::table('histories')
        //     ->where('id', $id )
        //     ->first();

        // $data = [$sel_histories->created_at, $sel_histories->action, $sel_histories->remark,  $sel_histories->user_id,  $sel_histories->role_id];

        // return response()->json($data);

    }
}
