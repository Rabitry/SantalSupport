<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Complaint;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Display all posts with pagination and filters
     */
    public function index(Request $request)
    {
        $query = Post::with(['user', 'comments', 'complaints.user'])->recent();

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
    public function create(): View
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
    public function store(Request $request): RedirectResponse
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
    public function show($id): View
    {
        $post = Post::with(['user', 'comments.user', 'complaints.user'])->findOrFail($id);
        
        // Increase view count
        $post->increment('view_count');

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post
     */
    public function edit($id): View
    {
        $post = Post::findOrFail($id);

        // Authorization check - only post owner can edit
        if ($post->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $postTypes = [
            'information' => 'Information Guidance',
            'financial' => 'Financial Assistance',
            'blood' => 'Blood Donation',
            'accommodation' => 'Temporary Accommodation', 
            'tuition' => 'Tuition Management',
            'general' => 'General Discussion'
        ];

        return view('posts.edit', compact('post', 'postTypes'));
    }

    /**
     * Update the specified post in storage
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        // Authorization check - only post owner can update
        if ($post->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:information,financial,blood,accommodation,tuition,general',
            'category' => 'nullable|string|max:100'
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'category' => $request->category,
        ]);

        return redirect()->route('posts.show', $post->id)
            ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from storage
     */
    public function destroy($id): RedirectResponse
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

        // Redirect based on user role
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
        }

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

    /**
     * Submit a complaint about a post
     */
    public function complain(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000'
        ]);

        $post = Post::findOrFail($id);

        // Check if user is the post owner
        if ($post->user_id === Auth::id()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You cannot report your own post.'
                ], 422);
            }
            return redirect()->back()->with('error', 'You cannot report your own post.');
        }

        // Check if user already complained about this post
        $existingComplaint = Complaint::where('post_id', $id)
            ->where('user_id', Auth::id())
            ->first();
            
        if ($existingComplaint) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already reported this post.'
                ], 422);
            }
            return redirect()->back()->with('error', 'You have already reported this post.');
        }

        try {
            // Create new complaint
            Complaint::create([
                'post_id' => $id,
                'user_id' => Auth::id(),
                'reason' => $request->reason,
                'description' => $request->description,
                'status' => 'public'
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Report submitted successfully. Your report is now visible to the community.'
                ]);
            }

            return redirect()->back()->with('success', 'Report submitted successfully. Your report is now visible to the community.');

        } catch (\Exception $e) {
            \Log::error('Complaint submission error: ' . $e->getMessage());
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while submitting your report. Please try again.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'An error occurred while submitting your report. Please try again.');
        }
    }

    /**
     * Display user's own posts
     */
    public function myPosts(): View
    {
        $posts = Post::where('user_id', Auth::id())
                    ->withCount(['comments', 'complaints'])
                    ->with(['complaints.user'])
                    ->recent()
                    ->paginate(10);

        return view('posts.my-posts', compact('posts'));
    }
    /**
 * Get comments data for a post (for AJAX) - Public access
 */
// public function getCommentsData($id)
// {
//     try {
//         $post = Post::with(['comments.user'])->findOrFail($id);
        
//         return response()->json([
//             'success' => true,
//             'comments' => $post->comments->map(function($comment) {
//                 return [
//                     'id' => $comment->id,
//                     'content' => $comment->content,
//                     'created_at' => $comment->created_at->toISOString(),
//                     'user' => [
//                         'name' => $comment->user->name,
//                     ]
//                 ];
//             })
//         ]);
//     } catch (\Exception $e) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Error loading comments'
//         ], 500);
//     }
// }

// /**
//  * Get reports data for a post (for AJAX) - Public access  
//  */
// public function getReportsData($id)
// {
//     try {
//         $post = Post::with(['complaints.user'])->findOrFail($id);
        
//         return response()->json([
//             'success' => true,
//             'reports' => $post->complaints->map(function($complaint) {
//                 return [
//                     'id' => $complaint->id,
//                     'reason' => $complaint->reason,
//                     'description' => $complaint->description,
//                     'created_at' => $complaint->created_at->toISOString(),
//                     'user' => [
//                         'name' => $complaint->user->name,
//                     ]
//                 ];
//             })
//         ]);
//     } catch (\Exception $e) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Error loading reports'
//         ], 500);
//     }
// }
public function getCommentsData($id, Request $request)
    {
        try {
            $post = Post::findOrFail($id);
            $page = $request->get('page', 1);
            $perPage = 10; // Comments per page
            
            $comments = $post->comments()
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage, ['*'], 'page', $page);
            
            return response()->json([
                'success' => true,
                'comments' => $comments->map(function($comment) {
                    return [
                        'id' => $comment->id,
                        'content' => $comment->content,
                        'created_at' => $comment->created_at->toISOString(),
                        'user' => [
                            'name' => $comment->user->name,
                        ]
                    ];
                }),
                'pagination' => [
                    'current_page' => $comments->currentPage(),
                    'last_page' => $comments->lastPage(),
                    'per_page' => $comments->perPage(),
                    'total' => $comments->total(),
                    'has_more' => $comments->hasMorePages(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading comments'
            ], 500);
        }
    }

    /**
     * Get reports data for a post (for AJAX) - Public access  
     */
    public function getReportsData($id, Request $request)
    {
        try {
            $post = Post::findOrFail($id);
            $page = $request->get('page', 1);
            $perPage = 10; // Reports per page
            
            $reports = $post->complaints()
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage, ['*'], 'page', $page);
            
            return response()->json([
                'success' => true,
                'reports' => $reports->map(function($complaint) {
                    return [
                        'id' => $complaint->id,
                        'reason' => $complaint->reason,
                        'description' => $complaint->description,
                        'created_at' => $complaint->created_at->toISOString(),
                        'user' => [
                            'name' => $complaint->user->name,
                        ]
                    ];
                }),
                'pagination' => [
                    'current_page' => $reports->currentPage(),
                    'last_page' => $reports->lastPage(),
                    'per_page' => $reports->perPage(),
                    'total' => $reports->total(),
                    'has_more' => $reports->hasMorePages(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading reports'
            ], 500);
        }
    }
 

}