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
            $table->integer('basic_salary')->nullable();          
            $table->integer('positional_allowance')->nullable();          
            $table->integer('transportation_allowance')->nullable();          
            $table->integer('attendance_allowance')->nullable();          
            $table->integer('grade_salary')->nullable();          
            $table->integer('salary_adjustment')->nullable();          
            $table->integer('total_salary')->nullable();          
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
