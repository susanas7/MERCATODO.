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
    //protected $category_id;
    //protected $is_active;

    /*public function __construct(int $category_id, int $is_active)
    {
        $this->category_id = $category_id;
        $this->is_active = $is_active;
    }*/

    public function __construct($request)
    {
        $this->request = $request;

        //$this->request['category_id'] = $category_id;
        //$this->request['is_active'] = $is_active;
    }

    public function query()
    {
        //dd($this->request);
        $category_id = $this->request['category_id'] ?? '';
        $is_active = $this->request['is_active'] ?? '';

        return Product::query()->where('category_id', $category_id)
            ->where('is_active', $is_active);
     }

    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        return Product::all();
    }*/

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
