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
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade')->onUpdate('cascade');
            $table->string('url')->nullable();
            $table->enum('type', ['image', 'audio', 'video'])->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints(); # Enable the FOREIGN KEY Constraints
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
