<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErichcustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erichcustomers', function (Blueprint $table) {
            $table->id();
            $table->string('First_Name');
            $table->string('Last_Name');
            $table->bigInteger('Mobile_Number');
            $table->string('Email')->unique();
            $table->string('Municipality');
            $table->string('Barangay');
            $table->string('UnderBarangay');
            $table->string('HomeAddress');
            $table->string('Birthday');
            $table->string('Tag');
            $table->string('Password');
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
        Schema::dropIfExists('erichcustomers');
    }
}
