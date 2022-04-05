<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Promotion;
use Illuminate\Contracts\View\View;

class PromotionsExport implements FromView
{
    public function view(): View
    {
        $promotions = DB::table('promotions')
            ->leftJoin('jobs', 'promotions.job_id', '=', 'jobs.id')
            ->leftJoin('departments', 'promotions.department_id', '=', 'departments.id')
            ->leftJoin('employees', 'promotions.employee_id', '=', 'employees.id');
        // ->get();
        return view('exports.promotions.index', [
            // 'promotions' => $promotions
            'promotions' => Promotion::all()
        ]);
    }
}
