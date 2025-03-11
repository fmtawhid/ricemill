<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    // Display a list of all categories
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::select(['id', 'name', 'note', 'created_at'])
                ->where('user_id', auth()->id()); // Filter by user_id

            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('actions', function ($category) {
                    return '
                        <a href="' . route('categories.edit', ['category' => $category->id, 'user_id' => auth()->id()]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('categories.destroy', ['category' => $category->id, 'user_id' => auth()->id()]) . '" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions']) // Enable raw HTML rendering for the actions column
                ->make(true);
        }

        return view('admin.categories.index');
    }

    // Show the form to create a new category
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'note' => 'nullable|string',
        ]);

        // Create a new category
        $category = new Category();
        $category->name = $request->name;
        $category->note = $request->note;
        $category->user_id = auth()->id(); // Assign the logged-in user ID
        $category->save();

        return redirect()->route('categories.index', ['user_id' => auth()->id()])->with('success', 'Category created successfully!');
    }

    // Show the form to edit an existing category
    public function edit($user_id, $id)
    {
        $category = Category::findOrFail($id);

        // Ensure the category belongs to the current user
        if ($category->user_id !== auth()->id()) {
            return redirect()->route('categories.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        return view('admin.categories.edit', compact('category'));
    }

    // Update an existing category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'note' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);

        // Ensure the logged-in user owns this category
        if ($category->user_id !== auth()->id()) {
            return redirect()->route('categories.index', ['user_id' => auth()->id()])->with('error', 'Unauthorized');
        }

        $category->update([
            'name' => $request->name,
            'note' => $request->note,
        ]);

        return redirect()->route('categories.index', ['user_id' => auth()->id()])->with('success', 'Category updated successfully!');
    }

    // Delete a category
    public function destroy($user_id, $id)
    {
        $category = Category::findOrFail($id);

        // Ensure the logged-in user owns this category
        if ($category->user_id !== auth()->id()) {
            return redirect()->route('categories.index')->with('error', 'Unauthorized');
        }

        $category->delete();

        return redirect()->route('categories.index', ['user_id' => auth()->id()])->with('success', 'Category deleted successfully!');
    }
}
