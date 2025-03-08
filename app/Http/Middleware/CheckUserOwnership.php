<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserOwnership
{
    public function handle(Request $request, Closure $next)
    {
        // Get the logged-in user
        $user = Auth::user();

        // Get the user_id from the route or from the post
        $userId = $request->route('user_id');  // Assuming you're passing user_id as part of the route

        // Check if the logged-in user is the same as the one trying to access the resource
        if ($user->id !== (int)$userId) {
            // If the IDs don't match, redirect to the home page or show an error
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Proceed with the request if the IDs match
        return $next($request);
    }
}
