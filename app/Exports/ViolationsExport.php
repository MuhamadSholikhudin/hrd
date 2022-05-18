<?php

namespace App\Exports;

use App\Models\Violation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;

class ViolationsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.violations.index', [
            'violations' => Violation::all()
        ]);
    }
}
