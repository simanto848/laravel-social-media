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
        Schema::create('profile_pictures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('url');
            $table->boolean('is_primary')->default(false);
            $table->unique(['user_id', 'is_primary']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints(); # Enable the FOREIGN KEY Constraints
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_pictures');
    }
};
