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
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->enum('marital_status', ['M', 'S']);  
            $table->enum('religion', ['MOSLEM','BUDHIST','CATHOLIC','CHRISTIAN','HINDU','KEPERCAYAAN','NONE']);  
            $table->string('biological_mothers_name');
            $table->string('national_id');
            $table->text('address_jalan');
            $table->char('address_rt', 5);
            $table->char('address_rw', 5);
            $table->string('address_village');
            $table->string('address_district');
            $table->string('address_city');
            $table->string('address_province');
            $table->string('biological_mothers_name');
            $table->string('phone');
            $table->string('email');
            $table->string('educate');
            $table->string('major');
            $table->string('bank_name');
            $table->string('bank_branch');
            $table->string('bank_account_name');
            $table->string('bank_account_number');
            $table->string('bpjs_ketenagakerjaan');
            $table->date('date_bpjs_ketenagakerjaan');
            $table->string('bpjs_kesehatan');
            $table->date('date_bpjs_kesehatan');
            $table->string('npwp');
            $table->enum('kode_ptkp', ['TK', 'K/0', 'K/1', 'K/2']);
            $table->date('year_ptkp');
            $table->foreignId('job_id');
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
