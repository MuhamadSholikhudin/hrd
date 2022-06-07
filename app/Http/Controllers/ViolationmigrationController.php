<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;
use App\Models\Alphabet;
use App\Models\Article;
use App\Models\Paragraph;
use App\Models\Violation;
use App\Models\Violationmigration;

class ViolationmigrationController extends Controller
{
    //
    public function index()
    {
        //
        // $violations = Violation::oldest();
        $violationmigrations = DB::table('violationmigrations')
            ->leftJoin('employees', 'employees.id', '=', 'violationmigrations.employee_id')
            ->select('violationmigrations.*', 'violationmigrations.id as id',
            'violationmigrations.date_of_violation as date_of_violation',
            'violationmigrations.no_violation as no_violation',
            'violationmigrations.violation_ROM as violation_ROM',
            'violationmigrations.date_end_violation as date_end_violation',
            'violationmigrations.type_of_violation as type_of_violation',
            'violationmigrations.alphabet_id as alphabet_id',
            'violationmigrations.other_information as other_information',
            'violationmigrations.violation_status as violation_status',
            'employees.name as name',
            'employees.number_of_employees as number_of_employees'
            )->orderByDesc('violationmigrations.id');

    if(request('search')){
        $violations->where('date_end_violation', 'like', '%' . request('search') . '%')
            ->orWhere('date_of_violation', 'like', '%' . request('search') . '%')
            ->orWhere('name', 'like', '%' . request('search') . '%')
            ->orWhere('number_of_employees', 'like', '%' . request('search') . '%')
            ->orWhere('other_information', 'like', '%' . request('search') . '%');
    }
    return view('hi.violationmigrations.index', [
        'violationmigrations' => $violationmigrations->paginate(10),
        'count' => DB::table('violationmigrations')->count()
        ]);
    }

    public function show($id)
    {
        $violation = DB::table('violationmigrations')->where('id', $id)
                    ->first();

        return view('hi.violationmigrations.cetak_sp', [
            
            
            'violation' => $violation
        ]);
    }
}
