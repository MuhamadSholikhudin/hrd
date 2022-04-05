<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Mutation;

class MutationsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $mutations = DB::table('mutations')
            ->leftJoin('jobs', 'mutations.job_id', '=', 'jobs.id')
            ->leftJoin('departments', 'mutations.department_id', '=', 'departments.id')
            ->leftJoin('employees', 'mutations.employee_id', '=', 'employees.id');
        // ->get();
        return view('exports.mutations.index', [
            // 'mutations' => $mutations
            'mutations' => mutation::all()
        ]);
    }
}
