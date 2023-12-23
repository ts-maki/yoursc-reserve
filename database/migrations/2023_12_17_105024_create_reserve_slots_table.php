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
        Schema::create('reserve_slots', function (Blueprint $table) {
            $table->comment('予約枠');
            $table->id()->comment('予約枠ID');
            $table->foreignId('room_id')->comment('部屋ID')->constrained();
            $table->date('date')->comment('予約日');
            $table->unsignedMediumInteger('fee')->comment('部屋の料金');
            $table->unsignedTinyInteger('number_of_rooms')->comment('部屋の数');
            $table->timestamp('created_at')->comment('作成日時');
            $table->timestamp('updated_at')->comment('更新日時');
            $table->unique(['room_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserve_slots');
    }
};
