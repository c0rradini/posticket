<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('demanda');
            // $table->string('dataFechamento')->nullable()->default(NULL);
            $table->string('ramal');
            $table->string('status')->default('1');
            $table->foreignId('requerente_user_id')->constrained('users');
            $table->foreignId('responsavel_user_id')->nullable()->constrained('users');
            $table->foreignId('maquina_id')->constrained('maquinas');
            $table->foreignId('setor_id')->constrained('setores');
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
        Schema::dropIfExists('tickets');
    }
};
