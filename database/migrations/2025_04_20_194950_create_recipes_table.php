<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('recipe_name');
            $table->text('instructions');
            $table->integer('prep_time')->nullable(); // 單位：分鐘
            $table->integer('servings')->nullable();  // 幾人份
            $table->string('photo')->nullable();      // 儲存圖片路徑
            $table->boolean('approved')->default(false); // 管理員審核
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
