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
        Schema::create('plan_room', function (Blueprint $table) {
            $table->comment('宿泊プランと部屋の関係');
            $table->foreignId('plan_id')->comment('宿泊プランID')->constrained();
            $table->foreignId('room_id')->comment('部屋ID')->constrained();
            $table->primary(['plan_id', 'room_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_room_type');
    }
};
