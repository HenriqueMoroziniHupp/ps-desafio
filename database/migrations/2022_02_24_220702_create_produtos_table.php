<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 100);
            $table->float('preço', 8, 2);
            $table->string('descricao', 100);
            $table->integer('quantidade');
            $table->binary('imagem');
            $table->string('categoria_id');
        });

        //id, nome, preco, descricao, quantidade, imagem e categoria_id)
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('produtos');
    }
};
