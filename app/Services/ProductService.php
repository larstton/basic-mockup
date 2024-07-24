<?php

namespace App\Services;

use App\Models\Product\Product;
use App\Models\Product\ProductRepository;
use App\Models\Quote\Cover;
use App\Models\Quote\Quote;
use App\Models\Quote\RatedQuote;

/**
 * The rating service would normally be a separate microservice
 */
class ProductService implements ProductServiceInterface
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(): array
    {
        return $this->productRepository->products();
    }
    public function getProductById(string $productId): Product
    {
        return $this->productRepository->findProductById($productId);
    }

}
