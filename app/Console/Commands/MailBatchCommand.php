<?php

namespace App\Console\Commands;

use App\Jobs\MailBatch;
use App\Mail\Reserve\RemindPreviousReserve;
use App\Models\Reserve;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Batchable;
use Throwable;

class MailBatchCommand extends Command
{
    use Batchable;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mail-batch-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SendReminders::dispatch(); 
    }
    
}
