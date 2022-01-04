<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_order_items', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceNumber');
            $table->string('itemName');
            $table->string('itemDesc');
            $table->Integer('quantity');
            $table->Integer('discount');
            $table->decimal('retailPrice', 8, 2);
            $table->string('itemCode');
            $table->string('itemImage');
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
        Schema::dropIfExists('customer_order_items');
    }
}
