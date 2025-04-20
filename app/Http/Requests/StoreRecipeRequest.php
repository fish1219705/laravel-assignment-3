<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'recipe_name' => 'required|string|max:255',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer',
            'servings' => 'nullable|integer',
            'photo' => 'nullable|image',
    
            'ingredients' => 'required|array|min:1',
            'ingredients.*.ingredient_name' => 'required|string',
            'ingredients.*.quantity' => 'required|string',
        ];
    }
}
