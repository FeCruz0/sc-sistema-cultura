<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MaintainCommand extends Command
{
    protected $signature = 'app:maintain {--prod}';
    protected $description = 'Run common maintenance tasks (clear caches and optionally build caches)';

    public function handle()
    {
        $this->info('Clearing caches...');
        Artisan::call('view:clear'); $this->line(Artisan::output());
        Artisan::call('route:clear'); $this->line(Artisan::output());
        Artisan::call('config:clear'); $this->line(Artisan::output());
        Artisan::call('cache:clear'); $this->line(Artisan::output());
        Artisan::call('optimize:clear'); $this->line(Artisan::output());

        if ($this->option('prod')) {
            $this->info('Building route/config cache for production...');
            Artisan::call('route:cache'); $this->line(Artisan::output());
            Artisan::call('config:cache'); $this->line(Artisan::output());
        }

        $this->info('Done.');
        return 0;
    }
}