<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;
    protected $fillable = [
        'recipe_name',
        'instructions',
        'prep_time',
        'servings',
        'photo',
        'user_id',
        'approved',
    ];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

}
