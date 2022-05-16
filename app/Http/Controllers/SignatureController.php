<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use App\Models\Signature;
use App\Models\Employee;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // echo 'signatures';
        return view('hi.signatures.index', [
            
            
            'signatures' => DB::table('signatures')->get(),
            'employees' => DB::table('employees')->get(),
            'count' => DB::table('signatures')->count()        
        ]);
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

        DB::table('signatures')->insert([
            'name'=> $request->name,
            'department'=> $request->department, 
            'part'=> $request->part,
            'employee_id'=> $request->employee_id
            ]);

        return redirect('/signatures/')->with('success', 'Data Ayat berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Signature $signature)
    {
        
        // $type_of_verse = ["Peringatan Lisan","Surat Peringatan 1","Surat Peringatan 2","Surat Peringatan 3","Surat Peringatan Terakhir","PHK Pesangon","PHK Tanpa Peesangon"];
        return view('hi.signatures.edit', [
            'status' => ['active', 'notactive'],
            'signature' => $signature
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        if($request->status_signature == 'active'){
            DB::table('signatures')
                ->where('id', $request->id)
                ->update([
                    'employee_id'=> $request->employee_id,
                    'name'=> $request->name,
                    'department'=> $request->department, 
                    'part'=> $request->part,
                    'status_signature'=> $request->status_signature,
                    'employee_id'=> $request->employee_id
                ]);

            
            DB::table('signatures')
                ->where('id', '!=', $request->id)
                ->update([
                    'status_signature'=> 'notactive',
                ]);
        }else{
            DB::table('signatures')
                ->where('id', $request->id)
                ->update([
                    'employee_id'=> $request->employee_id,
                    'name'=> $request->name,
                    'department'=> $request->department, 
                    'part'=> $request->part,
                    'status_signature'=> $request->status_signature,
                    'employee_id'=> $request->employee_id
                ]);
        }

            return redirect('/signatures/')->with('success', 'Data signature berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_signature_employee(){


        $employee = DB::table('employees')->get();

        $data = $employee;

        return response()->json($data);
    }


    public function get_signature(Request $request){

        $signature_employee = $request->signature_employee;

        $employee = DB::table('employees')->find($signature_employee);

        $department = DB::table('departments')->find($employee->department_id);

        $data = [$employee->name,  $department->department,  $employee->bagian];

        return response()->json($data);
    }
}
