<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollstudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pollstudents', function (Blueprint $table) {
            $table->id();
            $table->foreign('poll_id')->references('id')->on('pollnames')->nullable();
            $table->foreign('question_id')->references('id')->on('pollquestions')->nullable();
            $table->foreign('answer_id')->references('id')->on('pollanswers')->nullable();
            $table->boolean('status')->default(0);
            $table->foreign('student_id')->references('id')->on('students')->nullable();
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
        Schema::dropIfExists('polldetails');
    }
}
