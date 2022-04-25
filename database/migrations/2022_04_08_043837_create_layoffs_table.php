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
        Schema::create('layoffs', function (Blueprint $table) {
            $table->id();
            $table->date('layoff_date');     
            $table->date('layoff_date_start');     
            $table->string('type_of_layoff')->nullable();     
            $table->string('layoff_description')->nullable();     
            $table->integer('no_layoff')->nullable();     
            $table->foreignId('alphabet_id');      
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
        Schema::dropIfExists('layoffs');
    }
};
