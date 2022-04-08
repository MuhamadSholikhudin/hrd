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
        Schema::create('default_texts', function (Blueprint $table) {
            $table->id();
            $table->date('layoff_date');     
            $table->text('description')->nullable();     
            $table->string('default_state')->nullable();     
            $table->string('default_type')->nullable();     
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
        Schema::dropIfExists('default_texts');
    }
};
