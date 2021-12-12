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
            $table->string('Email');
            $table->string('Municipality');
            $table->string('Barangay');
            $table->string('UnderBarangay');
            $table->string('HomeAddress');
            $table->string('Default');
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
