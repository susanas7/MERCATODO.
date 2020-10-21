<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ProductsExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    use Exportable;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $category_id = $this->request['category_id'] ?? '';
        
        $is_active = $this->request['is_active'] ?? '';

        return Product::query()->where('category_id', $category_id)
            ->where('is_active', $is_active);
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
