<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_structure', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_basic_info_id');
            $table->integer('branch_id');
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->integer('amount');
            $table->string('payroll_frequency');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('salary_structure');
    }
}
