<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPickupCancelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_pickup_cancels', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('invoiceNumber');
            $table->string('name');
            $table->string('mobileNumber');
            $table->string('status');
            $table->string('pickupDate');
            $table->string('pickupTime');
            $table->string('discount');
            $table->string('tax');
            $table->string('subTotal');
            $table->string('total');
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
        Schema::dropIfExists('customer_pickup_cancels');
    }
}
