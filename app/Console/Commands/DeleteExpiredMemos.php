<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteExpiredMemos extends Command
{
    protected $signature = 'memos:delete-expired';
    protected $description = 'Delete memos that have expired based on their timer';

    public function handle()
    {
        DB::table('memos')->where('timer', '<=', now())->delete();
        $this->info('Expired memos deleted successfully.');
    }
}
