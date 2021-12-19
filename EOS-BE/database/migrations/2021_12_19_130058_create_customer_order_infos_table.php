<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrderInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_order_infos', function (Blueprint $table) {
            $table->id();
            $table->string('InvoiceNumber');
            $table->string('Name');
            $table->text('CompleteAddress');
            $table->string('Status');
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
        Schema::dropIfExists('customer_order_infos');
    }
}
