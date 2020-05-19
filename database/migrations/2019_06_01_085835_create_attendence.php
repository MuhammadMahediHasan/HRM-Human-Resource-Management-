<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendence_parent', function (Blueprint $table) {
            $table->bigIncrements('attendence_parent_id');
            $table->string('attendence_parent_date');
            $table->string('attendence_parent_department');
            $table->timestamps();
        });


        Schema::create('attendence_child', function (Blueprint $table) {
            $table->bigIncrements('attendence_child_id');
            $table->string('attendence_parent_id');
            $table->string('id');
            $table->string('attendence_child_status');
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
        Schema::dropIfExists('attendence');
    }
}
