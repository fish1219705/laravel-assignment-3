<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   class AddFieldsToRecipesTable extends Migration
   {
       public function up()
       {
           Schema::table('recipes', function (Blueprint $table) {
               if (!Schema::hasColumn('recipes', 'user_id')) {
                   $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->after('photo');
               }
               if (!Schema::hasColumn('recipes', 'approved')) {
                   $table->boolean('approved')->default(false)->after('user_id');
               }
               if (!Schema::hasColumn('recipes', 'created_at')) {
                   $table->timestamps();
               }
           });
       }

       public function down()
       {
           Schema::table('recipes', function (Blueprint $table) {
               $table->dropForeign(['user_id']);
               $table->dropColumn(['user_id', 'approved', 'created_at', 'updated_at']);
           });
       }
   }