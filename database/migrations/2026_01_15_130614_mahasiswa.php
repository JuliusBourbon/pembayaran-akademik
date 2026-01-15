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
        Schema::create('mahasiswa', function (Blueprint $table){
            $table->id('nim', 8);
            $table->string('nama', 50);
            $table->text('alamat');
            $table->string('telepon', 15);
            $table->string('telepon_ortu', 15);
            $table->string('user', 8);
            $table->string('password', 8);
            $table->string('email', 50);
            $table->string('virtual_account', 20);
            $table->unsignedBigInteger('id_prodi');
            $table->foreign('id_prodi')->references('id_prodi')->on('programstudi')->onDelete('cascade');
            $table->unsignedBigInteger('id_fakultas');
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas')->onDelete('cascade');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
