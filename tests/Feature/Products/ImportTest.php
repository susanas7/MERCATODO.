<?php

namespace Tests\Feature\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

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
            'file' => UploadedFile::fake()->create('products.xlsx'),
        ]));

        $response->assertSessionHasNoErrors();
    }
}
