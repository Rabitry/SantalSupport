<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Post - Santal Support</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit Post</h1>
                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:text-blue-600">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Post
                </a>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Post Form -->
            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Post Title *
                    </label>
                    <input type="text" name="title" id="title" 
                           value="{{ old('title', $post->title) }}"
                           class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Enter post title" required>
                </div>

                <div class="mb-6">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                        Post Type *
                    </label>
                    <select name="type" id="type" 
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select post type</option>
                        @foreach($postTypes as $key => $value)
                            <option value="{{ $key }}" {{ old('type', $post->type) == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                        Category (Optional)
                    </label>
                    <input type="text" name="category" id="category" 
                           value="{{ old('category', $post->category) }}"
                           class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="e.g., Education, Health, Employment">
                </div>

                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Content *
                    </label>
                    <textarea name="content" id="content" rows="12"
                              class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Write your post content here..." required>{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        <a href="{{ route('posts.show', $post->id) }}" 
                           class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                            Cancel
                        </a>
                    </div>
                    <div class="flex space-x-3">
                        <button type="button" onclick="confirmDelete()" 
                                class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                            Delete Post
                        </button>
                        <button type="submit" 
                                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                            Update Post
                        </button>
                    </div>
                </div>
            </form>

            <!-- Delete Form -->
            <form id="deleteForm" action="{{ route('posts.destroy', $post->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this post? This action cannot be undone.')) {
                document.getElementById('deleteForm').submit();
            }
        }

        // Auto-resize textarea
        const textarea = document.getElementById('content');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // Initialize textarea height
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    </script>
</body>
</html>