<?php

namespace App\Imports;

use App\Models\Violation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;

class violationsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Violation([
            //
            'number_of_employees' => $row['number_of_employees'],
            'reporting_date'=> $row['reporting_date'],
            'date_of_violation'=> $row['date_of_violation'],  
            'other_information'=> $row['other_information'],
            'alphabet_id'=> $row['alphabet_id']
        ]);
    }
}
