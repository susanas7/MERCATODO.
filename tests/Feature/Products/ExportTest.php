<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Product;

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
            ->get(route('products.export'))
            ->assertStatus(403);
    }
    
    /** @test */
    public function anAuthorizedUserCanExportProducts()
    {
        $this->artisan('db:seed');

        factory(Product::class, 5)->create();
        $user = factory(User::class)->create()->assignRole('Super-administrador');
        Excel::fake();

        $response = $this->actingAs($user)
            ->get(route('products.export'))
            ->assertOk();

        Excel::assertDownloaded("products.xlsx");
    }
}
