<?php

namespace Tests\Feature\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    use WithFaker;

    private $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->product = factory(Product::class)->create();
    }

    /** @test */
    public function aProductCanBeUpdated()
    {
        $response = $this->put(route('api.products.update', $this->product), [
            'title' => 'Agua',
            'slug' => 'lorem ipsum etc',
            'price' => '32444',
            'category_id' => '1',
            'img_route' => 'images/MfV3Uh.jpeg',
        ]);
        $product = Product::first();

        $this->assertEquals('Agua', $product->title);
        $this->assertEquals('lorem ipsum etc', $product->slug);
        $this->assertEquals('1', $product->category_id);
        $this->assertEquals('32444', $product->price);
        $this->assertEquals('images/MfV3Uh.jpeg', $product->img_route);
        $response->assertStatus(200);
        $response->assertSessionHasNoErrors();
    }

    /**
     * @test
     * @dataProvider dataProvider
     * @param string $field
     * @param mixed|null $value
     */
    public function aProductCanNotBeUpdatedWithInvalidData(string $field, $value = null)
    {
        $data = [
            'title' => $this->faker->sentence(1),
            'slug' => $this->faker->sentence(5),
            'category_id' => rand('1', '5'),
            'price' => rand('10', '20'),
        ];
        $data[$field] = $value;

        $response = $this->put(route('api.products.update', $this->product), $data)
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
