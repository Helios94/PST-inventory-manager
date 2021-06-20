<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'data';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
//        return [
//            'name' => $this->name,
//            'price' => $this->price,
//            'owner' => $this->user->name,
//            'condition' => $this->when($this->price > 10, $this->price),
//        ];
    }

    public function with($request)
    {
        return ['status' => 'success'];
    }
}
