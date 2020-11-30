<?php

namespace Tests\Feature\Api\Products;

use App\Product;
use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use WithoutMiddleware;

    /** @test */
    public function anApiProductCanBeUpdatedWithValidData()
    {
        $this->withoutExceptionHandling();
        //Arrange
        $product = factory(Product::class)->create();
        factory(ProductCategory::class)->create();
        $data = [
            'category_id' => 1, //rand('1', '2'),
            'title' => $this->faker->sentence(2, true),
            'slug' => $this->faker->sentence(4, true),
            'is_active' => rand('0', '1'),
            'price' => rand('10', '20'),
        ];

        //Act
        $response = $this->patchJson(route('api.products.update', $product), $data)
            ->assertOk();

        $product->refresh();

        //Assert
        $this->assertDatabaseHas('products', [
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'slug' => $data['slug'],
            'price' => $data['price'],
        ]);
    }

    /** @test
     * @dataProvider productsDataProvider
     * @param string $field
     * @param mixed|null $value
     */
    public function aProductCanNotBeUpdatedWithInvalidData(string $field, $value = null)
    {
        $this->withoutExceptionHandling();
        // Arrange
        $product = factory(Product::class)->create();
        $data = [
            'category_id' => '1',
            'title' => 'Pas',
            'slug' => 'Lorem ipsum dae',
            'is_active' => '1',
            'price' => '12',
        ];
        $data[$field] = $value;

        // Act
        $response = $this->patchJson(route('api.products.update', $product), $data);
        $product->refresh();

        // Assert
        $response->assertStatus(422)->assertJsonPath('message', 'The given data was invalid.');
    }

    public function productsDataProvider(): array
    {
        return [
            'Test title is required' => ['title', null],
            'Test slug is required' => ['slug', null],
            'Test slug is too long' => ['slug', Str::random(300)],
            'Test category_id is required' => ['category_id', null],
            'Test price is required' => ['price', null],
        ];
    }
}
