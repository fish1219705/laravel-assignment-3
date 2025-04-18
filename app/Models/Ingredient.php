<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;
    protected $fillable = [
        'recipe_id',
        'ingredient_name',
        'quantity'
    ];
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
