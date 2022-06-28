<?php

namespace App\Exports;

use App\Models\Violation;
use Maatwebsite\Excel\Concerns\FromCollection;

class ViolationsEditExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $violations = DB::table('violations')
            ->whereBetween('id', [$request->awal, $request->akhir])
            ->get();

        return Violation::$violations;
    }
}
