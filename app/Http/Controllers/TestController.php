<?php

namespace App\Http\Controllers;

use App\Classes\EntityJsonMySQLMapper;
use App\Classes\JsonCollectionStreamReader;
use App\Classes\JsonMySQLSyncer;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class TestController extends BaseController
{
    public function index(Request $request)
    {
        $path = public_path('generated-100.json');

        $syncer = new JsonMySQLSyncer(
            new JsonCollectionStreamReader($path, true),
            Product::class,
            'id',
            new EntityJsonMySQLMapper()
        );

        $syncer->sync();

        echo 'done';
    }
}
