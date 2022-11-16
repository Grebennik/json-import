<?php

namespace App\Classes;

use App\Interfaces\JsonMySQLMapperInterface;
use App\Interfaces\SyncerInterface;
use Illuminate\Support\Str;

class JsonMySQLSyncer implements SyncerInterface
{
    private array $mappedData;
    private string $batchNumber;

    /**
     * @param JsonCollectionStreamReader $reader
     * @param string $model
     * @param string $identifier
     * @param JsonMySQLMapperInterface $mapper
     */
    public function __construct(
        private JsonCollectionStreamReader $reader,
        private string $model,
        private string $identifier,
        private JsonMySQLMapperInterface $mapper
    ) {
        $this->mapData();
        $this->batchNumber = time();
    }

    /**
     * @return void
     */
    public function mapData(): void
    {
        $this->mappedData = !empty($this->model::$updateRestricted) ?
            array_diff_key(
                array_flip($this->mapper->getResult((new $this->model))),
                array_flip($this->model::$updateRestricted)
            ) :
            array_flip($this->mapper->getResult((new $this->model)));
    }

    /**
     * @return void
     */
    public function sync(): void
    {
        $modelObj = (new $this->model);

        foreach ($this->reader->get() as $item) {
            $productId = $item[$this->identifier];
            $productHash = md5(serialize($item));

            $dbProduct = $modelObj::withTrashed()->firstOrCreate([
                'id' => $productId
            ], $productToDB = $this->composeProduct($item, $productHash));

            if(!is_null($dbProduct->deleted_at)){
                $dbProduct->restore();
            }

            if($dbProduct->data_hash != $productHash) {
                $modelObj::whereId($productId)->update($productToDB);
            }else{
                $dbProduct->touchBatchNumber($this->batchNumber);
            }
        }
        $this->reader->close();

        $modelObj::where(
            'batch_number', '<', $this->batchNumber
        )->delete();
    }

    /**
     * @param array $item
     * @param string $hash
     * @return array
     */
    private function composeProduct(array $item, string $hash): array
    {
        $product = [];
        foreach($this->mappedDataMethod() as $key => $property) {
            $product[$key] = $item[$property];
        }

        return array_merge($product, [
            'batch_number' => $this->batchNumber,
            'data_hash' => $hash,
        ]);
    }

    /**
     * @return \Generator
     */
    private function mappedDataMethod(): \Generator
    {
        foreach($this->mappedData as $key => $property) {
            yield $key => $property;
        }
    }

    public function __destruct()
    {
        $this->reader->close();
    }
}