<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeTransfer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employe_transfer', function (Blueprint $table) {
            $table->bigIncrements('employe_transfer_id');
            $table->string('id');
            $table->string('issue_date');
            $table->string('previous_branch');
            $table->string('previous_department');
            $table->string('present_branch');
            $table->string('present_department');
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
        Schema::dropIfExists('employe_transfer');
    }
}
