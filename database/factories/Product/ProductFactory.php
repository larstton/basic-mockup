<?php

namespace Database\Factories\Product;

use App\Models\Product\Cover;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'productId' => Uuid::fromString('2dc39bee-f308-40ae-bb7a-a81d2fc96d47'),
            'name' => 'Homeowners insurance',
            'cover' =>     [
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
            ]
        ];
    }
}
