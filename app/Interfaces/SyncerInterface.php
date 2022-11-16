<?php

namespace App\Interfaces;

interface SyncerInterface
{
    public function mapData();

    public function sync();
}