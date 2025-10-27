<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $post->title }} - Santal Support</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .comment-item {
            transition: background-color 0.2s ease;
        }
        .comment-item:hover {
            background-color: #f8f9fa;
        }
        .post-content {
            line-height: 1.7;
            font-size: 1.1em;
        }
        .post-content p {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">
                        <i class="fas fa-hands-helping text-blue-500 mr-2"></i>
                        Santal Support
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('posts.index') }}" class="text-gray-700 hover:text-blue-500">
                            <i class="fas fa-newspaper mr-1"></i> Posts
                        </a>
                        <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-plus mr-1"></i> Create Post
                        </a>
                        <a href="{{ route('posts.my-posts') }}" class="text-gray-700 hover:text-blue-500">
                            <i class="fas fa-user mr-1"></i> {{ Auth::user()->name }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-500">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <a href="{{ route('posts.index') }}" class="text-blue-500 hover:text-blue-600">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Posts
                </a>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content Column -->
                <div class="lg:col-span-2">
                    <!-- Post Content -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
                        
                        <!-- Post Meta -->
                        <div class="flex flex-wrap items-center justify-between mb-6 pb-4 border-b border-gray-200">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <i class="fas fa-user text-gray-400 mr-2"></i>
                                    <span class="font-medium text-gray-700">{{ $post->user->name }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-gray-400 mr-2"></i>
                                    <span class="text-gray-500">{{ $post->created_at->format('M j, Y') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-eye text-gray-400 mr-2"></i>
                                    <span class="text-gray-500">{{ $post->view_count }} views</span>
                                </div>
                            </div>
                            <div class="flex space-x-2 mt-2 lg:mt-0">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $post->type }}
                                </span>
                                @if($post->category)
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                        {{ $post->category }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Post Content -->
                        <div class="post-content text-gray-700 mb-6">
                            {!! nl2br(e($post->content)) !!}
                        </div>

                        <!-- Post Actions -->
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                            <div class="text-sm text-gray-500">
                                Posted {{ $post->created_at->diffForHumans() }}
                            </div>
                            <div class="flex space-x-2">
                                @auth
                                    @if(Auth::id() === $post->user_id)
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm"
                                                    onclick="return confirm('Are you sure you want to delete this post?')">
                                                <i class="fas fa-trash mr-1"></i> Delete Post
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="bg-white rounded-lg shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-800">
                                <i class="fas fa-comments mr-2"></i>
                                Comments ({{ $post->comments->count() }})
                            </h2>
                        </div>

                        <!-- Comment Form -->
                        @auth
                            <div class="p-6 border-b border-gray-200">
                                <form action="{{ route('comments.store', $post->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                            Add a comment:
                                        </label>
                                        <textarea name="content" 
                                                  id="content" 
                                                  rows="4"
                                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                  placeholder="Write your comment here..."
                                                  required></textarea>
                                        @error('content')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" 
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
                                        Post Comment
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="p-6 border-b border-gray-200 text-center">
                                <p class="text-gray-600">
                                    Please <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-600">login</a> to comment on this post.
                                </p>
                            </div>
                        @endauth

                        <!-- Comments List -->
                        <div class="p-6">
                            @if($post->comments->count() > 0)
                                <div class="space-y-6">
                                    @foreach($post->comments as $comment)
                                        <div class="comment-item p-4 rounded-lg">
                                            <div class="flex justify-between items-start mb-2">
                                                <div class="flex items-center">
                                                    <strong class="text-gray-800">{{ $comment->user->name }}</strong>
                                                    <span class="text-gray-500 text-sm ml-3">
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                                @auth
                                                    @if(Auth::id() === $comment->user_id || Auth::user()->role === 'admin')
                                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="text-red-500 hover:text-red-700 text-sm"
                                                                    onclick="return confirm('Are you sure you want to delete this comment?')">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endauth
                                            </div>
                                            <p class="text-gray-700">{{ $comment->content }}</p>
                                        </div>
                                        @if(!$loop->last)
                                            <hr class="border-gray-200">
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-comment-slash text-4xl text-gray-400 mb-3"></i>
                                    <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- About This Post -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">About This Post</h3>
                        <div class="space-y-3">
                            <div>
                                <strong class="text-gray-700">Author:</strong>
                                <p class="text-gray-600">{{ $post->user->name }}</p>
                            </div>
                            <div>
                                <strong class="text-gray-700">Posted:</strong>
                                <p class="text-gray-600">{{ $post->created_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                            <div>
                                <strong class="text-gray-700">Type:</strong>
                                <p>
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                                        {{ $post->type }}
                                    </span>
                                </p>
                            </div>
                            @if($post->category)
                            <div>
                                <strong class="text-gray-700">Category:</strong>
                                <p class="text-gray-600">{{ $post->category }}</p>
                            </div>
                            @endif
                            <div>
                                <strong class="text-gray-700">Stats:</strong>
                                <div class="flex space-x-4 text-sm text-gray-600 mt-1">
                                    <span>
                                        <i class="fas fa-eye mr-1"></i> {{ $post->view_count }} views
                                    </span>
                                    <span>
                                        <i class="fas fa-comment mr-1"></i> {{ $post->comments->count() }} comments
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('posts.index') }}" 
                               class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg flex items-center justify-center transition duration-150">
                                <i class="fas fa-arrow-left mr-2"></i> Back to Posts
                            </a>
                            <a href="{{ route('posts.create') }}" 
                               class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center justify-center transition duration-150">
                                <i class="fas fa-plus mr-2"></i> Create New Post
                            </a>
                            @auth
                                <a href="{{ route('posts.my-posts') }}" 
                                   class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center justify-center transition duration-150">
                                    <i class="fas fa-user mr-2"></i> My Posts
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Share Options -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Share This Post</h3>
                        <div class="flex space-x-3">
                            <button onclick="shareOnFacebook()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm">
                                <i class="fab fa-facebook mr-1"></i> Facebook
                            </button>
                            <button onclick="shareOnTwitter()" class="flex-1 bg-blue-400 hover:bg-blue-500 text-white px-3 py-2 rounded text-sm">
                                <i class="fab fa-twitter mr-1"></i> Twitter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <script>
        // Auto-hide flash messages
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const messages = document.querySelectorAll('.fixed');
                messages.forEach(msg => msg.remove());
            }, 5000);

            // Share functions
            function shareOnFacebook() {
                const url = encodeURIComponent(window.location.href);
                window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
            }

            function shareOnTwitter() {
                const text = encodeURIComponent("Check out this post: " + document.title);
                const url = encodeURIComponent(window.location.href);
                window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
            }

            // Make share functions global
            window.shareOnFacebook = shareOnFacebook;
            window.shareOnTwitter = shareOnTwitter;
        });
    </script>
</body>
</html>