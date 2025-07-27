<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->string('url');
            $table->integer('orden')->default(0); // Para saber cuál es la principal
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagenes');
    }
};
