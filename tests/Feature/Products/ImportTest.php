<?php

namespace Tests\Feature\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImportTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anAuthorizedUserCanImportProducts()
    {
        $this->artisan('migrate:refresh --seed');
        $file = new UploadedFile(base_path('tests/Feature/Products/products.xlsx'),
            'products.xlsx', null, null, true);

        $user = factory(User::class)->create()->assignRole('Super-administrador');

        $response = $this->actingAs($user)->post(route('admin.products.import'), ['file' => $file]);
        $response->assertSessionHasNoErrors();
    }

    /* @test */
    /*public function canNotImportAFileWithInvalidData()
    {
        $this->artisan('migrate:refresh --seed');
        $file = new UploadedFile(base_path('tests/Feature/Products/prod.xlsx'),
            'prod.xlsx', null, null, true);

        $user = factory(User::class)->create()->assignRole('Super-administrador');

        $response = $this->actingAs($user)->post(route('admin.products.import'), ['file' => $file]);

    }*/
}
