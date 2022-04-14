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
        Schema::create('alphabets', function (Blueprint $table) {
            $table->id();
            $table->string('alphabet')->nullable();
            $table->text('description')->nullable();
            $table->string('firts_periode')->nullable();           
            $table->string('last_periode')->nullable(); 
            $table->string('alphabet_type');
            $table->string('alphabet_accumulation');
<<<<<<< HEAD:database/migrations/2022_04_12_130812_create_alphabets_table.php
             $table->foreignId('paragraph_id');      
=======
            $table->foreignId('paragraph_id');      
>>>>>>> 34e186f48505b067b76ae6d349389ccd8763cb71:database/migrations/2022_04_08_043806_create_alphabets_table.php
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
        Schema::dropIfExists('alphabets');
    }
};
