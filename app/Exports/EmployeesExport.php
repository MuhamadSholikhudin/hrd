<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// class EmployeesExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Employee::all();
//     }
// }

class EmployeesExport implements FromView
{
    public function view(): View
    {
        return view('exports.employees.employees', [
            'employees' => Employee::all()
        ]);
    }

    

}