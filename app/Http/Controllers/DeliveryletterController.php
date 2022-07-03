<?php

namespace App\Http\Controllers;

use App\Models\Deliveryletter;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DeliveryletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        // dd($request);
        $data = [
            'violation_id' => $request->violation_id,
            'user_id' => $request->user_id,
            'date_delivery' => $request->date_delivery,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DB::table('deliveryletters')->insert($data);

        return redirect('/hiviolations')->with('success','Penyampaian berhasil di tambahkan ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deliveryletter  $deliveryletter
     * @return \Illuminate\Http\Response
     */
    public function show(Deliveryletter $deliveryletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deliveryletter  $deliveryletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Deliveryletter $deliveryletter)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deliveryletter  $deliveryletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deliveryletter $deliveryletter)
    {
        //
        // dd($request);
        $data = [
            'user_id' => $request->user_id,
            'date_delivery' => $request->datedeliveryedit,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DB::table('deliveryletters')->where('id',  $request->id)->update($data);

        return redirect('/hiviolations')->with('success', 'Penyampaian berhasil di update! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deliveryletter  $deliveryletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deliveryletter $deliveryletter)
    {
        //
    }
}
