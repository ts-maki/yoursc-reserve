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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->comment('問い合わせ');
            $table->id()->comment('問い合わせID');
            $table->foreignId('inquiry_type_id')->comment('問い合わせ種別ID')->constrained();
            $table->foreignId('inquiry_status_id')->comment('問い合わせステータスID')->constrained();
            $table->string('first_name')->comment('姓');
            $table->string('last_name')->comment('名');
            $table->string('email')->comment('メールアドレス');
            $table->string('telephone_number')->comment('電話番号');
            $table->date('stay_date')->comment('宿泊予定日');
            $table->text('message')->comment('問い合わせ内容');
            $table->timestamp('created_at')->comment('作成日時');
            $table->timestamp('updated_at')->comment('更新日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
