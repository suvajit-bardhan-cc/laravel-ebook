<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        $tag = Tag::create([
            'name' => $validated['name'],
            'slug' => str()->slug($validated['name']),
            'status' => 'active',
        ]);

        return response()->json([
            'success' => true,
            'tag' => $tag,
            'message' => 'Tag created successfully'
        ]);
    }
}
