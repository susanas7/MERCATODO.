<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    //public static $wrap = 'products';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    /*public function toArray($request)
    {
        return [
            'type'          => 'products',
            'id'            => (string)$this->id,
            'attributes'    => [
                'title' => $this->title,
            ],
            'relationships' => [
                'category' => [
                    'data' => [
                        'type' => 'category',
                        'id' => (string) $this->category_id,
                     ]
                ]
            ]
        ];
    }
    public function with($request)
    {
        return ['included' => [new ProductCategoryResource($this->category)]];
    }*/
    public function toArray($request)
    {
        return [
        'type' => 'product',
        'id' => (string)$this->id,
        'attributes' => [
            'title' => $this->title,
            'slug' => $this->slug,
            'is_active' => $this->is_active,
            'price' => $this->price,
        ],
        'relationships' => [
            'category' => [
                'data' => [
                    'type' => 'category',
                    'id' => (string)$this->category_id,
                ],
            ],
            'data'=> ['type'=> 'category', 'id'=> (string)$this->category_id],
        ],
        'links'=> [
            'self' => route('api.products.show', $this),
        ],
    ];
    }

    /*public function with($request)
    {
        if ($this->whenLoaded('category')) {
            return ['included' => [new ProductCategoryResource($this->category)]];
        }
    }*/
}
