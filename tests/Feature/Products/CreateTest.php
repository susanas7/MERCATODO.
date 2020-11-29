<?php

namespace Tests\Feature\Products;

use App\Product;
use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    use WithFaker;

    /** @test */
    public function aProductCanBeStored()
    {
        factory(ProductCategory::class)->create();

        $response = $this->post(route('products.store'), [
            'title' => 'Agua',
            'slug' => 'lorem ipsum etc',
            'category_id' => '1',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg',
        ]);

        $product = Product::first();
        $this->assertCount(1, Product::all());

        $this->assertEquals('Agua', $product->title);
        $this->assertEquals('lorem ipsum etc', $product->slug);
        $this->assertEquals('1', $product->category_id);
        $this->assertEquals('32444', $product->price);
        $response->assertRedirect(route('admin.products.index'));
    }

    /**
     * @test
     * @dataProvider dataProvider
     * @param string $field
     * @param mixed|null $value
     */
    public function aProductCanNotBeStoredWithInvalidData(string $field, $value = null)
    {
        $data = [
            'title' => $this->faker->sentence(1),
            'slug' => $this->faker->sentence(5),
            'category_id' => rand('1', '5'),
            'price' => rand('10', '20'),
        ];
        $data[$field] = $value;

        $response = $this->post(route('products.store'), $data)
            ->assertRedirect()
            ->assertSessionHasErrors($field);
    }

    public function dataProvider(): array
    {
        return [
            'Test title is required' => ['title', null],
            'Test slug is required' => ['slug', null],
            'Test category_id is required' => ['category_id', null],
            'Test price is required' => ['price', null],
            'Test price is not numeric' => ['price', Str::random(5)],
        ];
    }
}
