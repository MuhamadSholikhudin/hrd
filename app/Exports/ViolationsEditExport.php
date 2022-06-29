<?php

namespace App\Exports;

use App\Models\Violation;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromView;


use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class ViolationsEditExport implements FromQuery, WithHeadings, WithColumnFormatting, WithMapping
{
    use Exportable;

    public function __construct($request)
    {
        $this->awal = $request->awal;
        $this->akhir = $request->akhir;
    }

    public function query()
    {
        $violations = Violation::query()
            ->join('employees', 'violations.employee_id', '=', 'employees.id')
            ->whereBetween('violations.id', [$this->awal, $this->akhir])
            ->select('violations.id', 'employees.number_of_employees', 'violations.reporting_date', 'violations.date_of_violation', 'violations.other_information', 'violations.alphabet_id')
            ;
        return $violations;

        //     $violation = Violation::query()
        //     ->whereBetween('id', [$this->awal, $this->akhir]);

        // return view('exports.violations.index', [
        //     'violations' => $violation
        // ]);
    }

    public function map($violations): array
    {
        return [
            $violations->id,
            $violations->number_of_employees,
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($violations->reporting_date),
            \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($violations->date_of_violation),
            // DATE_FORMAT($violations->date_of_violation, '%m/%d/%Y' ),
            // Date::dateTimeToExcelDDMMYYYY($violations->date_of_violation),
            $violations->other_information,
            $violations->alphabet_id
        ];
    }
    
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function headings(): array
    {
        return [
            'id', 'number_of_employees', 'reporting_date', 'date_of_violation', 'other_information', 'alphabet_id'
		];
	}

    // public function view(): View
    // {
    //     $violation = Violation::query()
    //         ->whereBetween('id', [$this->awal, $this->akhir]);

    //     return view('exports.violations.index', [
    //         'violations' => $violation
    //     ]);
    // }
}