<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentchoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentchoices', function (Blueprint $table) {
            $table->id();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('choice_id')->references('id')->on('choices')->nullable();
            $table->foreign('option_id')->references('id')->on('options')->nullable();
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
        Schema::dropIfExists('userchoices');
    }
}
