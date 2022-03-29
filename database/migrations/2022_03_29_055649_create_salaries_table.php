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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('basic_salary');          
            $table->integer('positional_allowance');          
            $table->integer('transportation_allowance');          
            $table->integer('attendance_allowance');          
            $table->integer('grade_salary');          
            $table->integer('salary_adjustment');          
            $table->integer('total_salary');          
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
        Schema::dropIfExists('salaries');
    }
};
