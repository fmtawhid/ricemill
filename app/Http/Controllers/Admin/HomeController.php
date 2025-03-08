<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Post;
use App\Models\Gallery;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        // Total Posts count
        $totalPosts = Post::count();
        
        // Posts from the last month
        $lastMonthPosts = Post::where('created_at', '>=', Carbon::now()->subMonth())->count();
        
        // Pending Posts count
        $pendingPosts = Post::where('status', 'pending')->count();
        
        // Posts pending today
        $todayPendingPosts = Post::where('status', 'pending')
                                ->whereDate('created_at', Carbon::today())
                                ->count();
        
        // Total Gallery images count
        $totalImages = Gallery::count();
        
        // Gallery images uploaded last month
        $lastMonthImages = Gallery::where('created_at', '>=', Carbon::now()->subMonth())->count();

        // Passing data to the view
        return view('admin.dashboard.index', [
            'totalPosts' => $totalPosts,
            'lastMonthPosts' => $lastMonthPosts,
            'pendingPosts' => $pendingPosts,
            'todayPendingPosts' => $todayPendingPosts,
            'totalImages' => $totalImages,
            'lastMonthImages' => $lastMonthImages
        ]);
    }


}
