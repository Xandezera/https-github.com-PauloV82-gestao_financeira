<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('descricao'); // string
            $table->decimal('value', 10, 2); // numérico
            $table->date('data'); // data
            $table->binary('imagem')->nullable(); // imagem (BLOB)
            $table->string('documento')->nullable(); // documento ou outro tipo de arquivo (como caminho do arquivo)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesas');
    }
};
