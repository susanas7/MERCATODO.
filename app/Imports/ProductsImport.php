<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
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
            'category_id' => $row['category_id'],
            'title' => $row['title'],
            'slug' => $row['slug'],
            'is_active' => $row['is_active'],
            'price' => $row['price'],
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|unique:products,title',
            'slug' => 'required|max:200',
            'category_id' => 'required',
            'price' => 'required|numeric|min:0',
        ];
    }

    /*public function onFailure(Failure ...$failures)
    {
    }

    public function onError(\Throwable $errors)
    {
        // Handle the exception how you'd like.
    }*/
}
