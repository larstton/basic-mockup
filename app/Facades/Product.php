<?php

namespace App\Facades;

use App\Services\ProductService;
use App\Services\ProductServiceInterface;
use Illuminate\Support\Facades\Facade;

class Product extends Facade
{
    public static function getFacadeAccessor(){
        return ProductServiceInterface::class;
    }
}
