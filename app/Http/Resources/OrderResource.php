<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'status' => $this->status,
            'orderdate' => $this->orderdate,
            'shipdate' => $this->shipdate,
            'relationships' => [
                'user' => $this->user,
                'items' => $this->items
            ]
        ];
    }
}
