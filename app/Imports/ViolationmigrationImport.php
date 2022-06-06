<?php
/*
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ViolationmigrationImport implements ToCollection
{
    
    public function collection(Collection $collection)
    {
        //
    }
}

*/

namespace App\Imports;

use App\Models\Violationmigration;
// use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Hash;

class ViolationmigrationImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {

// class ViolationmigrationsImport implements ToModel, WithBatchInserts, WithChunkReading
// {
//     public function model(array $row)
//     {
        // return new Violationmigration([
            // "employee_id" => $row["employee_id"],	
            // "date_of_violation" => $row["date_of_violation"],
            // "date_end_violation" => $row["date_end_violation"],
            // "reporting_date" => $row["reporting_date"],
            // "no_violation"	 => $row["no_violation"],
            // "format"	 => $row["format"],
            // "month_of_violation"	 => $row["month_of_violation"],
            // "violation_ROM"	 => $row[7],
            // "reporting_day"	 => $row[8],
            // "job_level" 	 => $row[9],
            // "department" 	 => $row[10],
            // "other_information"	 => $row[11],
            // "violation_status"	 => $row[12],
            // "type_of_violation"	 => $row[13],
            // "alphabet_id"	 => $row[14],
            // "violation_accumulation" => $row[15],
            // "violation_accumulation2" => $row[16],
            // "accumulation" => $row[17],
            // "signature_id" => $row[18]
            // "employee_id" => $row[0],	
            // "date_of_violation" => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]),
            // "date_end_violation" => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]),
            // "reporting_date" => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]),
            // "no_violation"	 => $row[4],
            // "format"	 => $row[5],
            // "month_of_violation"	 => $row[6],
            // "violation_ROM"	 => $row[7],
            // "reporting_day"	 => $row[8],
            // "job_level" 	 => $row[9],
            // "department" 	 => $row[10],
            // "other_information"	 => $row[11],
            // "violation_status"	 => $row[12],
            // "type_of_violation"	 => $row[13],
            // "alphabet_id"	 => $row[14],
            // "violation_accumulation" => $row[15],
            // "violation_accumulation2" => $row[16],
            // // "accumulation" => $row[17],
            // "signature_id" => $row[17]
        // ]);
    }
    
    // public function batchSize(): int
    // {
    //     return 1000;
    // }
    
    // public function chunkSize(): int
    // {
    //     return 1000;
    // }
}
