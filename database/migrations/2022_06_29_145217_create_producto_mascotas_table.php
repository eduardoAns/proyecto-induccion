<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_mascotas', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('idcategoria')->unsigned();
            $table->bigInteger('idespecie')->unsigned();
            $table->string('nombre');
            $table->string('descripcion');
            $table->bigInteger('stock');
            $table->bigInteger('precio');
            $table->string('foto');
            $table->timestamps();


            $table->foreign('idcategoria')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('idespecie')->references('id')->on('especies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_mascotas');
    }
}
