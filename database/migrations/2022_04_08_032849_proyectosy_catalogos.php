<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProyectosyCatalogos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_proyecto', function (Blueprint $table) {
            $table->id()->increments('id');
            $table->string('nombre');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('estatus', function (Blueprint $table) {
            $table->id()->increments('id');
            $table->string('nombre');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('proyectos', function (Blueprint $table) {
            $table->id()->increments('id');
            $table->string('nombre');
            $table->string('descripcion',1000);
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('proyecto_id');
            $table->foreign('proyecto_id')->references('id')->on('tipo_proyecto');
            $table->unsignedBigInteger('estatus_id');
            $table->foreign('estatus_id')->references('id')->on('estatus');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('proyectos');
        Schema::dropIfExists('status');
        Schema::dropIfExists('tipo_proyecto');
    }
}
