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
            $table->string('email');
            $table->string('invoiceNumber');
            $table->string('name');
            $table->string('mobileNumber');
            $table->text('completeAddress');
            $table->string('status');
            $table->string('orderYear');
            $table->string('orderMonth');
            $table->string('orderDay');
            $table->string('adjustedDate');
            $table->string('shipFee');
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
        Schema::dropIfExists('customer_deliver_items');
    }
}
