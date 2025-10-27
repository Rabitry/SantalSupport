<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Santal Community Admin</title>
    
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
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Smooth transitions */
        .smooth-transition {
            transition: all 0.3s ease-in-out;
        }
        
        /* Table row hover effect */
        .table-row:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        /* Card hover effect */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Loading animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .loading-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
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
                        <i class="fas fa-users-cog mr-3"></i>
                        User Management
                    </h1>
                    <p class="text-primary-100 mt-1">Manage user accounts, permissions, and verification</p>
                </div>
                <nav class="flex space-x-4">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg font-medium smooth-transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Dashboard
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Admin Navigation -->
    <nav class="bg-slate-800 text-white shadow-md">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap items-center justify-between py-3">
                <div class="flex space-x-1 lg:space-x-4">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-3 py-2 rounded-lg hover:bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-chart-bar mr-2"></i>
                        <span class="hidden sm:inline">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.populations.index') }}" 
                       class="px-3 py-2 rounded-lg hover:bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-users mr-2"></i>
                        <span class="hidden sm:inline">Populations</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-3 py-2 rounded-lg bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-user-friends mr-2"></i>
                        <span class="hidden sm:inline">Users</span>
                    </a>
                    <a href="{{ route('dashboard') }}" 
                       class="px-3 py-2 rounded-lg hover:bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-newspaper mr-2"></i>
                        <span class="hidden sm:inline">Posts</span>
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

    <!-- Main Content -->
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

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6 card-hover">
            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                <i class="fas fa-search mr-2 text-primary-500"></i>
                Search & Filter Users
            </h2>
            
            <form method="GET" action="{{ route('admin.users.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-4">
                    <!-- Search Input -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-search mr-1"></i>Search
                        </label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Name, email, ID..."
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 smooth-transition">
                    </div>
                    
                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-user-check mr-1"></i>Status
                        </label>
                        <select name="status" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 smooth-transition">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Review</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    
                    <!-- Role Filter -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-user-tag mr-1"></i>Role
                        </label>
                        <select name="role" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 smooth-transition">
                            <option value="">All Roles</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Regular User</option>
                        </select>
                    </div>
                    
                    <!-- Profile Filter -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-id-card mr-1"></i>Profile Status
                        </label>
                        <select name="profile_created" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 smooth-transition">
                            <option value="">All Profiles</option>
                            <option value="yes" {{ request('profile_created') == 'yes' ? 'selected' : '' }}>Profile Created</option>
                            <option value="no" {{ request('profile_created') == 'no' ? 'selected' : '' }}>No Profile</option>
                        </select>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-end space-x-2">
                        <button type="submit" 
                                class="w-full bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-lg font-medium smooth-transition flex items-center justify-center shadow-sm">
                            <i class="fas fa-filter mr-2"></i>
                            Apply
                        </button>
                        <a href="{{ route('admin.users.index') }}" 
                           class="w-full bg-slate-500 hover:bg-slate-600 text-white px-6 py-2 rounded-lg font-medium smooth-transition flex items-center justify-center shadow-sm">
                            <i class="fas fa-redo mr-2"></i>
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results Summary -->
        <div class="bg-gradient-to-r from-primary-50 to-indigo-50 border border-primary-200 rounded-2xl p-4 mb-6 card-hover">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div class="flex items-center mb-3 sm:mb-0">
                    <i class="fas fa-chart-bar text-primary-500 mr-3 text-xl"></i>
                    <div>
                        <h3 class="font-semibold text-slate-800">User Statistics</h3>
                        <p class="text-sm text-slate-600">
                            @php
                                $totalUsers = $users->total() ?? $users->count();
                                $firstItem = method_exists($users, 'firstItem') ? $users->firstItem() : 1;
                                $lastItem = method_exists($users, 'lastItem') ? $users->lastItem() : $users->count();
                            @endphp
                            Showing {{ $firstItem }} - {{ $lastItem }} of {{ $totalUsers }} users
                            @if(request()->has('search') || request()->has('status') || request()->has('role') || request()->has('profile_created'))
                                <span class="text-primary-600 font-medium">(Filtered Results)</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="flex space-x-4 text-sm">
                    <div class="text-center">
                        <div class="font-bold text-emerald-600">{{ \App\Models\User::where('status', 'approved')->count() }}</div>
                        <div class="text-slate-500">Approved</div>
                    </div>
                    <div class="text-center">
                        <div class="font-bold text-amber-600">{{ \App\Models\User::where('status', 'pending')->count() }}</div>
                        <div class="text-slate-500">Pending</div>
                    </div>
                    <div class="text-center">
                        <div class="font-bold text-rose-600">{{ \App\Models\User::where('status', 'rejected')->count() }}</div>
                        <div class="text-slate-500">Rejected</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden card-hover">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                    <i class="fas fa-list mr-2 text-slate-500"></i>
                    User Accounts
                </h3>
            </div>

            <!-- Responsive Table Container -->
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-hashtag mr-2"></i>ID
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                User Details
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Identification
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Role & Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Profile
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Registration
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($users as $user)
                        <tr class="table-row smooth-transition hover:bg-primary-50">
                            <!-- ID -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-mono text-slate-900">#{{ $user->id }}</div>
                            </td>
                            
                            <!-- User Details -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-primary-500 to-indigo-500 rounded-full flex items-center justify-center shadow-sm">
                                        <span class="text-white font-semibold text-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-slate-900">{{ $user->name }}</div>
                                        <div class="text-sm text-slate-500">{{ $user->email }}</div>
                                        <div class="text-xs text-slate-400 mt-1">
                                            <i class="fas fa-clock mr-1"></i>{{ $user->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Identification -->
                            <td class="px-6 py-4">
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-xs text-slate-500">Student ID:</span>
                                        <div class="text-sm font-medium">{{ $user->student_id ?? 'Not provided' }}</div>
                                    </div>
                                    <div>
                                        <span class="text-xs text-slate-500">National ID:</span>
                                        <div class="text-sm font-medium">{{ $user->national_id ?? 'Not provided' }}</div>
                                    </div>
                                    <div class="flex space-x-2 mt-2">
                                        @if($user->id_card_front)
                                            <img src="{{ $user->getIdCardFrontUrl() }}" 
                                                 alt="ID Front" 
                                                 class="w-12 h-8 rounded border border-slate-300 cursor-pointer hover:border-primary-500 smooth-transition shadow-sm"
                                                 onclick="openModal('{{ $user->getIdCardFrontUrl() }}')">
                                        @else
                                            <div class="w-12 h-8 bg-slate-100 rounded border border-dashed border-slate-300 flex items-center justify-center">
                                                <i class="fas fa-camera text-slate-400 text-xs"></i>
                                            </div>
                                        @endif
                                        @if($user->id_card_back)
                                            <img src="{{ $user->getIdCardBackUrl() }}" 
                                                 alt="ID Back" 
                                                 class="w-12 h-8 rounded border border-slate-300 cursor-pointer hover:border-primary-500 smooth-transition shadow-sm"
                                                 onclick="openModal('{{ $user->getIdCardBackUrl() }}')">
                                        @else
                                            <div class="w-12 h-8 bg-slate-100 rounded border border-dashed border-slate-300 flex items-center justify-center">
                                                <i class="fas fa-camera text-slate-400 text-xs"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Role & Status -->
                            <td class="px-6 py-4">
                                <div class="space-y-2">
                                    <div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-rose-100 text-rose-800' : 'bg-slate-100 text-slate-800' }}">
                                            <i class="fas {{ $user->role === 'admin' ? 'fa-crown' : 'fa-user' }} mr-1"></i>
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $user->status === 'approved' ? 'bg-emerald-100 text-emerald-800' : 
                                               ($user->status === 'pending' ? 'bg-amber-100 text-amber-800' : 
                                               'bg-rose-100 text-rose-800') }}">
                                            <i class="fas {{ $user->status === 'approved' ? 'fa-check-circle' : 
                                                           ($user->status === 'pending' ? 'fa-clock' : 
                                                           'fa-times-circle') }} mr-1"></i>
                                            {{ ucfirst($user->status) }}
                                        </span>
                                        @if($user->status === 'rejected' && $user->rejection_reason)
                                            <div class="mt-1 text-xs text-rose-600" title="{{ $user->rejection_reason }}">
                                                <i class="fas fa-info-circle mr-1"></i>Reason provided
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Profile Status -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($user->population)
                                        <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                                        <span class="text-sm text-emerald-700 font-medium">Profile Created</span>
                                    @else
                                        <i class="fas fa-times-circle text-rose-500 mr-2"></i>
                                        <span class="text-sm text-rose-700">No Profile</span>
                                    @endif
                                </div>
                            </td>
                            
                            <!-- Registration Date -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-900">{{ $user->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-slate-500">{{ $user->created_at->format('h:i A') }}</div>
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-6 py-4">
                                <div class="flex flex-col space-y-2">
                                    <!-- Status Management -->
                                    <div class="flex space-x-2">
                                        @if($user->status === 'pending')
                                            <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" 
                                                        class="w-full bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1 rounded text-xs font-medium smooth-transition flex items-center justify-center shadow-sm"
                                                        onclick="return confirm('Approve this user account?')">
                                                    <i class="fas fa-check mr-1"></i>Approve
                                                </button>
                                            </form>
                                            <button type="button" 
                                                    onclick="showRejectionModal({{ $user->id }})"
                                                    class="flex-1 bg-rose-500 hover:bg-rose-600 text-white px-3 py-1 rounded text-xs font-medium smooth-transition flex items-center justify-center shadow-sm">
                                                <i class="fas fa-times mr-1"></i>Reject
                                            </button>
                                        @elseif($user->status === 'approved')
                                            <span class="text-xs text-emerald-600 font-medium flex items-center">
                                                <i class="fas fa-check-circle mr-1"></i>Approved
                                            </span>
                                            @if($user->approved_by)
                                                <div class="text-xs text-slate-500">by {{ $user->approver->name ?? 'Admin' }}</div>
                                            @endif
                                        @else
                                            <span class="text-xs text-rose-600 font-medium flex items-center">
                                                <i class="fas fa-times-circle mr-1"></i>Rejected
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                                           class="flex-1 bg-primary-500 hover:bg-primary-600 text-white px-3 py-1 rounded text-xs font-medium smooth-transition flex items-center justify-center shadow-sm">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                        
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-full bg-rose-500 hover:bg-rose-600 text-white px-3 py-1 rounded text-xs font-medium smooth-transition flex items-center justify-center shadow-sm"
                                                        onclick="return confirm('Permanently delete this user? This action cannot be undone.')">
                                                    <i class="fas fa-trash mr-1"></i>Delete
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-slate-500 italic">Current User</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-500">
                                    <i class="fas fa-users text-4xl mb-4 text-slate-300"></i>
                                    <h4 class="text-lg font-medium text-slate-700 mb-2">No Users Found</h4>
                                    <p class="text-slate-500 max-w-md">
                                        @if(request()->has('search') || request()->has('status') || request()->has('role') || request()->has('profile_created'))
                                            No users match your current filters. Try adjusting your search criteria.
                                        @else
                                            No users have been registered yet.
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if(method_exists($users, 'links') && $users->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <div class="text-sm text-slate-700">
                        Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} results
                    </div>
                    <div class="flex space-x-1">
                        <!-- Previous Page Link -->
                        @if($users->onFirstPage())
                            <span class="px-3 py-1 bg-slate-200 text-slate-500 rounded-lg text-sm cursor-not-allowed">
                                <i class="fas fa-chevron-left mr-1"></i> Previous
                            </span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}" 
                               class="px-3 py-1 bg-primary-500 hover:bg-primary-600 text-white rounded-lg text-sm smooth-transition flex items-center shadow-sm">
                                <i class="fas fa-chevron-left mr-1"></i> Previous
                            </a>
                        @endif

                        <!-- Page Numbers -->
                        @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            @if($page == $users->currentPage())
                                <span class="px-3 py-1 bg-primary-500 text-white rounded-lg text-sm font-medium shadow-sm">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}" 
                                   class="px-3 py-1 bg-white border border-slate-300 text-slate-700 rounded-lg text-sm hover:bg-slate-50 smooth-transition shadow-sm">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        <!-- Next Page Link -->
                        @if($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}" 
                               class="px-3 py-1 bg-primary-500 hover:bg-primary-600 text-white rounded-lg text-sm smooth-transition flex items-center shadow-sm">
                                Next <i class="fas fa-chevron-right ml-1"></i>
                            </a>
                        @else
                            <span class="px-3 py-1 bg-slate-200 text-slate-500 rounded-lg text-sm cursor-not-allowed">
                                Next <i class="fas fa-chevron-right ml-1"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </main>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeModal()" 
                    class="absolute -top-12 right-0 text-white hover:text-slate-300 text-3xl font-bold smooth-transition">
                <i class="fas fa-times"></i>
            </button>
            <img id="modalImage" class="max-w-full max-h-screen rounded-lg shadow-2xl" src="" alt="Enlarged view">
        </div>
    </div>

    <!-- Rejection Modal -->
    <div id="rejectionModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-rose-100 p-3 rounded-full mr-4">
                        <i class="fas fa-exclamation-triangle text-rose-500 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Reject User Registration</h3>
                        <p class="text-sm text-slate-600">Please provide a reason for rejection</p>
                    </div>
                </div>
                
                <form id="rejectionForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Rejection Reason <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="rejection_reason" required 
                                  class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 smooth-transition"
                                  placeholder="Explain why this user registration is being rejected..."
                                  rows="4"></textarea>
                        <p class="text-xs text-slate-500 mt-1">This reason will be visible to the user.</p>
                    </div>
                    
                    <div class="flex space-x-3">
                        <button type="submit" 
                                class="flex-1 bg-rose-500 hover:bg-rose-600 text-white px-6 py-3 rounded-lg font-medium smooth-transition flex items-center justify-center shadow-sm">
                            <i class="fas fa-ban mr-2"></i>Reject User
                        </button>
                        <button type="button" 
                                onclick="closeRejectionModal()"
                                class="flex-1 bg-slate-500 hover:bg-slate-600 text-white px-6 py-3 rounded-lg font-medium smooth-transition shadow-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Image modal functionality
        function openModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Rejection modal functionality
        let currentUserId = null;

        function showRejectionModal(userId) {
            currentUserId = userId;
            document.getElementById('rejectionForm').action = `/admin/users/${userId}/reject`;
            document.getElementById('rejectionModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeRejectionModal() {
            document.getElementById('rejectionModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            currentUserId = null;
        }

        // Close modals when clicking outside or pressing Escape
        function setupModalClose() {
            // Click outside
            document.addEventListener('click', function(event) {
                const imageModal = document.getElementById('imageModal');
                const rejectionModal = document.getElementById('rejectionModal');
                
                if (event.target === imageModal) closeModal();
                if (event.target === rejectionModal) closeRejectionModal();
            });
            
            // Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeModal();
                    closeRejectionModal();
                }
            });
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            setupModalClose();
            
            // Add loading states to buttons
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
                        submitBtn.disabled = true;
                    }
                });
            });
        });
    </script>
</body>
</html>