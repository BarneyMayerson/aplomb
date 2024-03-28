<?php

use App\Models\Conversation\Dialogue;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("messages", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(Dialogue::class)
                ->constrained()
                ->cascadeOnDelete();

            $table
                ->foreignIdFor(User::class)
                ->comment("from")
                ->constrained()
                ->cascadeOnDelete();

            $table
                ->foreignId("receiver_id")
                ->comment("to")
                ->constrained("users")
                ->cascadeOnDelete();

            $table->string("text", 240);
            $table->timestamp("read_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("messages");
    }
};
