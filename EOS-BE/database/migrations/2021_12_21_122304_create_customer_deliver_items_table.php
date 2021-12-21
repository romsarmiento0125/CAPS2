<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDeliverItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_deliver_items', function (Blueprint $table) {
            $table->id();
            $table->string('Email');
            $table->string('InvoiceNumber');
            $table->string('Name');
            $table->string('MobileNumber');
            $table->text('CompleteAddress');
            $table->string('Status');
            $table->string('OrderYear');
            $table->string('OrderMonth');
            $table->string('OrderDay');
            $table->string('AdjustedDate');
            $table->string('ShipFee');
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
        Schema::dropIfExists('customer_deliver_items');
    }
}
