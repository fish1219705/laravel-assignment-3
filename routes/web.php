<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\UsersController;


Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/console/login', [ConsoleController::class, 'loginForm'])->name('console.login.form');
    Route::post('/console/login', [ConsoleController::class, 'login'])->name('console.login');
});

Route::middleware('auth')->group(function () {

    Route::get('/console/dashboard', [ConsoleController::class, 'dashboard'])->name('console.dashboard');
    Route::get('/console/logout', [ConsoleController::class, 'logout'])->name('console.logout');
    

    Route::prefix('/console/users')->name('console.users.')->group(function () {
        Route::get('/list', [UsersController::class, 'list'])->name('list');
        Route::get('/add', [UsersController::class, 'addForm'])->name('add.form');
        Route::post('/add', [UsersController::class, 'add'])->name('add');
        Route::get('/edit/{user:id}', [UsersController::class, 'editForm'])->name('edit.form')->where('user', '[0-9]+');
        Route::post('/edit/{user:id}', [UsersController::class, 'edit'])->name('edit')->where('user', '[0-9]+');
        Route::get('/delete/{user:id}', [UsersController::class, 'delete'])->name('delete')->where('user', '[0-9]+');
    });
    

    Route::prefix('/console/recipes')->name('recipes.')->middleware('auth')->group(function () {

        Route::get('/', [RecipeController::class, 'index'])->name('index');          // 列表
        Route::get('/create', [RecipeController::class, 'create'])->name('create'); // 新增表单
        Route::post('/', [RecipeController::class, 'store'])->name('store');        // 新增提交
        Route::get('/{recipe}', [RecipeController::class, 'show'])->name('show');   
        Route::get('/{recipe}/edit', [RecipeController::class, 'edit'])->name('edit'); // 编辑表单
        Route::put('/{recipe}', [RecipeController::class, 'update'])->name('update');  // 编辑提交
        Route::delete('/{recipe}', [RecipeController::class, 'destroy'])->name('destroy'); // 删除
        
        
        Route::get('/{recipe}/image', [RecipeController::class, 'imageForm'])->name('image.form');
        Route::post('/{recipe}/image', [RecipeController::class, 'image'])->name('image');
    });


    Route::delete('/console/ingredients/{ingredient}', [IngredientController::class, 'destroy'])
        ->name('ingredients.destroy')
        ->middleware('auth');
});

