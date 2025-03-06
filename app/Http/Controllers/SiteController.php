<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Gallery;


class SiteController extends Controller
{
    
    
    public function index()
    {
        // সমস্ত পোস্ট নিয়ে আসা যেগুলির স্ট্যাটাস 'approved'
        $posts = Post::where('status', 'approved')->get();
        $posts = $posts->shuffle(); // শাফল করা

        // সর্বশেষ ৫টি 'approved' পোস্ট
        $last_post = Post::where('status', 'approved')->orderBy('created_at', 'desc')->take(5)->get();
        $last_post = $last_post->shuffle();

        // জনপ্রিয় পোস্ট (যেগুলোর ভিউ বেশি)
        $popularPosts = Post::where('status', 'approved')->orderBy('views', 'desc')->take(5)->get();
        $popularPosts = $popularPosts->shuffle(); 

        // national ক্যাটাগরি
        $nationalCat = Category::where('slug', 'national')->first();
        $nationalPosts = $nationalCat ? $nationalCat->posts()->where('status', 'approved')->get() : collect();
        $nationalPosts = $nationalPosts->shuffle(); 

        // politics ক্যাটাগরি
        $politicsCat = Category::where('slug', 'politics')->first();
        $politicsPosts = $politicsCat ? $politicsCat->posts()->where('status', 'approved')->get() : collect();
        $politicsPosts = $politicsPosts->shuffle(); 

        // international ক্যাটাগরি
        $internationalCat = Category::where('slug', 'international')->first();
        $internationalPosts = $internationalCat ? $internationalCat->posts()->where('status', 'approved')->get() : collect();
        $internationalPosts = $internationalPosts->shuffle(); 

        // campus ক্যাটাগরি
        $campusCat = Category::where('slug', 'campus')->first();
        $campusPosts = $campusCat ? $campusCat->posts()->where('status', 'approved')->get() : collect();
        $campusPosts = $campusPosts->shuffle(); 

        // sports ক্যাটাগরি
        $sportsCat = Category::where('slug', 'sports')->first();
        $sportsPosts = $sportsCat ? $sportsCat->posts()->where('status', 'approved')->get() : collect();
        $sportsPosts = $sportsPosts->shuffle(); 

        $mediaCat = Category::where('slug', 'media')->first();
        $mediaPosts = $mediaCat ? $mediaCat->posts()->where('status', 'approved')->get() : collect();
        $mediaPosts = $mediaPosts->shuffle(); 

        $educationCat = Category::where('slug', 'education')->first();
        $educationPosts = $educationCat ? $educationCat->posts()->where('status', 'approved')->get() : collect();
        $educationPosts = $educationPosts->shuffle(); 

        // ICT ক্যাটাগরি
        $ictCat = Category::where('slug', 'Information-technology')->first();
        $ictPosts = $ictCat ? $ictCat->posts()->where('status', 'approved')->get() : collect();
        $ictPosts = $ictPosts->shuffle(); 

        $lawCat = Category::where('slug', 'Law-and-Courts')->first();
        $lawPosts = $lawCat ? $lawCat->posts()->where('status', 'approved')->get() : collect();
        $lawPosts = $lawPosts->shuffle();

        $saradeshCat = Category::where('slug', 'saradesh')->first();
        $saradeshPosts = $saradeshCat ? $saradeshCat->posts()->where('status', 'approved')->get() : collect();
        $saradeshPosts = $saradeshPosts->shuffle();

        $postsWithVideo = Post::where('status', 'approved')->whereNotNull('video_link')->orderBy('views', 'desc')->get();
        $postsWithVideo = $postsWithVideo->shuffle();

        $postsWithNewsType3 = Post::where('news_type_id', 3)->where('status', 'approved')->get();
        $postsWithNewsType3 = $postsWithNewsType3->shuffle(); 
        $postsWithNewsType4 = Post::where('news_type_id', 4)->where('status', 'approved')->get();
        $postsWithNewsType4 = $postsWithNewsType4->shuffle();

        $galleryImages = Gallery::latest()->get();
        $galleryImages = $galleryImages->shuffle(); 


        
        


        // ভিউতে প্রয়োজনীয় ডেটা পাঠানো
        return view('news.index', compact(
            'posts', 
            'last_post', 
            'popularPosts',
            'nationalPosts', 
            'politicsPosts', 
            'internationalPosts', 
            'campusPosts', 
            'sportsPosts', 
            'mediaPosts', 
            'educationPosts', 
            'ictPosts', 
            'lawPosts',
            'saradeshPosts',
            'postsWithVideo',
            'postsWithNewsType3',
            'postsWithNewsType4',
            'galleryImages',
        ));
    }
    
    
    
    
    public function single($slug)
    {
        // Fetch the single post from the database using the provided ID
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->increment('views');
        // Check if the post exists, else return a 404 error
        if (!$post) {
            abort(404);
        }
        // Get the category of the post (no shuffle needed here)
        $category = $post->category;

        // Get the latest 5 posts in the same category
        $latestPosts = Post::where('category_id', $category->id)
            ->where('status', 'approved') // Assuming you only want approved posts
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $latestPosts = $latestPosts->shuffle(); // Shuffle the posts collection

        // Get the popular posts in the same category (based on views)
        $popularPosts = Post::where('category_id', $category->id)
            ->where('status', 'approved')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
        $popularPosts = $popularPosts->shuffle(); // Shuffle the posts collection

        // Get posts with news_type_id 5 and approved status
        $postsWithNewsType5 = Post::where('news_type_id', 5)
            ->where('status', 'approved')
            ->get();
        $postsWithNewsType5 = $postsWithNewsType5->shuffle(); // Shuffle the posts collection

        // Pass the post data to the view
        return view('news.single', compact('post', 'latestPosts', 'popularPosts', 'postsWithNewsType5' ));
    }





    // সার্চ রেজাল্ট পেজ
    public function searchResults(Request $request)
    {
        $query = $request->input('query'); // সার্চ টার্ম

        // পোস্ট মডেলে সার্চ করা
        $results = Post::where('title', 'like', '%' . $query . '%')
                    ->orWhere('short_summary', 'like', '%' . $query . '%')
                    ->get();

        return view('news.result', compact('results', 'query'));
    }

}
