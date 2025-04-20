<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'recipe_name' => 'required|string|max:255',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer',
            'servings' => 'nullable|integer',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.ingredient_name' => 'required|string|max:255',
            'ingredients.*.quantity' => 'required|string|max:100',
        ];
    }
}
