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

    private $identifier;
    private $batchNumber;
    private $item;
    private $modelObj;
    private $productHash;
    private $composedProduct;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($identifier, $batchNumber, $item, $modelObj, $productHash, $composedProduct)
    {
        $this->identifier = $identifier;
        $this->batchNumber = $batchNumber;
        $this->item = $item;
        $this->modelObj = $modelObj;
        $this->productHash = $productHash;
        $this->composedProduct = $composedProduct;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $productId = $this->item[$this->identifier];
        $modelObj = (new $this->modelObj);

        $dbProduct = $modelObj::withTrashed()->firstOrCreate([
            'id' => $productId
        ], $this->composedProduct);

        if (!is_null($dbProduct->deleted_at)) {
            $dbProduct->restore();
        }

        if($dbProduct->data_hash != $this->productHash) {
            $modelObj::whereId($productId)->update($this->composedProduct);
        }else{
            $dbProduct->touchBatchNumber($this->batchNumber);
        }
    }
}
