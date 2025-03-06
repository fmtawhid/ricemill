<?php

// app/Http/Controllers/SubCategoryController.php
namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    // Display a list of all subcategories
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $subCategories = SubCategory::with('category')->select(['id', 'name', 'slug', 'category_id', 'created_at']);
            return datatables()->of($subCategories)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('subcategories.edit', $row->slug) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('subcategories.destroy', $row->slug) . '" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.subcategories.index');
    }

    // Show the form for creating a new subcategory
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }

    // Store a newly created subcategory in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories|max:255',
            'slug' => 'required|unique:sub_categories|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subCategory = SubCategory::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'SubCategory created successfully!',
                'subCategory' => $subCategory
            ]);
        }

        return redirect()->route('subcategories.index')->with('success', 'SubCategory created successfully!');
    }

    // Show the form for editing a subcategory
    public function edit($slug)
    {
        $subCategory = SubCategory::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subCategory', 'categories'));
    }

    // Update a specific subcategory
    public function update(Request $request, $slug)
    {
        $subCategory = SubCategory::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|unique:sub_categories,name,' . $subCategory->id,
            'slug' => 'required|unique:sub_categories,slug,' . $subCategory->id,
            'category_id' => 'required|exists:categories,id',
        ]);

        $subCategory->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('subcategories.index')->with('success', 'SubCategory updated successfully!');
    }

    // Delete a subcategory
    public function destroy($slug)
    {
        $subCategory = SubCategory::where('slug', $slug)->firstOrFail();
        $subCategory->delete();

        return redirect()->route('subcategories.index')->with('success', 'SubCategory deleted successfully!');
    }
}
