<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display all posts with pagination and filters
     */
    public function index(Request $request)
    {
        $query = Post::with(['user', 'comments'])->recent();

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->has('type') && !empty($request->type) && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category) && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $posts = $query->paginate(10);

        $postTypes = [
            'information' => 'Information Guidance',
            'financial' => 'Financial Assistance', 
            'blood' => 'Blood Donation',
            'accommodation' => 'Temporary Accommodation',
            'tuition' => 'Tuition Management',
            'general' => 'General Discussion'
        ];

        return view('posts.index', compact('posts', 'postTypes'));
    }

    /**
     * Show the form for creating a new post
     */
    public function create()
    {
        $postTypes = [
            'information' => 'Information Guidance',
            'financial' => 'Financial Assistance',
            'blood' => 'Blood Donation',
            'accommodation' => 'Temporary Accommodation', 
            'tuition' => 'Tuition Management',
            'general' => 'General Discussion'
        ];

        return view('posts.create', compact('postTypes'));
    }

    /**
     * Store a newly created post
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:information,financial,blood,accommodation,tuition,general',
            'category' => 'nullable|string|max:100'
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'category' => $request->category,
        ]);

        return redirect()->route('posts.show', $post->id)
            ->with('success', 'Post created successfully!');
    }

    /**
     * Display a single post
     */
    public function show($id)
    {
        $post = Post::with(['user', 'comments.user'])->findOrFail($id);
        
        // Increase view count
        $post->increment('view_count');

        return view('posts.show', compact('post'));
    }

    /**
     * Submit a complaint about a post
     */
    public function complain(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:1000'
        ]);

        $post = Post::findOrFail($id);

        Complaint::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'reason' => $request->reason,
        ]);

        return redirect()->back()->with('success', 'Complaint submitted successfully! Admin will review it.');
    }
    // In PostController.php

public function destroy($id)
{
    $post = Post::findOrFail($id);

    // Check if the current user is the owner of the post or an admin
    if ($post->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
        return redirect()->back()->with('error', 'You are not authorized to delete this post.');
    }

    // Delete related comments and complaints
    $post->comments()->delete();
    $post->complaints()->delete();
    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
}

    /**
     * User's own posts
     */
    public function myPosts()
    {
        $posts = Post::where('user_id', Auth::id())
                    ->recent()
                    ->paginate(10);

        return view('posts.my-posts', compact('posts'));
    }
}