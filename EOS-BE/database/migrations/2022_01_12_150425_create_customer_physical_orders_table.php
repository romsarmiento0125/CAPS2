<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPhysicalOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_physical_orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceNumber');
            $table->string('completeDate');
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
        Schema::dropIfExists('customer_physical_orders');
    }
}
