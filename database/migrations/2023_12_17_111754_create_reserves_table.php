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
        Schema::create('reserves', function (Blueprint $table) {
            $table->comment('予約');
            $table->id()->comment('予約ID');
            $table->foreignId('stay_plan_id')->comment('宿泊プランID')->constrained();
            $table->string('first_name')->comment('姓');
            $table->string('last_name')->comment('名');
            $table->string('email')->comment('メールアドレス');
            $table->string('address')->comment('住所');
            $table->string('telephone_number')->comment('電話番号');
            $table->text('message')->comment('メッセージ');
            $table->timestamp('created_at')->comment('作成日時');
            $table->timestamp('updated_at')->comment('更新日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserves');
    }
};
