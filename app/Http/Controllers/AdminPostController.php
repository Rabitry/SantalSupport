<?php
// app/Http/Controllers/AdminPostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    /**
     * Display all posts for admin management
     */
    public function index(Request $request)
    {
        $query = Post::with(['user', 'comments']);

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

        $posts = $query->recent()->paginate(15);

        $postTypes = [
            'information' => 'Information Guidance',
            'financial' => 'Financial Assistance', 
            'blood' => 'Blood Donation',
            'accommodation' => 'Temporary Accommodation',
            'tuition' => 'Tuition Management',
            'general' => 'General Discussion'
        ];

        return view('admin.posts.index', compact('posts', 'postTypes'));
    }

    /**
     * Remove a post (Admin decision)
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Delete all related data
        $post->comments()->delete();
        $post->complaints()->delete(); // If you keep complaints table
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }

    /**
     * View a specific post as admin
     */
    public function show($id)
    {
        $post = Post::with(['user', 'comments.user'])->findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }
}