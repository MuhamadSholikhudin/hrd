<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violationmigration extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = [
         "employee_id",	
        "date_of_violation" ,
        "date_end_violation",
        "reporting_date",
        "no_violation",
        "format",
        "month_of_violation",
        "violation_ROM",
        "reporting_day",
        "job_level" ,
        "department" ,
        "other_information",
        "violation_status",
        "type_of_violation",
        "alphabet_id",
        "violation_accumulation",
        "violation_accumulation2",
        "accumulation",
        "signature_id",
    ];


}
