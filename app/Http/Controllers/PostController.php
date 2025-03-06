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
            // Select all columns you need
            $posts = Post::select(['id', 'title', 'category_id', 'status', 'slug', 'keywords', 'tags', 'short_summary', 'description', 'video_link', 'image', 'date', 'created_at'])->where('status', 'approved');;
            
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
        

        return view('admin.posts.index'); // Return the view for the posts index page
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
        'image' => 'nullable|string',  // Accept base64 data for the image (This was the issue)
        'keywords' => 'nullable|string',
        'tags' => 'nullable|string',
        'short_summary' => 'nullable|string',
        'description' => 'nullable|string',
        'video_link' => 'nullable|string',
        'author_name' => 'nullable|string',
        'date' => 'required|date',
        'news_type_id' => 'nullable|exists:news_types,id', // Validate the news_type_id
    ]);

    // Handle the cropped image (base64)
    if ($request->has('cropped_image')) {
        $imageData = $request->input('cropped_image'); // Base64 string
        $imageData = preg_replace('#^data:image/\w+;base64,#i', '', $imageData); // Remove base64 prefix
        $imageName = time() . '.png'; // Generate a unique name for the image

        // Decode and save the cropped image
        $path = public_path('img/posts/' . $imageName);
        file_put_contents($path, base64_decode($imageData)); // Save the decoded image data
    } else {
        $imageName = null;  // In case no image was provided
    }

    // Create a new post
    $post = new Post();
    $post->title = $request->title;
    $post->slug = $request->slug;
    $post->keywords = $request->keywords;
    $post->tags = $request->tags;
    $post->short_summary = $request->short_summary;
    $post->description = $request->description;
    $post->video_link = $request->video_link;
    $post->author_name = $request->author_name;
    $post->image = $imageName; // Save the image path if available
    $post->category_id = $request->category_id;
    $post->sub_category_id = $request->sub_category_id;
    $post->status = $request->status ?? 'pending';
    $post->date = $request->date;

    // Save the post
    $post->save();

    // Assign the selected news_type_id
    if ($request->has('news_type_id')) {
        $post->news_type_id = $request->news_type_id; // Assign the selected news type
        $post->save(); // Save the post with the news type
    }

    return redirect()->route('posts.create')->with('success', 'Post created successfully!');
}

// public function store(Request $request)
// {
//     // Validate the form data
//     $request->validate([
//         'title' => 'required|unique:posts|max:200',
//         'slug' => 'required|unique:posts|max:200',
//         'category_id' => 'required|exists:categories,id',
//         'sub_category_id' => 'nullable|exists:sub_categories,id',
//         'status' => 'required|in:pending,approved',
//         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         'keywords' => 'nullable|string',
//         'tags' => 'nullable|string',
//         'short_summary' => 'nullable|string',
//         'description' => 'nullable|string',
//         'video_link' => 'nullable|string',
//         'date' => 'required|date',
//         'news_type_id' => 'nullable|exists:news_types,id', // Validate the news_type_id
//     ]);

//     // Handle image upload
//     if ($request->hasFile('image')) {
//         $imageName = time() . '.' . $request->image->extension();
//         $request->image->move(public_path('img/posts'), $imageName);
//     } else {
//         $imageName = null;
//     }

//     // Create a new post
//     $post = new Post();
//     $post->title = $request->title;
//     $post->slug = $request->slug;
//     $post->keywords = $request->keywords;
//     $post->tags = $request->tags;
//     $post->short_summary = $request->short_summary;
//     $post->description = $request->description;
//     $post->video_link = $request->video_link;
//     $post->image = $imageName;
//     $post->category_id = $request->category_id;
//     $post->sub_category_id = $request->sub_category_id;
//     $post->status = $request->status ?? 'pending';
//     $post->date = $request->date;

//     // Save the post
//     $post->save();

//     // Assign the selected news_type_id
//     if ($request->has('news_type_id')) {
//         $post->news_type_id = $request->news_type_id; // Assign the selected news type
//         $post->save(); // Save the post with the news type
//     }

//     return redirect()->route('posts.index')->with('success', 'Post created successfully!');
// }

// Fetch sub-categories based on the selected category
public function getSubCategories($categoryId)
{
    $subCategories = SubCategory::where('category_id', $categoryId)->get();
    
    return response()->json(['subCategories' => $subCategories]);
}














    

public function edit($slug)
{
    // Fetch the post using the slug
    $post = Post::where('slug', $slug)->firstOrFail();
    $categories = Category::all(); // Fetch all categories for the dropdown
    $subCategories = SubCategory::where('category_id', $post->category_id)->get(); // Get subcategories for the selected category
    $newsTypes = NewsType::all();
    return view('admin.posts.edit', compact('post', 'categories', 'subCategories', 'newsTypes'));
}
public function update(Request $request, $slug)
{
    // Validate the form data, excluding the current post's title and slug
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

    // Fetch the existing post using the slug
    $post = Post::where('slug', $slug)->firstOrFail();

    // Handle image upload (if exists)
    if ($request->hasFile('image')) {
        // Delete the old image if a new one is uploaded
        if ($post->image) {
            unlink(public_path('img/posts/' . $post->image));
        }

        // Save the new image
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
    $post->sub_category_id = $request->sub_category_id;  // Store the selected sub-category
    $post->status = $request->status ?? 'pending';
    $post->date = $request->date;
    // Update the selected news_type
    if ($request->has('news_type_id')) {
        $post->news_type_id = $request->news_type_id;
    }
    $post->save();

    return redirect()->route('posts.pending')->with('success', 'Post updated successfully!');
}



    public function destroy($slug)
    {
        // Find the post by slug
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post Delete successfully!');
    }





}
