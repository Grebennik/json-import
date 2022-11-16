<?php

namespace App\Interfaces;

interface MapperInterface
{
    public function getResult(ModelMapperInterface $model): mixed;
}