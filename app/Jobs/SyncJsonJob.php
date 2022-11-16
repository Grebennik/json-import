<?php

namespace App\Jobs;

use App\Classes\EntityJsonMySQLMapper;
use App\Classes\JsonCollectionStreamReader;
use App\Classes\JsonMySQLSyncer;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncJsonJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = public_path('generated-100.json');

        $syncer = new JsonMySQLSyncer(
            new JsonCollectionStreamReader($path, true),
            Product::class,
            'id',
            new EntityJsonMySQLMapper()
        );

        $syncer->sync();
    }
}
