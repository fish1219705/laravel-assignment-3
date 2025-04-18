<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('recipes.index', [
            'recipes' => Recipe:: all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecipeRequest $request)
    {
        // 建立食譜
        $recipe = Recipe::create($request->only([
            'recipe_name',
            'instructions',
            'prep_time',
            'servings',
            'photo'
        ]));

        // 建立每一個 ingredient
        foreach ($request->input('ingredients', []) as $ingredientData) {
            $recipe->ingredients()->create([
                'ingredient_name' => $ingredientData['ingredient_name'],
                'quantity' => $ingredientData['quantity'],
            ]);
        }

        return redirect()->route('recipes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
         // 獲取這個食譜的配料
        $ingredients = $recipe->ingredients;

        // 返回視圖，並傳遞食譜和配料數據
        return view('recipes.show', compact('recipe', 'ingredients'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        // 更新食譜
        $recipe->update($request -> validated());
        return redirect()->route('recipes.show', $recipe->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        // 刪除相關 ingredients
        $recipe->ingredients()->delete();

        // 刪除食譜
        $recipe->delete();

        return redirect()->route('recipes.index');
    }
}
