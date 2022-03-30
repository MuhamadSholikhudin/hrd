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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('number_of_employees')->unique();
            $table->string('name');
            $table->enum('gender', ['M', 'F']);  
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('marital_status', ['M', 'S']);  
            $table->enum('religion', ['MOSLEM','BUDHIST','CATHOLIC','CHRISTIAN','HINDU','KEPERCAYAAN','NONE']);  
            $table->string('biological_mothers_name');
            $table->string('national_id');
            $table->text('address_jalan')->nullable();
            $table->char('address_rt', 5)->nullable();
            $table->char('address_rw', 5)->nullable();
            $table->string('address_village')->nullable();
            $table->string('address_district')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_province')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('educate')->nullable();
            $table->string('major')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bpjs_ketenagakerjaan')->nullable();
            $table->date('date_bpjs_ketenagakerjaan')->nullable();
            $table->string('bpjs_kesehatan')->nullable();
            $table->date('date_bpjs_kesehatan');
            $table->string('npwp')->nullable();
            $table->enum('kode_ptkp', ['TK', 'K/0', 'K/1', 'K/2']);
            $table->date('year_ptkp')->nullable();
            $table->string('bagian');
            $table->string('cell');   
            $table->foreignId('job_id');
            $table->foreignId('department_id');
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
        Schema::dropIfExists('employees');
    }
};
