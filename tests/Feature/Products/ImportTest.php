<?php

namespace Tests\Feature\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ImportTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anAuthorizedUserCanImportProducts()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');
        Excel::fake();

        $response = $this->actingAs($user)->post(route('admin.products.import', [
            'file' => UploadedFile::fake()->create('products.xlsx'),
        ]));

        $response->assertSessionHasNoErrors();
    }
}
