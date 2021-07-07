<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'quantity' => false,
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'operations';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function user1()
    {
        return $this->belongsTo(User::class);
    }

    public function user2()
    {
        return $this->belongsTo(User::class);
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class)
            ->using(FoodOperation::class)
            ->withTimestamps()
            ->withPivot(['quantity']);
    }

    public function shareableFoods()
    {
        return $this->belongsToMany(Food::class);
    }
}
