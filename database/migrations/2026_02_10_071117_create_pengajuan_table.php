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
       Schema::create('pengajuan', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('nasabah_id')->constrained('nasabah')->onDelete('cascade');
    $table->enum('jenis_kredit',['KUR','KUM']);
    $table->decimal('jumlah',15,2);
  $table->enum('status', [
    'pending',
    'analisis',
    'survey',
    'diterima',
    'ditolak',
    'realisasi',
    'pencairan'
])->default('pending');

    $table->timestamps();
});




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
