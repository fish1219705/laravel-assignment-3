<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Recipe; 
use App\Models\Ingredient;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $recipe1 = Recipe::create([
            'recipe_name' => 'Samosas',
            'instructions' => 'Fill dough with spiced potatoes and fry.',
            'prep_time' => 60,
            'servings' => 6,
            'photo' => '',
        ]);

        
        $recipe2 = Recipe::create([
            'recipe_name' => 'Salmon Fillet',
            'instructions' => 'Bake salmon with lemon and herbs.',
            'prep_time' => 30, // 分鐘
            'servings' => 4,
            'photo' => '', // 清空 photo 欄位
        ]);

        Ingredient::create([
            'recipe_id' => $recipe1->id,
            'ingredient_name' => 'Potatoes',
            'quantity' => '2 cups',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe1->id,
            'ingredient_name' => 'Spices (e.g., cumin, coriander)',
            'quantity' => 'To taste',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe2->id,
            'ingredient_name' => 'Salmon fillet',
            'quantity' => '4 pieces',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe2->id,
            'ingredient_name' => 'Lemon',
            'quantity' => '1',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe2->id,
            'ingredient_name' => 'Herbs (e.g., parsley, dill)',
            'quantity' => 'To taste',
        ]);

    }
}
