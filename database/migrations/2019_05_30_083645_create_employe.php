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
