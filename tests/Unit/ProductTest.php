<?php

namespace Tests\Unit;

use App\Models\Product\Cover;
use App\Models\Product\Product;
use App\Models\Product\ProductRepository;
use App\Services\ProductService;
use Mockery;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;


class ProductTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_find_product_by_id()
    {
        $product = new Product(Uuid::fromString(
            '2dc39bee-f308-40ae-bb7a-a81d2fc96d47'),
            'Homeowners insurance',
            [
                new Cover(
                    Uuid::fromString('7b573a7e-d40a-4a3a-9414-c646e9b27590'),
                    'Fire insurance',
                    ['is_made_of_mostly_wood']
                ),
                new Cover(
                    Uuid::fromString('27009da6-c984-4e2c-8e9e-045adf958593'),
                    'Flooding insurance',
                    ['postcode']
                ),
            ]);
        $productRepository = Mockery::mock(ProductRepository::class);
        $productRepository->shouldReceive('findProductById')
            ->with('2dc39bee-f308-40ae-bb7a-a81d2fc96d47')
            ->andReturn($product);
        $productService = new ProductService($productRepository);
        $foundProduct = $productService->getProductById('2dc39bee-f308-40ae-bb7a-a81d2fc96d47');
        $this->assertNotNull($foundProduct);
        $this->assertEquals('2dc39bee-f308-40ae-bb7a-a81d2fc96d47', $foundProduct->productId->toString());
        $this->assertEquals('Homeowners insurance', $foundProduct->name);
    }
}
