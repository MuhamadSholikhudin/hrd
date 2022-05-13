<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ViolationsImport;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use App\Models\Alphabet;
use App\Models\Article;
use App\Models\Paragraph;
use App\Models\Violation;

class HiViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('hi.violations.list', [
            'violations' => Violation::all()->paginate(10),
            'count' => DB::table('employees')->count()
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
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Violation $violation)
    public function destroy(Request $requset) 
    {
            // Violation::destroy($violation->id);
        DB::table('violations')->where('id', $requset->id)->delete();
        return redirect('violations/list');
    }
    public function hapus(Request $requset) 
    {
            // Violation::destroy($violation->id);
        DB::table('violations')->where('id', $requset->id)->delete();
        return redirect('violations/list');
    }

    public function import() 
    {
        $rows =  Excel::toArray(new ViolationsImport, request()->file('file'));

        foreach($rows as $row):
            foreach($row as $x):
                //Memastikan tidak ada nilai null NIK
              
            endforeach;
        endforeach;
        return redirect('/violations/list');

    }
}
