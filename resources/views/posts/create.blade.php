<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create New Post - Santal Support</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .form-input {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            width: 100%;
        }
        .form-input:focus {
            outline: none;
            ring: 2px;
            ring-color: #3b82f6;
            border-color: #3b82f6;
        }
        .btn-primary {
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #2563eb;
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
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <a href="{{ route('posts.index') }}" class="text-blue-500 hover:text-blue-600">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Posts
                </a>
            </nav>

            <!-- Page Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Create New Post</h1>
                <p class="text-gray-600">Share your thoughts, ask for help, or contribute to the community</p>
            </div>

            <!-- Create Post Form -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf

                    <!-- Post Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Post Title *
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title"
                               value="{{ old('title') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter a clear and descriptive title"
                               required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Post Type -->
                    <div class="mb-6">
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Post Type *
                        </label>
                        <select name="type" 
                                id="type"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                            <option value="">Select Post Type</option>
                            @foreach($postTypes as $key => $value)
                                <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category (Optional) -->
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Category (Optional)
                        </label>
                        <input type="text" 
                               name="category" 
                               id="category"
                               value="{{ old('category') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="e.g., Admission, Scholarship, Emergency">
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1">
                            Add a category to help others find your post easily
                        </p>
                    </div>

                    <!-- Post Content -->
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            Post Content *
                        </label>
                        <textarea name="content" 
                                  id="content"
                                  rows="12"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Write your post content here. Be clear and descriptive to get better responses..."
                                  required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1">
                            Provide detailed information about what you're sharing or asking for help with
                        </p>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="mb-6">
                        <div class="flex items-start">
                            <input type="checkbox" 
                                   id="terms" 
                                   name="terms"
                                   class="mt-1 mr-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                   required>
                            <label for="terms" class="text-sm text-gray-700">
                                I understand that this post will be visible to all community members and 
                                I agree to follow community guidelines
                            </label>
                        </div>
                        @error('terms')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                        <a href="{{ route('posts.index') }}" 
                           class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-150">
                            <i class="fas fa-arrow-left mr-2"></i> Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-150">
                            <i class="fas fa-paper-plane mr-2"></i> Publish Post
                        </button>
                    </div>
                </form>
            </div>

            <!-- Posting Guidelines -->
            <div class="bg-white rounded-lg shadow-sm p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Posting Guidelines</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="flex items-start">
                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                        <div>
                            <strong class="text-gray-700">Be Clear</strong>
                            <p class="text-gray-600 text-sm">Use descriptive titles and provide detailed information</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                        <div>
                            <strong class="text-gray-700">Be Respectful</strong>
                            <p class="text-gray-600 text-sm">Maintain a positive and supportive tone</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                        <div>
                            <strong class="text-gray-700">Be Relevant</strong>
                            <p class="text-gray-600 text-sm">Choose the appropriate post type and category</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                        <div>
                            <strong class="text-gray-700">No Spam</strong>
                            <p class="text-gray-600 text-sm">Don't post irrelevant or promotional content</p>
                        </div>
                    </div>
                    <div class="flex items-start md:col-span-2">
                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                        <div>
                            <strong class="text-gray-700">Privacy</strong>
                            <p class="text-gray-600 text-sm">Don't share personal sensitive information publicly</p>
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

    @if($errors->any())
        <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            Please check the form for errors
        </div>
    @endif

    <script>
        // Auto-hide flash messages
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const messages = document.querySelectorAll('.fixed');
                messages.forEach(msg => msg.remove());
            }, 5000);

            // Auto-resize textarea
            const textarea = document.getElementById('content');
            if (textarea) {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
                
                // Trigger initial resize
                textarea.dispatchEvent(new Event('input'));
            }
        });
    </script>
</body>
</html>