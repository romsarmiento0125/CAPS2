<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomeraddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customeraddresses', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('municipality');
            $table->string('barangay');
            $table->string('underBarangay');
            $table->string('homeAddress');
            $table->string('shipFee');
            $table->string('default');
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
        Schema::dropIfExists('customeraddresses');
    }
}
