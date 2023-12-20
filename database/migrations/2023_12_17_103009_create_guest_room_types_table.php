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
        Schema::create('room_types', function (Blueprint $table) {
            $table->comment('部屋の種類');
            $table->id()->comment('部屋の種類ID');
            $table->string('name')->unique()->comment('部屋の名前');
            $table->string('description')->comment('部屋の説明');
            $table->timestamp('created_at')->comment('作成日時');
            $table->timestamp('updated_at')->comment('更新日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_room_types');
    }
};
