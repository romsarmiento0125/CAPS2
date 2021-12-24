<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPickupInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_pickup_infos', function (Blueprint $table) {
            $table->id();
            $table->string('Email');
            $table->string('InvoiceNumber');
            $table->string('Name');
            $table->string('MobileNumber');
            $table->string('Status');
            $table->string('PickupDate');
            $table->string('PickupTime');
            $table->string('Discount');
            $table->string('Tax');
            $table->string('SubTotal');
            $table->string('Total');
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
        Schema::dropIfExists('customer_pickup_infos');
    }
}
