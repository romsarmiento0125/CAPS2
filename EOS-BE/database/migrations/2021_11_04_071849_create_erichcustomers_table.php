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
            $table->string('first_Name');
            $table->string('last_Name');
            $table->string('mobile_Number');
            $table->string('email')->unique();
            $table->string('gender');
            $table->string('birthday');
            $table->string('tag');
            $table->string('status');
            $table->string('password');
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
