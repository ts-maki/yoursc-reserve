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
        Schema::create('stay_plan_image', function (Blueprint $table) {
            $table->comment('宿泊プランと画像の関係');
            $table->foreignId('stay_plan_id')->comment('宿泊プランID')->constrained();
            $table->foreignId('image_id')->comment('画像ID')->constrained();
            $table->primary(['stay_plan_id', 'image_id']);
            $table->timestamp('created_at')->comment('作成日時');
            $table->timestamp('updated_at')->comment('更新日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stay_plan_image');
    }
};
