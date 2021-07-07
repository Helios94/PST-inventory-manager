<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FoodOperation extends Pivot
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'quantity' => false,
    ];

    public function shareableFood()
    {
//        return $this->belongsToMany(Food::class)->whereShareable;
    }
}
