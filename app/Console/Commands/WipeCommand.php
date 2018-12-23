<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WipeCommand extends Command
{
    /**
     * The name and signature of the console command
     * @var string
     */
    protected $signature = 'wipe';

    /**
     * The console command description
     * @var string
     */
    protected $description = 'This command cleans cache and freshes databese';

    /**
     * Create a new command instance
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command
     * @return mixed
     */
    public function handle()
    {
        $this->call('cache:clear');
        $this->call('route:clear');
        $this->call('view:clear');

        forgetAllCache();

        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->info('Cache and database data had been cleared');
    }
}
