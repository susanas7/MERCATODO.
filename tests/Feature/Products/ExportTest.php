<?php

namespace Tests\Feature\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ExportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anUnauthorizedUserCanExportProducts()
    {
        factory(Product::class, 5)->create();
        $user = factory(User::class)->create();
        Excel::fake();

        $response = $this->actingAs($user)
            ->get(route('admin.products.export'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanExportProducts()
    {
        $this->withoutExceptionHandling();
        $this->artisan('migrate:refresh --seed');

        factory(Product::class, 5)->create();
        $user = User::all()->last();
        Excel::fake();

        $response = $this->actingAs($user)
            ->get(route('admin.products.export'))
            ->assertSessionHasNoErrors()
            ->assertStatus(200);

        Excel::assertDownloaded('products.xlsx');
    }
}
