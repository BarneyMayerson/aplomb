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
        Schema::create('dialogues', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('initiator_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table
                ->foreignId('interlocutor_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->boolean('blocked')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dialogues');
    }
};
