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
            $table->string('number_of_employees')->nullable();
            $table->string('finger_id')->nullable();
            $table->string('name')->nullable();
            // $table->enum('gender', ['M', 'F'])->nullable();  
            $table->string('gender')->nullable();  
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
<<<<<<< HEAD
            $table->enum('marital_status', ['M', 'S'])->nullable();  
            $table->string('religion')->nullable();  //, ['MOSLEM','BUDHIST','CATHOLIC','CHRISTIAN','HINDU','KEPERCAYAAN','NONE']
=======
            // $table->enum('marital_status', ['M', 'S', 'D', 'J','', null])->nullable();  
            $table->string('marital_status')->nullable();  
            $table->string('religion')->nullable();  
            // $table->enum('religion', ['MOSLEM','BUDHIST','CATHOLIC','CHRISTIAN','HINDU','KEPERCAYAAN','NONE','', null])->nullable();  
>>>>>>> 34e186f48505b067b76ae6d349389ccd8763cb71
            $table->string('biological_mothers_name')->nullable();
            $table->string('national_id')->nullable();
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
            $table->date('hire_date')->nullable();
            $table->string('employee_type')->nullable();
            $table->date('end_of_contract')->nullable();
            $table->date('date_out')->nullable();
            $table->string('exit_statement')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bpjs_ketenagakerjaan')->nullable();
            $table->date('date_bpjs_ketenagakerjaan')->nullable();
            $table->string('bpjs_kesehatan')->nullable();
            $table->date('date_bpjs_kesehatan')->nullable();
            $table->string('npwp')->nullable();
<<<<<<< HEAD
            $table->char('kode_ptkp', 5)->nullable();
            $table->char('year_ptkp', 4)->nullable();
=======
            // $table->enum('kode_ptkp', ['TK', 'K/0', 'K/1', 'K/2', 'J', 'J/0', 'J/1', 'J/2', 'D','', null])->nullable();
            $table->string('kode_ptkp')->nullable();
            $table->string('year_ptkp')->nullable();
>>>>>>> 34e186f48505b067b76ae6d349389ccd8763cb71
            $table->string('bagian')->nullable();
            $table->string('cell')->nullable();   
            $table->string('status_employee')->nullable();   
            $table->foreignId('job_id')->nullable();
            $table->foreignId('department_id')->nullable();
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
