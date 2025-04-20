<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('ingredients')
            ->when(!Auth::user()->isAdmin(), function ($query) {
                $query->where('approved', true);
            })
            ->paginate(10);
            
        if (Auth::user()->isAdmin()) {
            return view('admin.recipes.index', compact('recipes'));
        }
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.recipes.create');
        }
        return view('recipes.create');
    }

    public function store(StoreRecipeRequest $request)
    {
        $path = null;

        try {
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('photos', 'public');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['photo' => 'Failed to upload photo.']);
        }

        $data = $request->only([
            'recipe_name',
            'instructions',
            'prep_time',
            'servings',
        ]);
        $data['photo'] = $path;
        $data['user_id'] = Auth::id();
        $data['approved'] = Auth::user()->isAdmin();
        $recipe = Recipe::create($data);

        foreach ($request->input('ingredients', []) as $ingredientData) {
            $recipe->ingredients()->create([
                'ingredient_name' => $ingredientData['ingredient_name'],
                'quantity' => $ingredientData['quantity'],
            ]);
        }

        if (Auth::user()->isAdmin()) {
            return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
        }
        return redirect()->route('dashboard')->with('success', 'Recipe submitted for review.');
    }

    public function show(Recipe $recipe)
    {
        if (!$recipe->approved && (!$recipe->user || $recipe->user_id !== Auth::id())) {
            abort(403, 'This recipe is not approved yet.');
        }

        $ingredients = $recipe->ingredients;
        return view('recipes.show', compact('recipe', 'ingredients'));
    }

    public function edit(Recipe $recipe)
    {
        $ingredients = $recipe->ingredients;
        return view('admin.recipes.edit', compact('recipe', 'ingredients'));
    }

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

        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully.');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->ingredients()->delete();
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }

    public function approve(Recipe $recipe)
    {
        $recipe->update(['approved' => true]);
        return redirect()->route('admin.dashboard')->with('success', 'Recipe approved successfully.');
    }

    public function imageForm(Recipe $recipe)
    {
        return view('recipes.image', compact('recipe'));
    }

    public function image(Request $request, Recipe $recipe)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            if ($request->hasFile('photo')) {
                if ($recipe->photo) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($recipe->photo);
                }
                $path = $request->file('photo')->store('photos', 'public');
                $recipe->update(['photo' => $path]);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['photo' => 'Failed to upload photo.']);
        }

        return redirect()->route('recipes.index')->with('success', 'Image uploaded successfully.');
    }
}
