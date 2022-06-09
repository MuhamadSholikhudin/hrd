<?php

DB::table('violations')->insert([
    'date_of_violation' => $date_of_violation,     
    'date_end_violation' => $date_end_violation,     
    'no_violation' => $no_sp,   
    'format' => 'SP-HRD',    
    'month_of_violation' => $month_n,     
    'violation_ROM' => $ROM,   
    'reporting_day' => $day_indo,     
    'reporting_date' => $reporting_date,   
    'job_level' => $job_level,   
    'department' => $department,   
    'other_information' => $other_information,   
            
    'violation_status' => 'active',     
    'type_of_violation' => $status_type_violation,   

    'accumulation' => $accumulation,    
    'alphabet_accumulation' => $alphabet_accumulation,    
    'violation_accumulation' => $violation_accumulation,    
    'violation_accumulation2' => $violation_accumulation2,     
    'violation_accumulation3' => $violation_accumulation3,   

    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
    
    'alphabet_id' => $alphabet_id,           
    'signature_id' => $signature_id,    
    'employee_id' => $employee_id
]);