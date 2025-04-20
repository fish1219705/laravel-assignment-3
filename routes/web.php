<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-recipes', [RecipeController::class, 'myRecipes'])->name('recipes.my');
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');

});

// Admin Route
Route::middleware('admin')->group(function () {
    
    Route::get('/admin/recipes', [RecipeController::class, 'index'])->name('admin.recipes.index');
    Route::get('/admin/recipes/create', [RecipeController::class, 'create'])->name('admin.recipes.create');
    Route::get('/admin/recipes/{recipe}', [RecipeController::class, 'show'])->name('admin.recipes.show');
    Route::get('/admin/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('admin.recipes.edit');
    Route::put('/admin/recipes/{recipe}', [RecipeController::class, 'update'])->name('admin.recipes.update');
    Route::delete('/admin/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('admin.recipes.destroy');

    
    Route::resource('admin/users', UserController::class)->names('admin.users');
});

require __DIR__.'/auth.php';
