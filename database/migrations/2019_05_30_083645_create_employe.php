<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploye extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employe_code');
            $table->string('employe_name');
            $table->string('branch_name');
            $table->string('department_name');
            $table->string('designation_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('date_of_birth');
            $table->string('national_id');
            $table->string('nationality');
            $table->string('employe_gender');
            $table->string('blood_group');
            $table->string('religion');
            $table->string('merital_statas');
            $table->string('employe_photo');
            $table->timestamps();
        });


        Schema::create('employe_contact_info', function (Blueprint $table) {
            $table->bigIncrements('employe_contact_info_id');
            $table->string('id');
            $table->string('phone_number');
            $table->string('email');
            $table->string('present_address');
            $table->string('parmanent_address');
            $table->timestamps();
        });


        Schema::create('employe_bank_info', function (Blueprint $table) {
            $table->bigIncrements('employe_bank_info_id');
            $table->string('id');
            $table->string('bank_account_number');
            $table->string('bank_name');
            $table->string('bank_Branch_name');
            $table->timestamps();
        });


        Schema::create('employe_joining_info', function (Blueprint $table) {
            $table->bigIncrements('employe_joining_info_id');
            $table->string('id');
            $table->string('offer_date');
            $table->string('confirmation_date');
            $table->string('joining_date');
            $table->timestamps();
        });


        Schema::create('employe_personal_bio', function (Blueprint $table) {
            $table->bigIncrements('employe_personal_bio_id');
            $table->string('id');
            $table->string('cv');
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
        Schema::dropIfExists('employe');
    }
}
