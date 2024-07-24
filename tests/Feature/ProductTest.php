<?php

namespace Feature;

use App\Models\Product\Cover;
use App\Models\Product\Product;
use App\Models\Product\ProductRepository;
use App\Services\ProductService;
use Mockery;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function test_returns_all_products_from_repository()
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
        $productRepository->shouldReceive('products')
            ->andReturn([$product]);

        $productService = new ProductService($productRepository);
        $products = $productService->getAllProducts();
        $this->assertCount(1, $products);
        $this->assertEquals('Homeowners insurance', $products[0]->name);
    }
    /** @test */
    public function can_be_retrieved_in_a_list(): void
    {
        $expected = [
            [
                'productId' => '2dc39bee-f308-40ae-bb7a-a81d2fc96d47',
                'name' => 'Homeowners insurance',
                'covers' => [
                    [
                        'coverId' => '7b573a7e-d40a-4a3a-9414-c646e9b27590',
                        'name' => 'Fire insurance',
                        'fields' => [
                            'limit',
                            'excess',
                            'is_made_of_mostly_wood',
                        ],
                    ],
                    [
                        'coverId' => '27009da6-c984-4e2c-8e9e-045adf958593',
                        'name' => 'Flooding insurance',
                        'fields' => [
                            'limit',
                            'excess',
                            'postcode',
                        ],
                    ],
                ]
            ]
        ];
        $actual = $this->get('/api/product')->json();
        $this->assertEquals($expected, $actual);
    }
}
