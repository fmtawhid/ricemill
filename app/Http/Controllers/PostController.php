<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\NewsType;
use Illuminate\Http\Request;
use DataTables;

class PostController extends Controller
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
            'permission:post_view' => ['index', 'pending'],
            'permission:post_add' => ['create', 'store'],
            'permission:post_edit' => ['edit', 'update'],
            'permission:post_delete' => ['destroy'],
        ];
    }

    
    // Display a list of all posts
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Get the logged-in user
            $user = auth()->user();
    
            // Fetch posts that belong to the logged-in user
            $posts = Post::select(['id', 'title', 'category_id', 'status', 'slug', 'keywords', 'tags', 'short_summary', 'description', 'video_link', 'image', 'date', 'created_at'])
                ->where('status', 'approved')
                ->where('user_id', $user->id);  // Filter by user_id
    
            return DataTables::of($posts)
                ->addIndexColumn()
                ->addColumn('category_name', function ($row) {
                    return $row->category ? $row->category->name : 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    return '
                        
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    
        return view('admin.posts.index');
    }
    


    public function pending(Request $request)
    {
        if ($request->ajax()) {
            // Fetch all posts with the 'pending' status
            $posts = Post::select(['id', 'title', 'category_id', 'status', 'slug', 'keywords', 'tags', 'short_summary', 'description', 'video_link', 'image', 'date', 'created_at'])
                ->where('status', 'pending');  // Filter only posts with 'pending' status

            return DataTables::of($posts)
                ->addIndexColumn() // Add index column
                ->addColumn('category_name', function ($row) {
                    return $row->category ? $row->category->name : 'N/A'; // Get category name
                })
                ->addColumn('actions', function ($row) {
                    // Add action buttons for edit and delete
                    return '
                        <a href="' . route('posts.edit', $row->slug) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('posts.destroy', $row->slug) . '" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['actions']) // Enable raw HTML rendering for the actions column
                ->make(true); // Return the DataTable JSON response
        }

        return view('admin.posts.pending'); // Return the view for the pending posts index page
    }

    public function create()
    {
        // Fetch all categories with their subcategories
        $categories = Category::with('subCategories')->get();
        $newsTypes = NewsType::all();
        return view('admin.posts.create', compact('categories', 'newsTypes'));
    }
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|unique:posts|max:200',
            'slug' => 'required|unique:posts|max:200',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'status' => 'required|in:pending,approved',
            'image' => 'nullable|string',
            'keywords' => 'nullable|string',
            'tags' => 'nullable|string',
            'short_summary' => 'nullable|string',
            'description' => 'nullable|string',
            'video_link' => 'nullable|string',
            'author_name' => 'nullable|string',
            'date' => 'required|date',
            'news_type_id' => 'nullable|exists:news_types,id',
        ]);

        // Create a new post and assign user_id
        $post = new Post();
        $post->user_id = auth()->id(); // Assign the logged-in user ID
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->keywords = $request->keywords;
        $post->tags = $request->tags;
        $post->short_summary = $request->short_summary;
        $post->description = $request->description;
        $post->video_link = $request->video_link;
        $post->author_name = $request->author_name;
        $post->image = $imageName ?? null;
        $post->category_id = $request->category_id;
        $post->sub_category_id = $request->sub_category_id;
        $post->status = $request->status ?? 'pending';
        $post->date = $request->date;

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }


// Fetch sub-categories based on the selected category
public function getSubCategories($categoryId)
{
    $subCategories = SubCategory::where('category_id', $categoryId)->get();
    
    return response()->json(['subCategories' => $subCategories]);
}














    

public function edit($slug)
{
    // Fetch the post by slug and ensure it's owned by the logged-in user
    $post = Post::where('slug', $slug)->where('user_id', auth()->id())->firstOrFail();

    $categories = Category::all();
    $subCategories = SubCategory::where('category_id', $post->category_id)->get();
    $newsTypes = NewsType::all();

    return view('admin.posts.edit', compact('post', 'categories', 'subCategories', 'newsTypes'));
}

public function update(Request $request, $slug)
{
    // Validate form data excluding current post's title and slug
    $request->validate([
        'title' => 'required|unique:posts,title,' . $slug . ',slug|max:200',
        'slug' => 'required|unique:posts,slug,' . $slug . ',slug|max:200',
        'category_id' => 'required|exists:categories,id',
        'sub_category_id' => 'nullable|exists:sub_categories,id',
        'status' => 'required|in:pending,approved',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'keywords' => 'nullable|string',
        'tags' => 'nullable|string',
        'short_summary' => 'nullable|string',
        'description' => 'nullable|string',
        'video_link' => 'nullable|string',
        'author_name' => 'nullable|string',
        'date' => 'required|date',
    ]);

    // Fetch the post by slug and ensure it's owned by the logged-in user
    $post = Post::where('slug', $slug)->where('user_id', auth()->id())->firstOrFail();

    // Handle image upload (if exists)
    if ($request->hasFile('image')) {
        if ($post->image) {
            unlink(public_path('img/posts/' . $post->image));
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img/posts'), $imageName);
        $post->image = $imageName;
    }

    // Update the post's fields
    $post->title = $request->title;
    $post->slug = $request->slug;
    $post->keywords = $request->keywords;
    $post->tags = $request->tags;
    $post->short_summary = $request->short_summary;
    $post->description = $request->description;
    $post->video_link = $request->video_link;
    $post->author_name = $request->author_name;
    $post->category_id = $request->category_id;
    $post->sub_category_id = $request->sub_category_id;
    $post->status = $request->status ?? 'pending';
    $post->date = $request->date;

    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
}




    public function destroy($slug)
    {
        // Find the post by slug
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post Delete successfully!');
    }





}
