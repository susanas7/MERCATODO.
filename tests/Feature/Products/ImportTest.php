<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Product;
use Illuminate\Http\UploadedFile;

class ImportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anUnauthorizedUserCanImportProducts()
    {
        factory(Product::class, 5)->create();
        $user = factory(User::class)->create();
        Excel::fake();

        $response = $this->actingAs($user)->post('/products/import');

        $response->assertStatus(419);
    }

    /** @test */
    public function anAuthorizedUserCanImportProducts()
    {
        $this->artisan('db:seed');
        factory(Product::class, 5)->create();
        $user = factory(User::class)->create()->assignRole('Super-administrador');
        Excel::fake();

        $response = $this->actingAs($user)->post(route('products.import', [
            'file' => UploadedFile::fake()->create('products.xlsx')
        ]));

        $response->assertSessionHasNoErrors();
    }
}
