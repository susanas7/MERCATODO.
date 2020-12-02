<?php

namespace Tests\Feature\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;
use App\Product;

class ImportTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anAuthorizedUserCanImportProducts()
    {
        $this->artisan('db:seed');
        $file = new UploadedFile(base_path('tests/Feature/Products/products.xlsx'),
            'products.xlsx', null, null, true);

        $user = factory(User::class)->create()->assignRole('Super-administrador');

        $response = $this->actingAs($user)->post(route('admin.products.import'), ['file' => $file]);
        $response->assertSessionHasNoErrors(); 
    }

    /** @test */
    public function canNotImportAFileWithInvalidData()
    {
        $this->artisan('db:seed');
        $file = new UploadedFile(base_path('tests/Feature/Products/prod.xlsx'),
            'prod.xlsx', null, null, true);

        $user = factory(User::class)->create()->assignRole('Super-administrador');

        $response = $this->actingAs($user)->post(route('admin.products.import'), ['file' => $file]); 

        $response->assertSessionHasErrors();
        $this->assertDatabaseCount('products', 0);
    }
}
