<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Recent community posts (for feed)
        $recentPosts = Post::with(['user', 'comments'])
                          ->latest()
                          ->take(15)
                          ->get();

        // User's quick stats - Use direct queries to avoid relationship issues
        $userStats = [
            'post_count' => Post::where('user_id', $user->id)->count(),
            'comment_count' => Comment::where('user_id', $user->id)->count(),
            'profile_complete' => Population::where('user_id', $user->id)->exists(),
        ];

        // Notifications (comments on user's posts)
        $notifications = Comment::whereHas('post', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['user', 'post'])
        ->where('user_id', '!=', $user->id) // Exclude user's own comments
        ->latest()
        ->take(5)
        ->get();

        // Popular posts (most viewed)
        $popularPosts = Post::with(['user', 'comments'])
                           ->orderBy('view_count', 'desc')
                           ->take(5)
                           ->get();

        return view('dashboard.index', compact(
            'recentPosts', 
            'userStats', 
            'notifications',
            'popularPosts'
        ));
    }
}