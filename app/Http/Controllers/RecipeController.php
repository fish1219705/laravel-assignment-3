<?php

namespace App\Http\Controllers;


use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class RecipeController extends Controller
{

    public function index()
    {
        $recipes = Recipe::with('user')->get();
        return view('admin.recipes.index', compact('recipes'));
    }


    public function show(Recipe $recipe)
    {
        $recipe->load('user', 'ingredients');
        return view('admin.recipes.show', compact('recipe'));
    }


    public function create()
    {
        return view('recipes.test-create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'recipe_name' => 'required|string|max:255',
            'instructions' => 'required',
            'prep_time' => 'required|integer',
            'servings' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.quantity' => 'required|string',
        ]);


        $recipe = new Recipe();
        $recipe->user_id = auth()->id();
        $recipe->recipe_name = $request->recipe_name;
        $recipe->instructions = $request->instructions;
        $recipe->prep_time = $request->prep_time;
        $recipe->servings = $request->servings;

        if ($request->hasFile('photo')) {
            $recipe->photo = $request->file('photo')->store('photos', 'public');
        }

        $recipe->save();


        foreach ($request->ingredients as $ingredientData) {
            $recipe->ingredients()->create([
                'ingredient_name' => $ingredientData['name'],
                'quantity' => $ingredientData['quantity'],
            ]);
        }

        return redirect()->route('recipes.my')->with('success', 'Recipe submitted!');
    }


    public function myRecipes()
    {
        $recipes = auth()->user()->recipes;
        return view('recipes.my', compact('recipes'));
    }

    public function editUserRecipe(Recipe $recipe)
    {
        // Check if this recipe belongs to current user
        if ($recipe->user_id !== auth()->id()) {
            return redirect()->route('recipes.my')->with('error', 'You can only edit your own recipes.');
        }

        $recipe->load('ingredients');
        return view('recipes.edit', compact('recipe'));
    }

    public function updateUserRecipe(Request $request, Recipe $recipe)
    {
        // Check if this recipe belongs to current user
        if ($recipe->user_id !== auth()->id()) {
            return redirect()->route('recipes.my')->with('error', 'You can only update your own recipes.');
        }

        $request->validate([
            'recipe_name' => 'required|string|max:255',
            'instructions' => 'required',
            'prep_time' => 'required|integer',
            'servings' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.quantity' => 'required|string',
        ]);

        $recipe->update([
            'recipe_name' => $request->recipe_name,
            'instructions' => $request->instructions,
            'prep_time' => $request->prep_time,
            'servings' => $request->servings,
        ]);

        if ($request->hasFile('photo')) {
            $recipe->photo = $request->file('photo')->store('photos', 'public');
            $recipe->save();
        }

        $recipe->ingredients()->delete();
        foreach ($request->ingredients as $ingredientData) {
            $recipe->ingredients()->create([
                'ingredient_name' => $ingredientData['name'],
                'quantity' => $ingredientData['quantity'],
            ]);
        }

        return redirect()->route('recipes.my')->with('success', 'Recipe updated successfully!');
    }

    public function home()
    {
        // First, try a simple response to see if the route works
        return 'Recipe controller home method is working!';

        $recipes = Recipe::with(['user', 'ingredients'])->latest()->get();
        // Debugging output
        if (request()->wantsJson()) {
            return $recipes;
        }
        return view('home', compact('recipes'));
    }


    public function edit(Recipe $recipe)
    {
        $recipe->load('ingredients');
        return view('admin.recipes.edit', compact('recipe'));
    }


    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'recipe_name' => 'required|string|max:255',
            'instructions' => 'required',
            'prep_time' => 'required|integer',
            'servings' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.quantity' => 'required|string',
        ]);

        $recipe->update([
            'recipe_name' => $request->recipe_name,
            'instructions' => $request->instructions,
            'prep_time' => $request->prep_time,
            'servings' => $request->servings,
        ]);

        if ($request->hasFile('photo')) {
            $recipe->photo = $request->file('photo')->store('photos', 'public');
            $recipe->save();
        }


        $recipe->ingredients()->delete();
        foreach ($request->ingredients as $ingredientData) {
            $recipe->ingredients()->create([
                'ingredient_name' => $ingredientData['name'],
                'quantity' => $ingredientData['quantity'],
            ]);
        }

        return redirect()->route('admin.recipes.index')->with('success', 'Recipe updated successfully!');
    }


    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('admin.recipes.index')->with('success', 'Recipe deleted successfully!');
    }
}
