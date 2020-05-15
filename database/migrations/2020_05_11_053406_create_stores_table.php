<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('fiscal_name');
            $table->unsignedInteger('nit');
            $table->string('bank_account');
            $table->string('billing');
            $table->unsignedInteger('number');
            $table->string('email');
            $table->string('attendant');
            $table->string('image_name')->nullable();
            $table->string('image_extension')->nullable();
            $table->unsignedInteger('image_size')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('stores');
    }
}
