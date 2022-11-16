<?php

namespace App\Console\Commands;

use App\Classes\EntityJsonMySQLMapper;
use App\Classes\JsonCollectionStreamReader;
use App\Classes\JsonMySQLSyncer;
use App\Models\Product;
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
     */
    public function handle()
    {
        $path = public_path('generated-1000.json');

        $syncer = new JsonMySQLSyncer(
            new JsonCollectionStreamReader($path, true),
            Product::class,
            'id',
            new EntityJsonMySQLMapper()
        );

        $syncer->sync();
    }
}
