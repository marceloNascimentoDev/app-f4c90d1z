<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'       => $this->name ?? null,
            'sku'        => $this->sku ?? null,
            'amount'     => $this->amount ?? null,
            'updated_at' => $this->updated_at ?? null,
            'created_at' => $this->created_at ?? null
        ];
    }
}
