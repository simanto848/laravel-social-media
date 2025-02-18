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
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user1_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user2_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
            $table->unique([DB::raw('LEAST(user1_id, user2_id)'), DB::raw('GREATEST(user1_id, user2_id)')]); # Ensure unique friendship
        });

        Schema::enableForeignKeyConstraints(); # Enable the FOREIGN KEY Constraints

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friends');
    }
};
