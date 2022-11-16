<?php

namespace App\Classes;

use App\Interfaces\JsonMySQLMapperInterface;
use App\Interfaces\ModelMapperInterface;

class EntityJsonMySQLMapper implements JsonMySQLMapperInterface
{
    private $jsonStructure = [
        'id',
        'json_prop0',
        'json_prop1',
        'json_prop2',
        'json_prop3',
        'json_prop4',
        'json_prop5',
        'json_prop6',
        'json_prop7',
        'json_prop8',
        'json_prop9',
        'json_prop10',
        'json_prop11',
        'json_prop12',
        'json_prop13',
        'json_prop14',
        'json_prop15',
        'json_prop16',
        'json_prop17',
        'json_prop18',
        'json_prop19',
        'json_prop20',
        'json_prop21',
        'json_prop22',
        'json_prop23',
        'json_prop24',
        'json_prop25',
        'json_prop26',
        'json_prop27',
        'json_prop28',
        'json_prop29',
        'json_prop30',
        'json_prop31',
        'json_prop32',
        'json_prop33',
        'json_prop34',
        'json_prop35',
        'json_prop36',
        'json_prop37',
        'json_prop38',
        'json_prop39',
        'json_prop40',
        'json_prop41',
        'json_prop42',
        'json_prop43',
        'json_prop44',
        'json_prop45',
        'json_prop46',
        'json_prop47',
        'json_prop48',
        'json_prop49'
    ];

    public function __construct(private array $renamings = [])
    {
    }

    public function getResult(ModelMapperInterface $model): array
    {
        $model::setMap();

        $result = array_combine($this->jsonStructure, $model::getMap());

        if(!empty($this->renamings)){
            return array_merge($result, $this->renamings);
        }

        return $result;
    }
}