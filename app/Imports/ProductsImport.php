<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Throwable;

class ProductsImport implements ToModel, SkipsOnError
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'category_id' => $row['0'],
            'title' => $row['1'],
            'slug' => $row['2'],
            'is_active' => $row['3'],
            'price' => $row['4'],
        ]);
    }

    public function rules()
    {
        return[
            'category_id' => 'numeric|exists:product_categories,id',
        ];
    }

    public function onError(Throwable $error)
    {
    }
}
