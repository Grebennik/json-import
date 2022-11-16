<?php

namespace App\Console\Commands;

use App\Classes\JsonCollectionStreamReader;
use Illuminate\Console\Command;

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
     * @return int
     */
    public function handle()
    {
        $path = 'path/to/file.json';

        $reader = new JsonCollectionStreamReader($path);

        foreach ($reader->get() as $item) {
            // Do something with item.
        }

        $reader->close();

    }
}
