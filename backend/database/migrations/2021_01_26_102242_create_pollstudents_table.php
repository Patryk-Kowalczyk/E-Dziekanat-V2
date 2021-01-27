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
            $table->integer('poll_id')->nullable();
            $table->integer('question_id')->nullable();
            $table->integer('answer_id')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('student_id');
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
