<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentsdetails', function (Blueprint $table) {
            $table->id();
            $table->decimal('assinged',9,2);
            $table->date('assigned_date')->useCurrent();
            $table->decimal('paid',9,2)->nullable();
            $table->date('paid_date')->nullable();
            $table->integer('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paymentsdetails');
    }
}
