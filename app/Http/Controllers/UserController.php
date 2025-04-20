<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $userRecipes = Auth::user()->recipes()->with('ingredients')->paginate(10);
        return view('dashboard', compact('userRecipes'));
    }
}
