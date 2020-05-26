<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_event', function (Blueprint $table) {
            $table->bigIncrements('meeting_event_id');
            $table->integer('branch_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('meeting_or_event')->default(1)->comment('1 = meeting, 2 = event');
            $table->string('title');
            $table->dateTime('time');
            $table->text('description');
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
        Schema::dropIfExists('meeting_event');
    }
}
