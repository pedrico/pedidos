<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('correlative');
            $table->unsignedInteger('user_id');
            $table->string('recipient_alternative_name')->nullable();
            $table->unsignedInteger('address_id')->nullable();
            $table->date('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->unsignedInteger('base_id')->nullable();
            $table->unsignedInteger('dvBase_id')->nullable();
            $table->unsignedInteger('dvMoto_id')->nullable();
            $table->unsignedTinyInteger('status');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreign('base_id')->references('id')->on('bases')->onDelete('cascade');
            $table->foreign('dvBase_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dvMoto_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
