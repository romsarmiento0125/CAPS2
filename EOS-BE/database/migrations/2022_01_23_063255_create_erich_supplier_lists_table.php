<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErichSupplierListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erich_supplier_lists', function (Blueprint $table) {
            $table->id();
            $table->string('supplierName');
            $table->string('contactNumber');
            $table->text('address');
            $table->string('product');
            $table->text('notes');
            $table->string('status');
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
        Schema::dropIfExists('erich_supplier_lists');
    }
}
