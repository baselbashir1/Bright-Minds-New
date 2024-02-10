<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $categories = Category::all();

        if ($categories) {
            return response()->json($categories, 200);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    public function getCategoryById($id)
    {
        $category = Category::find($id);

        if ($category) {
            return response()->json($category, 200);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    public function addCategory(Request $request)
    {
        try {
            $validatedRequest = $request->validate([
                'name' => 'required',
            ]);

            Category::create([
                'name' => $validatedRequest['name'],
            ]);

            return response()->json(['success' => 'Category added successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
