<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorecategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function fetchCategoryData(){
        $category= category::all();
        return view('category.index', compact('category'));
    }
    public function insertCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_abbrivation' => 'required'
        ]);

        if ($request->id) {
            $category = Category::find($request->id);
            if ($category) {
                $category->category_name = $request->category_name;
                $category->category_abbrivation = $request->category_abbrivation;
                $category->save();
                return response()->json(['success' => true, 'message' => 'Category updated successfully']);
            }
            return response()->json(['success' => false, 'message' => 'Category not found']);
        } else {
            Category::create([
                'category_name' => $request->category_name,
                'category_abbrivation' => $request->category_abbrivation,
            ]);
            return response()->json(['success' => true, 'message' => 'Category added successfully']);
        }
    }

    public function editCategory($id){
        $category = Category::find($id);
        if ($category) {
            return response()->json(['success' => true, 'data' => $category]);
        }
        return response()->json(['success' => false, 'message' => 'category not found']);
    }

    public function updateCategory(Request $request, $id) {
        $category = Category::find($id);
        if ($category) {
            $category->category_name = $request->category_name;
            $category->category_abbrivation = $request->category_abbrivation;
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Category not found']);
    }

    public function deleteCategory(Request $request, $id) {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['success' => true]);
    }

}
