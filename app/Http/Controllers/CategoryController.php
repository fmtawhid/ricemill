<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
            'permission:category_edit' => ['edit', 'update'],
            'permission:category_delete' => ['destroy'],
        ];
    }


    // Display a list of all categories
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::select(['id', 'name', 'slug', 'created_at']);
            return datatables()->of($categories)
                ->addIndexColumn() // Adds a serial number column
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('categories.edit', $row->slug) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('categories.destroy', $row->slug) . '" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions']) // Ensure buttons are rendered as HTML
                ->make(true);
        }
        

        return view('admin.categories.index');
    }


    // Show the form for creating a new category
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store a newly created category in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories|max:255',
        ]);

        // Create the new category
        $category = Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        // Return response for AJAX request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Category created successfully!',
                'category' => $category
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    // Show the form for editing a category
    public function edit($slug)
    {
        // Find category by slug
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('admin.categories.edit', compact('category'));
    }

    // Update a specific category
    public function update(Request $request, $slug)
    {
        // Validate input
        $category = Category::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'slug' => 'required|unique:categories,slug,' . $category->id,
        ]);

        // Update category data
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // Delete a category
    public function destroy($slug)
    {
        // Find the category by slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Delete the category
        $category->delete();

        // Return a success response
        return redirect()->route('categories.index')->with('success', 'Category Delete successfully!');
    }


    public function CategorySingle($slug)
    {
        // ক্যাটাগরি স্লাগ দিয়ে ক্যাটাগরি খুঁজে বের করুন
        $category = Category::where('slug', $slug)->first();

        // যদি ক্যাটাগরি না পাওয়া যায় তবে 404 ত্রুটি দেখান
        if (!$category) {
            abort(404, 'Category not found');
        }

        $posts = $category->posts; 

        // জনপ্রিয় পোস্ট (যেমন: সবচেয়ে বেশি ভিউ বা রেটিং)
        $popularPosts = $category->posts()->orderBy('views', 'desc')->take(10)->get();  
        $latestPosts = $category->posts()->latest()->take(10)->get(); 

        return view('news.catshow', compact('category', 'posts', 'latestPosts', 'popularPosts'));
    }

    public function postsBySubCategory($slug)
    {
        // Find the sub-category based on its slug
        $subCategory = SubCategory::where('slug', $slug)->firstOrFail();

        // Fetch posts belonging to this sub-category and are 'approved'
        $posts = Post::where('sub_category_id', $subCategory->id)->where('status', 'approved')->get();

        // Fetch the latest 5 posts in the sub-category
        $last_post = Post::where('sub_category_id', $subCategory->id)
                        ->where('status', 'approved')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

        // Fetch the top 5 popular posts in the sub-category (based on views)
        $popularPosts = Post::where('sub_category_id', $subCategory->id)
                            ->where('status', 'approved')
                            ->orderBy('views', 'desc')
                            ->take(5)
                            ->get();

        // Pass the sub-category, posts, latest posts, and popular posts to the view
        return view('news.subCatshow', compact('subCategory', 'posts', 'last_post', 'popularPosts'));
    }

}
