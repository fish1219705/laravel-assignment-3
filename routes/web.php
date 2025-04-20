<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// 公共路由
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 認證路由
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// 登錄用戶基礎路由
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 普通用戶路由
  
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index'); // 新增
        Route::get('/recipes/submit', [RecipeController::class, 'create'])->name('recipes.submit');
        Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
        Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show'); // 可選，查看單一食譜詳情
    });

    // 管理員路由
    Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // 用戶管理
        Route::prefix('/users')->name('users.')->group(function () {
            Route::get('/', [AdminController::class, 'userIndex'])->name('index');
            Route::get('/create', [AdminController::class, 'userCreate'])->name('create');
            Route::post('/', [AdminController::class, 'userStore'])->name('store');
            Route::get('/{user}/edit', [AdminController::class, 'userEdit'])->name('edit');
            Route::put('/{user}', [AdminController::class, 'userUpdate'])->name('update');
            Route::delete('/{user}', [AdminController::class, 'userDestroy'])->name('destroy');
        });

        // 食譜管理
        Route::prefix('/recipes')->name('recipes.')->group(function () {
            Route::get('/', [RecipeController::class, 'index'])->name('index');
            Route::get('/create', [RecipeController::class, 'create'])->name('create');
            Route::post('/', [RecipeController::class, 'store'])->name('store');
            Route::get('/{recipe}', [RecipeController::class, 'show'])->name('show');
            Route::get('/{recipe}/edit', [RecipeController::class, 'edit'])->name('edit');
            Route::put('/{recipe}', [RecipeController::class, 'update'])->name('update');
            Route::delete('/{recipe}', [RecipeController::class, 'destroy'])->name('destroy');
            Route::get('/{recipe}/approve', [RecipeController::class, 'approve'])->name('approve');
            Route::get('/{recipe}/image', [RecipeController::class, 'imageForm'])->name('image.form');
            Route::post('/{recipe}/image', [RecipeController::class, 'image'])->name('image');
        });

        // 食材管理
        Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');
    });


