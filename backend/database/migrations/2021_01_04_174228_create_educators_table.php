<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('album');
            $table->enum('title',['Inż.','Lic.','Mgr','Dr','Dr Hab.','Prof.']);
            $table->foreign('user_id')->references('id')->on('users');;;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educators');
    }
}
