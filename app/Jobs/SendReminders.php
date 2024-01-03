<?php

namespace App\Jobs;

use App\Mail\Reserve\RemindPreviousReserve;
use App\Models\Reserve;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Event\Code\Throwable;

class SendReminders implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //予約日前日確認 明日が予約日の予約コレクションを取得する

        Log::debug('メールジョブ実行');
        $previous_reserves = Reserve::with('reserveSlot.room', 'plan')->get()->filter(function ($reserve) {
            $is_previous_reserve = Carbon::now()->addDay()->format('Y-m-d') === $reserve->reserveSlot->date;
            if ($is_previous_reserve !== false) {
                return $reserve;
            }
        });

        $previous_reserves->map(function ($previous_reserve) {
            return Mail::to($previous_reserve->email)->send(new RemindPreviousReserve($previous_reserve));
        });

    }
}
