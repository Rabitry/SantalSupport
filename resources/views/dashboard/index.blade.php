<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Santal Community</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        teal: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a'
                        },
                        slate: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a'
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        .smooth-transition {
            transition: all 0.3s ease-in-out;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px -5px rgba(0, 0, 0, 0.15), 0 8px 12px -5px rgba(0, 0, 0, 0.1);
        }
        .gradient-text {
            background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased">
    <!-- Navigation Bar -->
    <nav class="bg-slate-800 shadow-xl border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-users text-teal-400 mr-3"></i>
                        Santal Community
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="flex items-center space-x-1">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 text-white font-semibold border-b-2 border-teal-400 smooth-transition">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('posts.index') }}" 
                       class="px-4 py-2 text-slate-300 hover:text-white smooth-transition">
                        <i class="fas fa-newspaper mr-2"></i>Community
                    </a>
                    <a href="{{ route('posts.my-posts') }}" 
                       class="px-4 py-2 text-slate-300 hover:text-white smooth-transition">
                        <i class="fas fa-file-alt mr-2"></i>My Posts
                    </a>
                    <a href="{{ route('population.index') }}" 
                       class="px-4 py-2 text-slate-300 hover:text-white smooth-transition">
                        <i class="fas fa-user mr-2"></i>Profiles
                    </a>
                    
                    <!-- Admin Panel Link (Only for Admins) -->
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" 
                       class="ml-4 px-4 py-2 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-500 hover:to-teal-600 text-white rounded-lg font-medium smooth-transition flex items-center shadow-lg">
                        <i class="fas fa-cog mr-2"></i>
                        Admin Panel
                    </a>
                    @endif


                    <!-- User Dropdown -->
                    <div class="relative ml-4 group">
                        <button class="flex items-center space-x-2 text-slate-200 hover:text-white smooth-transition">
                            <div class="w-8 h-8 bg-teal-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <span class="font-medium">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs smooth-transition group-hover:rotate-180"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-slate-700 rounded-lg shadow-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible smooth-transition z-50 border border-slate-600">
                            <a href="{{ route('population.index') }}" class="block px-4 py-2 text-slate-200 hover:bg-slate-600 smooth-transition">
                                <i class="fas fa-user-circle mr-2 text-teal-400"></i>My Profile
                            </a>
                            <a href="{{ route('posts.my-posts') }}" class="block px-4 py-2 text-slate-200 hover:bg-slate-600 smooth-transition">
                                <i class="fas fa-file-alt mr-2 text-teal-400"></i>My Posts
                            </a>
                            <div class="border-t border-slate-600 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-slate-200 hover:bg-slate-600 smooth-transition">
                                    <i class="fas fa-sign-out-alt mr-2 text-teal-400"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Dashboard Content -->
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Welcome Section & Quick Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
            <!-- Welcome Card -->
            <div class="lg:col-span-3 bg-gradient-to-r from-teal-600 to-teal-700 rounded-2xl p-6 text-white card-hover shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-teal-100">Stay connected with the Santal community</p>
                        
                        <!-- Admin Welcome Message -->
                        @if(Auth::user()->role === 'admin')
                        <div class="mt-3 flex items-center space-x-2 text-teal-200 text-sm">
                            <i class="fas fa-shield-alt"></i>
                            <span>You have administrator privileges</span>
                            <a href="{{ route('admin.dashboard') }}" class="ml-2 bg-white bg-opacity-20 hover:bg-opacity-30 px-3 py-1 rounded-full text-xs font-medium smooth-transition">
                                Go to Admin Panel
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-teal-200">Community Activity</div>
                        <div class="text-xl font-bold">{{ \App\Models\Post::count() }}+ posts</div>
                        <div class="text-xs text-teal-300 mt-1">{{ \App\Models\User::count() }} members</div>
                    </div>
                </div>
            </div>

            <!-- Quick Create -->
            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-slate-200">
                <a href="{{ route('posts.create') }}" 
                   class="w-full bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white py-3 px-4 rounded-lg flex items-center justify-center smooth-transition shadow-md">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Create Post
                </a>
                <p class="text-xs text-slate-500 text-center mt-2">Share with the community</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Community Feed -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 card-hover border border-slate-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-slate-800 flex items-center">
                            <i class="fas fa-newspaper mr-2 text-teal-600"></i>
                            Community Feed
                        </h2>
                        <a href="{{ route('posts.index') }}" class="text-teal-600 hover:text-teal-800 text-sm font-medium smooth-transition">
                            View All Posts <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    <!-- Create Post Prompt -->
                    <div class="bg-slate-50 rounded-xl p-4 mb-6 border border-slate-300 cursor-pointer smooth-transition hover:bg-slate-100"
                         onclick="window.location='{{ route('posts.create') }}'">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-teal-600"></i>
                            </div>
                            <div class="flex-1 text-slate-500">
                                Share something with the Santal community...
                            </div>
                            <div class="bg-teal-500 text-white p-2 rounded-lg">
                                <i class="fas fa-edit"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Posts -->
                    <div class="space-y-6">
                        @forelse($recentPosts as $post)
                        <div class="border border-slate-200 rounded-xl p-6 smooth-transition hover:shadow-lg card-hover">
                            <!-- Post Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-teal-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-slate-800">{{ $post->user->name }}</h3>
                                        <p class="text-sm text-slate-500">{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <span class="bg-teal-100 text-teal-800 px-3 py-1 rounded-full text-xs font-medium border border-teal-200">
                                    {{ $post->type }}
                                </span>
                            </div>
                            
                            <!-- Post Content -->
                            <a href="{{ route('posts.show', $post->id) }}" class="block mb-4">
                                <h4 class="text-lg font-semibold text-slate-800 mb-2 hover:text-teal-600 smooth-transition">
                                    {{ $post->title }}
                                </h4>
                                <p class="text-slate-600 leading-relaxed">
                                    {{ Str::limit(strip_tags($post->content), 200) }}
                                </p>
                            </a>

                            <!-- Post Stats & Actions -->
                            <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                                <div class="flex items-center space-x-4 text-sm text-slate-500">
                                    <span class="flex items-center">
                                        <i class="fas fa-eye mr-1"></i>{{ $post->view_count }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-comment mr-1"></i>{{ $post->comments->count() }}
                                    </span>
                                </div>
                                <div class="flex space-x-3">
                                    <a href="{{ route('posts.show', $post->id) }}" 
                                       class="text-teal-600 hover:text-teal-800 text-sm font-medium smooth-transition">
                                        <i class="fas fa-comment mr-1"></i>Comment
                                    </a>
                                    @if(Auth::id() !== $post->user_id)
                                    <form action="{{ route('posts.complain', $post->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 text-sm font-medium smooth-transition">
                                            <i class="fas fa-flag mr-1"></i>Report
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <i class="fas fa-inbox text-4xl text-slate-300 mb-3"></i>
                            <p class="text-slate-500">No posts yet. Be the first to share!</p>
                            <a href="{{ route('posts.create') }}" class="text-teal-600 hover:text-teal-800 mt-2 inline-block font-medium smooth-transition">
                                Create first post
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- User Stats -->
                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-slate-200">
                    <h3 class="font-semibold text-slate-800 mb-4 flex items-center">
                        <i class="fas fa-chart-bar mr-2 text-teal-600"></i>
                        Your Activity
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg smooth-transition hover:bg-slate-100 border border-slate-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center border border-teal-200">
                                    <i class="fas fa-newspaper text-teal-600"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-800">{{ $userStats['post_count'] }}</div>
                                    <div class="text-sm text-slate-500">Your Posts</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg smooth-transition hover:bg-slate-100 border border-slate-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-teal-50 rounded-lg flex items-center justify-center border border-teal-100">
                                    <i class="fas fa-comments text-teal-600"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-800">{{ $userStats['comment_count'] }}</div>
                                    <div class="text-sm text-slate-500">Your Comments</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg smooth-transition hover:bg-slate-100 border border-slate-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 {{ $userStats['profile_complete'] ? 'bg-emerald-100 border-emerald-200' : 'bg-amber-100 border-amber-200' }} rounded-lg flex items-center justify-center border">
                                    <i class="fas fa-user {{ $userStats['profile_complete'] ? 'text-emerald-600' : 'text-amber-600' }}"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-800">
                                        {{ $userStats['profile_complete'] ? 'Complete' : 'Incomplete' }}
                                    </div>
                                    <div class="text-sm text-slate-500">Profile Status</div>
                                </div>
                            </div>
                            @if(!$userStats['profile_complete'])
                            <a href="{{ route('population.index') }}" class="text-teal-600 hover:text-teal-800 text-sm font-medium smooth-transition">
                                Complete
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Notifications -->
                @if($notifications->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-slate-200">
                    <h3 class="font-semibold text-slate-800 mb-4 flex items-center">
                        <i class="fas fa-bell mr-2 text-teal-600"></i>
                        Notifications
                    </h3>
                    <div class="space-y-3">
                        @foreach($notifications as $notification)
                        <div class="flex items-start space-x-3 p-3 bg-teal-50 rounded-lg smooth-transition hover:bg-teal-100 border border-teal-200">
                            <i class="fas fa-comment text-teal-600 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm text-slate-700">
                                    <strong>{{ $notification->user->name }}</strong> commented on your post
                                </p>
                                <a href="{{ route('posts.show', $notification->post_id) }}" class="text-xs text-teal-600 hover:text-teal-800 font-medium smooth-transition">
                                    View post
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Popular Posts -->
                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-slate-200">
                    <h3 class="font-semibold text-slate-800 mb-4 flex items-center">
                        <i class="fas fa-fire mr-2 text-teal-600"></i>
                        Popular Posts
                    </h3>
                    <div class="space-y-3">
                        @foreach($popularPosts as $post)
                        <a href="{{ route('posts.show', $post->id) }}" class="block group smooth-transition">
                            <div class="flex justify-between items-start p-2 rounded-lg hover:bg-slate-50 border border-transparent hover:border-slate-200">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-800 group-hover:text-teal-600 smooth-transition">
                                        {{ Str::limit($post->title, 40) }}
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        <span class="flex items-center space-x-2">
                                            <span>{{ $post->view_count }} views</span>
                                            <span>•</span>
                                            <span>{{ $post->comments->count() }} comments</span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Admin Access (Only for Admins) -->
                @if(Auth::user()->role === 'admin')
                <div class="bg-gradient-to-r from-teal-600 to-teal-700 rounded-2xl p-6 text-white card-hover shadow-lg">
                    <h3 class="font-semibold mb-3 flex items-center">
                        <i class="fas fa-shield-alt mr-2"></i>
                        Admin Quick Access
                    </h3>
                    <p class="text-teal-100 text-sm mb-4">Manage the community platform</p>
                    <div class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="block w-full bg-white bg-opacity-20 hover:bg-opacity-30 text-white py-2 px-3 rounded-lg text-sm font-medium smooth-transition text-center">
                            <i class="fas fa-tachometer-alt mr-2"></i>Admin Dashboard
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="block w-full bg-white bg-opacity-20 hover:bg-opacity-30 text-white py-2 px-3 rounded-lg text-sm font-medium smooth-transition text-center">
                            <i class="fas fa-users mr-2"></i>Manage Users
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="fixed top-4 right-4 bg-teal-600 text-white px-6 py-3 rounded-lg shadow-xl smooth-transition z-50">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide flash messages
            setTimeout(() => {
                const messages = document.querySelectorAll('.fixed');
                messages.forEach(msg => {
                    msg.style.opacity = '0';
                    setTimeout(() => msg.remove(), 300);
                });
            }, 5000);

            // Smooth dropdown menu
            const dropdowns = document.querySelectorAll('.group');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('mouseenter', function() {
                    const menu = this.querySelector('.absolute');
                    menu.classList.remove('opacity-0', 'invisible');
                    menu.classList.add('opacity-100', 'visible');
                });
                dropdown.addEventListener('mouseleave', function() {
                    const menu = this.querySelector('.absolute');
                    menu.classList.remove('opacity-100', 'visible');
                    menu.classList.add('opacity-0', 'invisible');
                });
            });

            // Add loading states to buttons
            const buttons = document.querySelectorAll('button, a');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (this.getAttribute('type') !== 'submit' && !this.href.includes('#')) {
                        const icon = this.querySelector('i');
                        if (icon && !icon.classList.contains('fa-spinner')) {
                            const originalClass = icon.className;
                            icon.className = 'fas fa-spinner fa-spin mr-2';
                            
                            setTimeout(() => {
                                if (document.readyState === 'complete') {
                                    icon.className = originalClass;
                                }
                            }, 2000);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>