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
        Schema::create('reserve_memos', function (Blueprint $table) {
            $table->comment('予約メモ');
            $table->id()->comment('予約メモID');
            $table->foreignId('reserve_id')->comment('予約ID')->constrained();
            $table->string('memo')->comment('メモ');
            $table->timestamp('created_at')->comment('作成日時');
            $table->timestamp('updated_at')->comment('更新日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserve_memos');
    }
};
