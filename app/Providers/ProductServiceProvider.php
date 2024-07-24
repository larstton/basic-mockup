<?php

namespace App\Providers;

use App\Models\Product\ProductRepository;
use App\Services\ProductService;
use App\Services\ProductServiceInterface;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProductRepository::class, function($app){
            return new ProductRepository();
        });

        $this->app->singleton(ProductServiceInterface::class, function($app){
            return new ProductService($app->make(ProductRepository::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
