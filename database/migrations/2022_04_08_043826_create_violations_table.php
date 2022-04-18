<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('violations', function (Blueprint $table) {          
            $table->id();
            $table->date('date_of_violation');     
            $table->date('date_end_violation');     
            $table->integer('no_violation');  
            $table->string('format')->nullable();  
            $table->string('month_of_violation')->nullable();  
            $table->string('violation_ROM')->nullable();  
            $table->string('reporting_day')->nullable();  
            $table->date('reporting_date')->nullable();  
            $table->string('job_level')->nullable();
            $table->string('department')->nullable();
            $table->text('other_information')->nullable();
                      
            $table->string('violation_status')->nullable();  
            $table->string('type_of_violation')->nullable();  
                        
            $table->char('violation_accumulation')->nullable();   
            $table->char('alphabet_accumulation')->nullable();   
            $table->char('violation_accumulation2')->nullable();  
            $table->char('violation_accumulation3')->nullable();  
            
            $table->foreignId('alphabet_id');          
            $table->foreignId('signature_id');  
            $table->foreignId('employee_id');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('violations');
    }
};
