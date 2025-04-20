<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      
        $user = User::factory()->create([
            'id' => 1, 
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => 1, 
        ]);

   
        $recipe1 = Recipe::create([
            'user_id' => $user->id,
            'recipe_name' => 'Samosas',
            'instructions' => 'Fill dough with spiced potatoes and fry.',
            'prep_time' => 60,
            'servings' => 6,
            'photo' => '',
        ]);

        $recipe2 = Recipe::create([
            'user_id' => $user->id,
            'recipe_name' => 'Salmon Fillet',
            'instructions' => 'Bake salmon with lemon and herbs.',
            'prep_time' => 30,
            'servings' => 3,
            'photo' => '',
        ]);

        $recipe3 = Recipe::create([
            'user_id' => $user->id,
            'recipe_name' => 'Tiramisu',
            'instructions' => 'Layer coffee-soaked cake with mascarpone cream.',
            'prep_time' => 60,
            'servings' => 4,
            'photo' => '',
        ]);

        $recipe4 = Recipe::create([
            'user_id' => $user->id,
            'recipe_name' => 'Chicken Shawarma',
            'instructions' => 'Grill marinated chicken with spices.',
            'prep_time' => 50,
            'servings' => 3,
            'photo' => '',
        ]);

        $recipe5 = Recipe::create([
            'user_id' => $user->id,
            'recipe_name' => 'Pumpkin Pie',
            'instructions' => 'Bake spiced pumpkin filling in pie crust.',
            'prep_time' => 60,
            'servings' => 6,
            'photo' => '',
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

        Ingredient::create([
            'recipe_id' => $recipe3->id,
            'ingredient_name' => 'Mascarpone cheese',
            'quantity' => '1 cup',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe3->id,
            'ingredient_name' => 'Heavy cream',
            'quantity' => '1 cup',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe3->id,
            'ingredient_name' => 'Coffee',
            'quantity' => '1 cup',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe3->id,
            'ingredient_name' => 'Cocoa powder',
            'quantity' => '2 tablespoons',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe4->id,
            'ingredient_name' => 'Chicken',
            'quantity' => '2 breasts',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe4->id,
            'ingredient_name' => 'Olive oil',
            'quantity' => '2 tablespoons',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe4->id,
            'ingredient_name' => 'Garlic',
            'quantity' => '2 cloves',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe4->id,
            'ingredient_name' => 'Tomatoes',
            'quantity' => '4',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe5->id,
            'ingredient_name' => 'Pumpkin puree',
            'quantity' => '2 cups',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe5->id,
            'ingredient_name' => 'Sugar',
            'quantity' => '1 cup',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe5->id,
            'ingredient_name' => 'Cinnamon',
            'quantity' => '1 teaspoon',
        ]);

        Ingredient::create([
            'recipe_id' => $recipe5->id,
            'ingredient_name' => 'Nutmeg',
            'quantity' => '1/2 teaspoon',
        ]);
    }
}
