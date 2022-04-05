<?php

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Demotion;
use Illuminate\Contracts\View\View;

class DemotionsExport implements FromView
{
    public function view(): View
    {
        $demotions = DB::table('demotions')
            ->leftJoin('jobs', 'demotions.job_id', '=', 'jobs.id')
            ->leftJoin('departments', 'demotions.department_id', '=', 'departments.id')
            ->leftJoin('employees', 'demotions.employee_id', '=', 'employees.id');
        // ->get();
        return view('exports.demotions.index', [
            // 'demotions' => $demotions
            'demotions' => Demotion::all()
        ]);
    }
}
