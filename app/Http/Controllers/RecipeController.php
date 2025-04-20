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
        $recipes = Recipe::with('ingredients')->get(); // 把 ingredients 一起抓來
        return view('recipes.index', compact('recipes'));
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
        $path = null;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
        }

        $data = $request->only([
            'recipe_name',
            'instructions',
            'prep_time',
            'servings',
        ]);
        $data['photo'] = $path;
        $recipe = Recipe::create($data);

        foreach ($request->input('ingredients', []) as $ingredientData) {
            $recipe->ingredients()->create([
                'ingredient_name' => $ingredientData['ingredient_name'],
                'quantity' => $ingredientData['quantity'],
            ]);
        }

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {

        $ingredients = $recipe->ingredients;

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
        $recipe->update($request->only([
            'recipe_name',
            'instructions',
            'prep_time',
            'servings',
        ]));

        
        $recipe->ingredients()->delete(); 
        foreach ($request->input('ingredients', []) as $ingredientData) {
            $recipe->ingredients()->create([
                'ingredient_name' => $ingredientData['ingredient_name'],
                'quantity' => $ingredientData['quantity'],
            ]);
        }

        return redirect()->route('recipes.index', $recipe->id)
                    ->with('success', 'Recipe updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
    
        $recipe->ingredients()->delete();

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }
}
