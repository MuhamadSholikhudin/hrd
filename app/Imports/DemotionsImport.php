<?php

namespace App\Imports;

use App\Models\Demotion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;

class DemotionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Demotion([
            //
            'number_of_employees' => $row['number_of_employees'],
            'name'=> $row['name'],
            'job_level'=> $row['job_level'],  
            'code_job_level'=> $row['code_job_level'],
            'department'=> $row['department'],
            'cell'=> $row['cell'],
            'bagian'=> $row['bagian']
        ]);
    }
}
