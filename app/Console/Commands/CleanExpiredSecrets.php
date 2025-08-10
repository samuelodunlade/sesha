<?php

namespace App\Console\Commands;
use App\Models\Secret;
use Illuminate\Console\Command;

class CleanExpiredSecrets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-expired-secrets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired and blocked secrets';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = Secret::where(function($query) {
            $query->where('expires_at', '<=', now())
                  ->orWhere('is_blocked', true);
        })
        ->delete();
        
        $this->info("Cleaned {$count} expired/blocked secrets.");
        return 0;
    }
}
