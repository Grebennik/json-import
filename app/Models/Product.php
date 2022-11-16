<?php

namespace App\Models;

use App\Interfaces\ModelMapperInterface;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements ModelMapperInterface
{
    use HasFactory, UUID, SoftDeletes;

    public $fillable = [
        'id',
        'property0',
        'property1',
        'property2',
        'property3',
        'property4',
        'property5',
        'property6',
        'property7',
        'property8',
        'property9',
        'property10',
        'property11',
        'property12',
        'property13',
        'property14',
        'property15',
        'property16',
        'property17',
        'property18',
        'property19',
        'property20',
        'property21',
        'property22',
        'property23',
        'property24',
        'property25',
        'property26',
        'property27',
        'property28',
        'property29',
        'property30',
        'property31',
        'property32',
        'property33',
        'property34',
        'property35',
        'property36',
        'property37',
        'property38',
        'property39',
        'property40',
        'property41',
        'property42',
        'property43',
        'property44',
        'property45',
        'property46',
        'property47',
        'property48',
        'property49',
        'batch_number',
        'data_hash'
    ];

    /**
     * @var string[]
     */
    private static array $map;
    public static array $updateRestricted = [
      'property8',
    ];

    /**
     * @param $batchNumber
     * @return void
     */
    public function touchBatchNumber($batchNumber): void
    {
        $this->batch_number = $batchNumber;
        $this->save();
    }

    public static function setMap()
    {
        self::$map =  [
            'id',
            'property0',
            'property1',
            'property2',
            'property3',
            'property4',
            'property5',
            'property6',
            'property7',
            'property8',
            'property9',
            'property10',
            'property11',
            'property12',
            'property13',
            'property14',
            'property15',
            'property16',
            'property17',
            'property18',
            'property19',
            'property20',
            'property21',
            'property22',
            'property23',
            'property24',
            'property25',
            'property26',
            'property27',
            'property28',
            'property29',
            'property30',
            'property31',
            'property32',
            'property33',
            'property34',
            'property35',
            'property36',
            'property37',
            'property38',
            'property39',
            'property40',
            'property41',
            'property42',
            'property43',
            'property44',
            'property45',
            'property46',
            'property47',
            'property48',
            'property49'
        ];
   }

    public static function getMap()
   {
       return self::$map;
   }

}
