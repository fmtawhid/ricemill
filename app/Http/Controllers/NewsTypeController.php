<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsType;

class NewsTypeController extends Controller
{
    public function __construct()
    {
        foreach (self::middlewareList() as $middleware => $methods) {
            $this->middleware($middleware)->only($methods);
        }
    }

    public static function middlewareList(): array
    {
        return [
            'permission:category_view' => ['index'],
            'permission:category_add' => ['create', 'store'],
        ];
    }
    // Display a list of all categories
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $newsType = NewsType::select(['id', 'name', 'slug', 'created_at']);
            return datatables()->of($newsType)
                ->addIndexColumn() // Adds a serial number column
                // ->addColumn('actions', function ($row) {
                //     return '
                //         <a href="' . route('news_types.edit', $row->slug) . '" class="btn btn-sm btn-warning">Edit</a>
                //         <form action="' . route('news_types.destroy', $row->slug) . '" method="POST" style="display:inline-block;">
                //             <input type="hidden" name="_token" value="' . csrf_token() . '">
                //             <input type="hidden" name="_method" value="DELETE">
                //             <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                //         </form>
                //     ';
                // })
                // ->rawColumns(['actions']) // Ensure buttons are rendered as HTML
                ->make(true);
        }

        return view('admin.news_types.index');
    }


    // Show the form for creating a new category
    public function create()
    {
        return view('admin.news_types.create');
    }

    // Store a newly created category in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:news_types|max:255',
            'slug' => 'required|unique:news_types|max:255',
        ]);

        // Create the new category
        $category = NewsType::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        // Return response for AJAX request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'News Type created successfully!',
                'category' => $category
            ]);
        }

        return redirect()->route('news_types.index')->with('success', 'News Type created successfully!');
    }

    // // Show the form for editing a category
    // public function edit($slug)
    // {
    //     // Find  by slug
    //     $newsType = NewsType::where('slug', $slug)->firstOrFail();
    //     return view('admin.news_types.edit', compact('newsType'));
    // }

    // // Update a specific category
    // public function update(Request $request, $slug)
    // {
    //     // Validate input
    //     $category = NewsType::where('slug', $slug)->firstOrFail();

    //     $request->validate([
    //         'name' => 'required|unique:news_types,name,' . $category->id,
    //         'slug' => 'required|unique:news_types,slug,' . $category->id,
    //     ]);

    //     // Update category data
    //     $category->update([
    //         'name' => $request->name,
    //         'slug' => $request->slug,
    //     ]);

    //     return redirect()->route('news_types.index')->with('success', 'Category updated successfully!');
    // }

    // // Delete a category
    // public function destroy($slug)
    // {
    //     // Find the category by slug
    //     $category = NewsType::where('slug', $slug)->firstOrFail();

    //     // Delete the category
    //     $category->delete();

    //     // Return a success response
    //     return redirect()->route('news_types.index')->with('success', 'Post Delete successfully!');
    // }
}
