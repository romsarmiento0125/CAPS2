<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_items', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Description');
            $table->decimal('SupplierPrice', 8, 2);
            $table->decimal('RetailPrice', 8, 2);
            $table->string('Size');
            $table->Integer('Quantity');
            $table->string('ItemCode')->unique();
            $table->string('Category');
            $table->string('ExpirationDate');
            $table->string('Image');
            $table->integer('Discount');
            $table->string('UnderCategory');
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
        Schema::dropIfExists('category_items');
    }
}
