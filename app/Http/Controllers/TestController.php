<?php

namespace App\Http\Controllers;

use App\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class TestController extends Controller
{
    //
    public function test()
    {
        $violationmigrations = DB::table('violationmigrations')
            ->select(
                'violations.id as id',
                'violations.date_of_violation as date_of_violation',
                'violations.no_violation as no_violation',
                'violations.violation_ROM as violation_ROM',
                'violations.date_end_violation as date_end_violation',
                'violations.type_of_violation as type_of_violation',
                'violations.alphabet_id as alphabet_id',
                'violations.other_information as other_information',
                'violations.violation_status as violation_status',
                'employees.name as name',
                'employees.number_of_employees as number_of_employees'
            )
            ->orderByDesc('violations.id');

        $violations = DB::table('violations')
            ->leftJoin(
                'employees',
                'employees.id',
                '=',
                'violations.employee_id'
            )
            ->select(
                'violations.*',
                'violations.id as id',
                'violations.date_of_violation as date_of_violation',
                'violations.no_violation as no_violation',
                'violations.violation_ROM as violation_ROM',
                'violations.date_end_violation as date_end_violation',
                'violations.type_of_violation as type_of_violation',
                'violations.alphabet_id as alphabet_id',
                'violations.other_information as other_information',
                'violations.violation_status as violation_status',
                'employees.name as name',
                'employees.number_of_employees as number_of_employees'
            )
            ->orderByDesc('violations.id');
        //  ->orderByDesc('violations.no_violation')

        // the array
        $the_array = [
            ['id' => 1, 'title' => 'Post 1'],
            ['id' => 2, 'title' => 'Post 2'],
            ['id' => 3, 'title' => 'Post 3'],
            ['id' => 4, 'title' => 'Post 4'],
            ['id' => 5, 'title' => 'Post 5'],
            ['id' => 6, 'title' => 'Post 6'],
            ['id' => 7, 'title' => 'Post 7'],
            ['id' => 8, 'title' => 'Post 8'],
            ['id' => 9, 'title' => 'Post 9'],
            ['id' => 10, 'title' => 'Post 10'],
        ];

        // convert array to collection with pagination
        $per_page = 2;
        $results = (new Collection($the_array))
            ->paginate($per_page)
            ->withQuerystring();

        return view('test.index', [
            'results' => $results,
        ]);

        // dd($results);
    }

    public function migrasi()
    {
        $violations = DB::table('violationmigrations')
            ->select(
                'id as id',
                'employee_id as employee_id',
                'reporting_date as reporting_date',
                'date_of_violation as date_of_violation',
                'date_end_violation as date_end_violation',
                'no_violation as no_violation',
                'violation_rom as violation_ROM',
                'type_of_violation as type_of_violation',
                'pasal_yang_dilanggar as alphabet_id',
                'pasal_yang_dilanggar as alphabet_accumulation',
                'keterangan_lain as other_information',
                'violation_status as violation_status',
                'name as name',
                'number_of_employees as number_of_employees'
            )
            ->orderByDesc('id');

        if (request('search')) {
            $violations
                ->where(
                    'date_end_violation',
                    'like',
                    '%' . request('search') . '%'
                )
                ->orWhere(
                    'date_of_violation',
                    'like',
                    '%' . request('search') . '%'
                )
                ->orWhere('name', 'like', '%' . request('search') . '%')
                ->orWhere(
                    'number_of_employees',
                    'like',
                    '%' . request('search') . '%'
                )
                ->orWhere(
                    'violation_status',
                    'like',
                    '%' . request('search') . '%'
                )
                ->orWhere('no_violation', 'like', '%' . request('search') . '%')
                ->orWhere(
                    'keterangan_lain',
                    'like',
                    '%' . request('search') . '%'
                );
        }

        // if(){
        //     $users = DB::table('users')->get();
        // }else{
        //     $users = DB::table('users')->get();
        // }
        $users = DB::table('users')
            ->where('role_id', auth()->user()->role_id)
            ->get();

        return view('hi.violations.listmigrations', [
            'violations' => $violations->paginate(10)->withQuerystring(),
            'users' => $users,
            'count' => DB::table('violationmigrations')->count(),
        ]);
    }
}
