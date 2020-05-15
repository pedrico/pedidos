<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDvbasesDvmotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dvbases_dvmotos', function (Blueprint $table) {
            $table->id();            
            $table->unsignedInteger('dvBase_id');
            $table->unsignedInteger('dvMoto_id');            
            $table->foreign('dvBase_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dvMoto_id')->references('id')->on('users')->onDelete('cascade');            
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
        Schema::dropIfExists('dvbases_dvmotos');
    }
}
