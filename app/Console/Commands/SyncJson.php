<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SyncJsonJob;

class SyncJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $job = (new SyncJsonJob());
        $job->dispatch();
    }
}
