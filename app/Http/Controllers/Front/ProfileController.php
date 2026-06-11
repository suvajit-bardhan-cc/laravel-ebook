<?php

namespace App\Http\Controllers\Front;

use App\Models\Book;
use App\Models\UserBookmark;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController
{
    public function index()
    {
        $user = Auth::user();
        return view('front.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('front.profile.edit', compact('user'));
    }

    public function update()
    {
        $user = Auth::user();
        $user->update(request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]));

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
}
