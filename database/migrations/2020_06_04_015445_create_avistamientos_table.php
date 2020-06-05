<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvistamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avistamientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');            
            $table->string('titulo'); 
            $table->string('descripcion'); 
            $table->string('url_imagen'); 
            $table->decimal('lat');
            $table->decimal('lng');
            $table->string('estado'); 
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
        Schema::dropIfExists('avistamientos');
    }
}
