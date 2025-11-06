<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->nullable();
            $table->string('apellidos', 150)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('correo', 120)->unique()->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->decimal('nota_media', 3, 2)->nullable();
            $table->text('experiencia')->nullable();
            $table->text('formacion')->nullable();
            $table->text('habilidades')->nullable();
            $table->string('pdf', 200)->nullable();
            $table->string('fotografia', 200)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }

};
