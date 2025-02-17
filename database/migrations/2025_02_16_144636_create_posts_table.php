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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('content')->nullable();
            $table->enum('type', ['text', 'image', 'video'])->default('text');
            $table->enum('privacy', ['public', 'private', 'friend'])->default('public');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints(); # Enable the FOREIGN KEY Constraints
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
