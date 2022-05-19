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
            $table->text('alphabet_sound')->nullable();
            $table->string('firts_periode')->nullable();           
            $table->string('last_periode')->nullable(); 
            $table->string('alphabet_type');
            $table->string('alphabet_accumulation');
            $table->boolean('alphabet_status');
            $table->foreignId('paragraph_id');      
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
