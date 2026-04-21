<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('realisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')
                  ->constrained('pengajuan')
                  ->onDelete('cascade');

            $table->foreignId('analis_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->date('tanggal_realisasi');
            $table->decimal('nominal_disetujui',15,2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('realisasi');
    }
};
