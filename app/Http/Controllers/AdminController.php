<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingRecipes = \App\Models\Recipe::pending()->with('user')->get();
        return view('admin.dashboard', compact('pendingRecipes'));
    }

    public function userIndex()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function userCreate()
    {
        return view('admin.users.create');
    }

    public function userStore(Request $request)
    {
        $attributes = $request->validate([
            'first' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::create($attributes);

        return redirect()->route('users.index')->with('message', 'User has been added!');
    }

    public function userEdit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function userUpdate(Request $request, User $user)
    {
        $attributes = $request->validate([
            'first' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $user->update([
            'first' => $attributes['first'],
            'last' => $attributes['last'],
            'email' => $attributes['email'],
            'role' => $attributes['role'],
            'password' => $attributes['password'] ?: $user->password,
        ]);

        return redirect()->route('users.index')->with('message', 'User has been edited!');
    }

    public function userDestroy(User $user)
    {
        if ($user->id == Auth::id()) {
            return redirect()->route('users.index')->with('message', 'Cannot delete your own user account!');
        }

        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return redirect()->route('s.index')->with('message', 'Cannot delete the last admin!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('message', 'User has been deleted!');
    }
}
