<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Santal Community</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a'
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
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased">
    <!-- Admin Header -->
    <header class="bg-gradient-to-r from-primary-800 to-primary-900 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold flex items-center">
                        <i class="fas fa-chart-line mr-3"></i>
                        Admin Dashboard
                    </h1>
                    <p class="text-primary-100 mt-1">Santal Community Management System</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-primary-100">Welcome, {{ Auth::user()->name }}</span>
                    <a href="{{ route('dashboard') }}" 
                       class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg font-medium smooth-transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Site
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Admin Navigation -->
    <nav class="bg-slate-800 text-white shadow-md">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap items-center justify-between py-3">
                <div class="flex space-x-1 lg:space-x-4">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-3 py-2 rounded-lg bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-chart-bar mr-2"></i>
                        <span class="hidden sm:inline">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.populations.index') }}" 
                       class="px-3 py-2 rounded-lg hover:bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-users mr-2"></i>
                        <span class="hidden sm:inline">Populations</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-3 py-2 rounded-lg hover:bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-user-friends mr-2"></i>
                        <span class="hidden sm:inline">Users</span>
                    </a>
                    <a href="{{ route('admin.users.pending') }}" 
                       class="px-3 py-2 rounded-lg hover:bg-slate-700 smooth-transition flex items-center text-sm lg:text-base relative">
                        <i class="fas fa-clock mr-2"></i>
                        <span class="hidden sm:inline">Pending</span>
                        @if($pendingUsers > 0)
                            <span class="absolute -top-1 -right-1 bg-amber-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $pendingUsers }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('admin.statistics') }}" 
                       class="px-3 py-2 rounded-lg hover:bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-chart-pie mr-2"></i>
                        <span class="hidden sm:inline">Statistics</span>
                    </a>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="flex items-center">
                    @csrf
                    <button type="submit" 
                            class="bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded-lg smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-6 shadow-sm card-hover">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-emerald-500 mr-3 text-lg"></i>
                    <div>
                        <h4 class="text-emerald-800 font-semibold">Success</h4>
                        <p class="text-emerald-600 text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 mb-6 shadow-sm card-hover">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-rose-500 mr-3 text-lg"></i>
                    <div>
                        <h4 class="text-rose-800 font-semibold">Error</h4>
                        <p class="text-rose-600 text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Pending Users Alert -->
        @if($pendingUsers > 0)
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 mb-6 shadow-sm card-hover">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start space-x-4">
                    <div class="bg-amber-100 p-3 rounded-full">
                        <i class="fas fa-clock text-amber-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-amber-800">Pending User Approvals</h3>
                        <p class="text-amber-700 text-sm mt-1">
                            You have <strong>{{ $pendingUsers }}</strong> user(s) waiting for approval. 
                            Please review their ID documents and approve or reject their registration.
                        </p>
                    </div>
                </div>
                <a href="{{ route('admin.users.pending') }}" 
                   class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-3 rounded-lg font-medium smooth-transition flex items-center justify-center whitespace-nowrap shadow-sm">
                    <i class="fas fa-list-check mr-2"></i>Review Now
                </a>
            </div>
        </div>
        @endif

        <!-- Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 card-hover">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Total Users</p>
                        <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $totalUsers }}</h3>
                        <p class="text-slate-400 text-xs mt-2">Registered Users</p>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Profiles -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 card-hover">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Total Profiles</p>
                        <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $totalPopulations }}</h3>
                        <p class="text-slate-400 text-xs mt-2">Population Profiles</p>
                    </div>
                    <div class="bg-emerald-50 p-3 rounded-lg">
                        <i class="fas fa-id-card text-emerald-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Pending Approval -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 card-hover">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Pending Approval</p>
                        <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $pendingUsers }}</h3>
                        <p class="text-slate-400 text-xs mt-2">Users Waiting</p>
                    </div>
                    <div class="bg-amber-50 p-3 rounded-lg">
                        <i class="fas fa-clock text-amber-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Approved Users -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 card-hover">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Approved Users</p>
                        <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $approvedUsers }}</h3>
                        <p class="text-slate-400 text-xs mt-2">Active Users</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg">
                        <i class="fas fa-user-check text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Row Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Rejected Users -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 card-hover">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Rejected Users</p>
                        <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $rejectedUsers }}</h3>
                        <p class="text-slate-400 text-xs mt-2">Rejected Registrations</p>
                    </div>
                    <div class="bg-rose-50 p-3 rounded-lg">
                        <i class="fas fa-user-times text-rose-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Admin Users -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 card-hover">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Admin Users</p>
                        <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $totalAdmins }}</h3>
                        <p class="text-slate-400 text-xs mt-2">Administrators</p>
                    </div>
                    <div class="bg-purple-50 p-3 rounded-lg">
                        <i class="fas fa-crown text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Student Profiles -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 card-hover">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Student Profiles</p>
                        <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $totalStudents }}</h3>
                        <p class="text-slate-400 text-xs mt-2">Student Members</p>
                    </div>
                    <div class="bg-indigo-50 p-3 rounded-lg">
                        <i class="fas fa-graduation-cap text-indigo-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8 card-hover">
            <h2 class="text-xl font-semibold text-slate-800 mb-6 flex items-center">
                <i class="fas fa-rocket mr-2 text-primary-500"></i>
                Quick Actions
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Review Pending Users -->
                <a href="{{ route('admin.users.pending') }}" 
                   class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white p-5 rounded-xl smooth-transition flex flex-col items-center text-center shadow-sm card-hover">
                    <div class="bg-amber-100 bg-opacity-20 p-3 rounded-full mb-3">
                        <i class="fas fa-clock text-amber-100 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Review Pending Users</h3>
                    <p class="text-amber-100 text-sm">{{ $pendingUsers }} waiting</p>
                </a>

                <!-- Manage All Profiles -->
                <a href="{{ route('admin.populations.index') }}" 
                   class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-5 rounded-xl smooth-transition flex flex-col items-center text-center shadow-sm card-hover">
                    <div class="bg-blue-100 bg-opacity-20 p-3 rounded-full mb-3">
                        <i class="fas fa-users text-blue-100 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Manage All Profiles</h3>
                    <p class="text-blue-100 text-sm">{{ $totalPopulations }} profiles</p>
                </a>

                <!-- Manage Users -->
                <a href="{{ route('admin.users.index') }}" 
                   class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white p-5 rounded-xl smooth-transition flex flex-col items-center text-center shadow-sm card-hover">
                    <div class="bg-emerald-100 bg-opacity-20 p-3 rounded-full mb-3">
                        <i class="fas fa-user-friends text-emerald-100 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Manage Users</h3>
                    <p class="text-emerald-100 text-sm">{{ $totalUsers }} users</p>
                </a>

                <!-- View Statistics -->
                <a href="{{ route('admin.statistics') }}" 
                   class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white p-5 rounded-xl smooth-transition flex flex-col items-center text-center shadow-sm card-hover">
                    <div class="bg-purple-100 bg-opacity-20 p-3 rounded-full mb-3">
                        <i class="fas fa-chart-pie text-purple-100 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-white mb-1">View Statistics</h3>
                    <p class="text-purple-100 text-sm">Analytics & Reports</p>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden card-hover">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="text-xl font-semibold text-slate-800 flex items-center">
                    <i class="fas fa-history mr-2 text-slate-500"></i>
                    Recent Activity
                </h2>
            </div>
            
            <div class="divide-y divide-slate-200">
                @php
                    $recentUsers = \App\Models\User::with('approver')->latest()->take(5)->get();
                    $recentPopulations = \App\Models\Population::latest()->take(3)->get();
                    $hasActivity = !$recentUsers->isEmpty() || !$recentPopulations->isEmpty();
                @endphp
                
                @if($hasActivity)
                    @foreach($recentUsers as $user)
                    <div class="p-6 hover:bg-slate-50 smooth-transition">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center 
                                    {{ $user->status === 'approved' ? 'bg-emerald-100 text-emerald-600' : 
                                       ($user->status === 'pending' ? 'bg-amber-100 text-amber-600' : 
                                       'bg-rose-100 text-rose-600') }}">
                                    @if($user->status === 'approved') 
                                        <i class="fas fa-check"></i>
                                    @elseif($user->status === 'pending') 
                                        <i class="fas fa-clock"></i>
                                    @else 
                                        <i class="fas fa-times"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-slate-900">
                                        {{ $user->name }}
                                        <span class="text-slate-500 font-normal">({{ $user->email }})</span>
                                    </p>
                                    <span class="text-xs text-slate-500">
                                        {{ $user->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-sm text-slate-600 mt-1">
                                    @if($user->status === 'approved' && $user->approver)
                                        <i class="fas fa-user-check mr-1 text-emerald-500"></i>
                                        Approved by {{ $user->approver->name }}
                                    @elseif($user->status === 'rejected')
                                        <i class="fas fa-user-times mr-1 text-rose-500"></i>
                                        Registration rejected
                                    @else
                                        <i class="fas fa-clock mr-1 text-amber-500"></i>
                                        Waiting for approval
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    @foreach($recentPopulations as $population)
                    <div class="p-6 hover:bg-slate-50 smooth-transition">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-slate-900">
                                        {{ $population->name }}
                                        <span class="text-slate-500 font-normal">- {{ $population->occupation }}</span>
                                    </p>
                                    <span class="text-xs text-slate-500">
                                        {{ $population->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-sm text-slate-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-1 text-blue-500"></i>
                                    {{ $population->district }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="p-12 text-center">
                    <div class="text-slate-300 text-5xl mb-4">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3 class="text-lg font-medium text-slate-700 mb-2">No Recent Activity</h3>
                    <p class="text-slate-500 max-w-md mx-auto">
                        Activity will appear here as users register and create profiles in the system.
                    </p>
                </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        // Auto-hide success messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const successMessages = document.querySelectorAll('.bg-emerald-50');
                successMessages.forEach(function(message) {
                    message.style.display = 'none';
                });
            }, 5000);
        });

        // Add loading states to buttons
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href]');
            links.forEach(link => {
                link.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (icon && !this.querySelector('.fa-spinner')) {
                        const currentIcon = icon.className;
                        icon.className = 'fas fa-spinner fa-spin mr-2';
                        
                        // Reset icon after 2 seconds if still on same page
                        setTimeout(() => {
                            if (document.readyState === 'complete') {
                                icon.className = currentIcon;
                            }
                        }, 2000);
                    }
                });
            });
        });
    </script>
</body>
</html>