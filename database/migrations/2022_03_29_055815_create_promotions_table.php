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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->date('promotion_date');
            $table->enum('status', ['active', 'not active']);  
            $table->string('bagian')->nullable();
            $table->string('cell')->nullable();           
            $table->foreignId('job_id');
            $table->foreignId('department_id');
            $table->foreignId('employee_id');
            $table->timestamps();
        
                        /*
            $table->string('');
            $table->string('')->nullable();
            $table->integer('');          
            $table->text('');
            $table->enum('difficulty', ['easy', 'hard']);  
            $table->float('amount', 8, 2);
            $table->foreignId('user_id');
            $table->foreignId('employee_id');
            $table->foreignId('position_id');
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
};
