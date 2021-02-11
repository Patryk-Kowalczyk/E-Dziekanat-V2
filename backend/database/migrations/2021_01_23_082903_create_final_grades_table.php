<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_grades', function (Blueprint $table) {
            $table->id();
            $table->float('first_term')->nullable();
            $table->float('first_repeat')->nullable();
            $table->float('second_repeat')->nullable();
            $table->float('committee')->nullable();
            $table->float('promotion')->nullable();
            $table->foreign('student_id')->references('id')->on('students');;
            $table->foreign('subject_id')->references('id')->on('subjects');;
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('final_grades');
    }
}
