<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ProductsExportAll implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->category->title,
            $product->title,
            $product->slug,
            $product->is_active,
            $product->price,
            $product->created_at
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'CATEGORY',
            'TITLE',
            'SLUG',
            'STATUS',
            'PRICE',
            'CREATED AT',
        ];
    }
}