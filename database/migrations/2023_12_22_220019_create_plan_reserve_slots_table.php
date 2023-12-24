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
        Schema::create('plan_reserve_slots', function (Blueprint $table) {
            $table->comment('宿泊プランと予約枠の関係');
            $table->foreignId('plan_id')->comment('宿泊プランID')->constrained();
            $table->foreignId('reserve_slot_id')->comment('予約枠ID')->constrained();
            $table->primary(['plan_id', 'reserve_slot_id']);
            $table->unsignedMediumInteger('fee')->comment('料金');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_reserve_slots');
    }
};
