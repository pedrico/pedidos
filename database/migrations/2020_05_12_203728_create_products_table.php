<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();            
            $table->string('name');
            $table->string('description');
            $table->decimal('price');
            $table->string('image_name')->nullable();
            $table->string('image_extension')->nullable();
            $table->unsignedInteger('image_size')->nullable();            
            $table->unsignedInteger('measurement_unit_id');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('measurement_unit_id')->references('id')->on('measurement_units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
