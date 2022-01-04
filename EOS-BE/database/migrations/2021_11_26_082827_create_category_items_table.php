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
            $table->string('name');
            $table->string('description');
            $table->decimal('supplierPrice', 8, 2);
            $table->decimal('retailPrice', 8, 2);
            $table->string('size');
            $table->Integer('quantity');
            $table->string('itemCode')->unique();
            $table->string('category');
            $table->string('expirationDate');
            $table->string('image');
            $table->integer('discount');
            $table->string('underCategory');
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
