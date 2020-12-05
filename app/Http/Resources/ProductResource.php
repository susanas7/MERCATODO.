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
            'image' => $this->getImage,
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
}
