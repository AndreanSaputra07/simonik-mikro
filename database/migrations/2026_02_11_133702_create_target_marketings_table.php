<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('target_marketings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->decimal('target_nominal',15,2);
            $table->year('tahun');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('target_marketings');
    }
};
