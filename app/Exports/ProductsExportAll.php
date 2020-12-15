<?php

namespace App\Exports;

use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExportAll implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return Product::all();
    }

    /**
     * @return array
     */
    public function map(Product $product): array
    {
        return [
            $product->id,
            $product->category->title,
            $product->title,
            $product->slug,
            $product->is_active,
            $product->price,
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'CATEGORY',
            'TITLE',
            'SLUG',
            'STATUS',
            'PRICE',
        ];
    }
}
