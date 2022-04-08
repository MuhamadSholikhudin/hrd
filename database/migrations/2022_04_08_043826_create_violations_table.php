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
            $table->string('violation_status')->nullable();  
            $table->string('type_of_violation')->nullable();  
            $table->integer('no_violation');  
            $table->string('format')->nullable();  
            $table->string('month_of_violation')->nullable();  
            $table->string('violation_ROM')->nullable();  
            $table->string('reporting_day')->nullable();  
            $table->date('reporting_date');  
            $table->string('part')->nullable();  
            $table->text('other_information')->nullable();     
            $table->foreignId('signature_id');  
            $table->foreignId('letter_id');      
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
