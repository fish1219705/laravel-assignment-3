<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Recipe;

// Return welcome view with recipes
Route::get('/', function () {
    $recipes = Recipe::with(['user', 'ingredients'])->latest()->get();
    return view('welcome', compact('recipes'));
})->name('home');

// Test route
Route::get('/test', function () {
    return '<h1>Test route works!</h1>';
});

// Check recipes
Route::get('/check-recipes', function () {
    $recipes = Recipe::with(['user', 'ingredients'])->get();
    return response()->json($recipes);
});

// Put the create route before the show route to avoid pattern conflicts
Route::middleware('auth')->group(function () {
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
});

// Frontend route to view a specific recipe
Route::get('/recipes/{recipe}', function (Recipe $recipe) {
    $recipe->load(['user', 'ingredients']);
    return view('recipes.show', compact('recipe'));
})->name('recipes.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-recipes', [RecipeController::class, 'myRecipes'])->name('recipes.my');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'editUserRecipe'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'updateUserRecipe'])->name('recipes.update');

});

// Admin Route
Route::middleware('admin')->group(function () {

    Route::get('/admin/recipes', [RecipeController::class, 'index'])->name('admin.recipes.index');
    Route::get('/admin/recipes/create', [RecipeController::class, 'create'])->name('admin.recipes.create');
    Route::post('/admin/recipes', [RecipeController::class, 'store'])->name('admin.recipes.store');
    Route::get('/admin/recipes/{recipe}', [RecipeController::class, 'show'])->name('admin.recipes.show');
    Route::get('/admin/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('admin.recipes.edit');
    Route::put('/admin/recipes/{recipe}', [RecipeController::class, 'update'])->name('admin.recipes.update');
    Route::delete('/admin/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('admin.recipes.destroy');


    Route::resource('admin/users', UserController::class)->names('admin.users');
});

// Test route for recipe debugging
Route::get('/recipe-test', function () {
    return view('test');
});

// Public test route for recipe create form
Route::get('/public-recipe-create', [RecipeController::class, 'create'])->name('public.recipes.create');

// Debug route - no controller, just direct output
Route::get('/debug-create', function () {
    return 'Debug create route works!';
})->name('debug.create');

// Alternative route for recipe create - authenticated but different URL pattern
Route::get('/recipe-maker', [RecipeController::class, 'create'])
    ->middleware('auth')
    ->name('recipe.maker');

require __DIR__ . '/auth.php';
