<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('imgCategoria')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });

        DB::table('categorias')->insert([
            ['name' => 'ducha'],
            ['name' => 'lavamanos'],
            ['name' => 'llaves'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
