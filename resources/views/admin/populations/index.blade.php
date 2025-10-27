<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Population Management - Admin Dashboard</title>
    
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
        .table-row-hover:hover {
            background-color: #f8fafc;
        }
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
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased">
    <!-- Admin Header -->
    <header class="bg-gradient-to-r from-primary-800 to-primary-900 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold flex items-center">
                        <i class="fas fa-users mr-3"></i>
                        Population Management
                    </h1>
                    <p class="text-primary-100 mt-1">Santal Community Admin Dashboard</p>
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
                       class="px-3 py-2 rounded-lg bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-users mr-2"></i>
                        <span class="hidden sm:inline">Populations</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-3 py-2 rounded-lg hover:bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-user-friends mr-2"></i>
                        <span class="hidden sm:inline">Users</span>
                    </a>
                    <a href="{{ route('admin.posts.index') }}" 
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
                Search & Filter Populations
            </h2>
            
            <form method="GET" action="{{ route('admin.populations.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                    <!-- Search Input -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-search mr-1 text-slate-500"></i>Search
                        </label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Name, email, phone, occupation..."
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 smooth-transition">
                    </div>
                    
                    <!-- Occupation Filter -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-briefcase mr-1 text-slate-500"></i>Occupation
                        </label>
                        <select name="occupation" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 smooth-transition">
                            <option value="">All Occupations</option>
                            @foreach($occupations as $occupation)
                                <option value="{{ $occupation }}" {{ request('occupation') == $occupation ? 'selected' : '' }}>
                                    {{ $occupation }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- District Filter -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-map-marker-alt mr-1 text-slate-500"></i>District
                        </label>
                        <select name="district" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 smooth-transition">
                            <option value="">All Districts</option>
                            @foreach($districts as $district)
                                <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>
                                    {{ $district }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-end space-x-2">
                        <button type="submit" 
                                class="w-full bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-lg font-medium smooth-transition flex items-center justify-center shadow-sm">
                            <i class="fas fa-filter mr-2"></i>
                            Apply
                        </button>
                        <a href="{{ route('admin.populations.index') }}" 
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
                        <h3 class="font-semibold text-slate-800">Population Statistics</h3>
                        <p class="text-sm text-slate-600">
                            @php
                                $totalPopulations = $populations->total() ?? $populations->count();
                                $firstItem = method_exists($populations, 'firstItem') ? $populations->firstItem() : 1;
                                $lastItem = method_exists($populations, 'lastItem') ? $populations->lastItem() : $populations->count();
                            @endphp
                            Showing {{ $firstItem }} - {{ $lastItem }} of {{ $totalPopulations }} populations
                            @if(request()->has('search') || request()->has('occupation') || request()->has('district'))
                                <span class="text-primary-600 font-medium">(Filtered Results)</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="flex space-x-4 text-sm">
                    <div class="text-center">
                        <div class="font-bold text-primary-600">{{ $totalPopulations }}</div>
                        <div class="text-slate-500">Total</div>
                    </div>
                    <div class="text-center">
                        <div class="font-bold text-emerald-600">{{ \App\Models\Population::where('occupation', 'Student')->count() }}</div>
                        <div class="text-slate-500">Students</div>
                    </div>
                    <div class="text-center">
                        <div class="font-bold text-amber-600">{{ \App\Models\Population::where('occupation', 'Jobholder')->count() }}</div>
                        <div class="text-slate-500">Jobholder</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Populations Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden card-hover">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                    <i class="fas fa-list mr-2 text-slate-500"></i>
                    Population Records
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
                                Profile
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Personal Details
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Contact Information
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Location
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($populations as $population)
                        <tr class="table-row-hover smooth-transition hover:bg-primary-50">
                            <!-- ID -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-mono text-slate-900">#{{ $population->id }}</div>
                            </td>
                            
                            <!-- Profile Picture -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($population->profile_picture)
                                        <img src="{{ asset('storage/'.$population->profile_picture) }}" 
                                             alt="Profile" 
                                             class="w-12 h-12 rounded-full object-cover border-2 border-slate-200 shadow-sm">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-primary-500 to-indigo-500 flex items-center justify-center shadow-sm">
                                            <span class="text-white font-semibold text-sm">{{ strtoupper(substr($population->name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            
                            <!-- Personal Details -->
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <div class="text-sm font-medium text-slate-900">{{ $population->name }}</div>
                                    <div class="flex items-center text-sm text-slate-500">
                                        <i class="fas fa-briefcase mr-1.5 text-slate-400"></i>
                                        <span>{{ $population->occupation }}</span>
                                    </div>
                                    <div class="text-xs text-slate-400 mt-2">
                                        <i class="fas fa-clock mr-1"></i>{{ $population->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Contact Information -->
                            <td class="px-6 py-4">
                                <div class="space-y-2">
                                    <div class="flex items-center text-sm text-slate-700">
                                        <i class="fas fa-phone mr-2 text-slate-400"></i>
                                        <span>{{ $population->phone ?? 'Not provided' }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-slate-700">
                                        <i class="fas fa-envelope mr-2 text-slate-400"></i>
                                        <span class="truncate max-w-[180px]">{{ $population->email ?? 'Not provided' }}</span>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Location -->
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <div class="flex items-center text-sm text-slate-700">
                                        <i class="fas fa-map-marker-alt mr-2 text-slate-400"></i>
                                        <span>{{ $population->district ?? 'Not specified' }}</span>
                                    </div>
                                    @if($population->village)
                                    <div class="text-xs text-slate-500 ml-6">
                                        {{ $population->village }}
                                    </div>
                                    @endif
                                </div>
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-6 py-4">
                                <div class="flex flex-col space-y-2">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.populations.show', $population->id) }}" 
                                           class="flex-1 bg-primary-500 hover:bg-primary-600 text-white px-3 py-1.5 rounded text-xs font-medium smooth-transition flex items-center justify-center shadow-sm">
                                            <i class="fas fa-eye mr-1"></i>View
                                        </a>
                                        <a href="{{ route('admin.populations.edit', $population->id) }}" 
                                           class="flex-1 bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded text-xs font-medium smooth-transition flex items-center justify-center shadow-sm">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.populations.destroy', $population->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full bg-rose-500 hover:bg-rose-600 text-white px-3 py-1.5 rounded text-xs font-medium smooth-transition flex items-center justify-center shadow-sm"
                                                onclick="return confirm('Are you sure you want to delete this population record?')">
                                            <i class="fas fa-trash mr-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-500">
                                    <i class="fas fa-users text-4xl mb-4 text-slate-300"></i>
                                    <h4 class="text-lg font-medium text-slate-700 mb-2">No Population Records Found</h4>
                                    <p class="text-slate-500 max-w-md">
                                        @if(request()->has('search') || request()->has('occupation') || request()->has('district'))
                                            No population records match your current filters. Try adjusting your search criteria.
                                        @else
                                            No population records have been added yet.
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
            @if(method_exists($populations, 'links') && $populations->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <div class="text-sm text-slate-700">
                        Showing {{ $populations->firstItem() ?? 0 }} to {{ $populations->lastItem() ?? 0 }} of {{ $populations->total() }} results
                    </div>
                    <div class="flex space-x-1">
                        <!-- Previous Page Link -->
                        @if($populations->onFirstPage())
                            <span class="px-3 py-1 bg-slate-200 text-slate-500 rounded-lg text-sm cursor-not-allowed">
                                <i class="fas fa-chevron-left mr-1"></i> Previous
                            </span>
                        @else
                            <a href="{{ $populations->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}" 
                               class="px-3 py-1 bg-primary-500 hover:bg-primary-600 text-white rounded-lg text-sm smooth-transition flex items-center shadow-sm">
                                <i class="fas fa-chevron-left mr-1"></i> Previous
                            </a>
                        @endif

                        <!-- Page Numbers -->
                        @foreach($populations->getUrlRange(1, $populations->lastPage()) as $page => $url)
                            @if($page == $populations->currentPage())
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
                        @if($populations->hasMorePages())
                            <a href="{{ $populations->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}" 
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

    <script>
        // Add loading states to forms
        document.addEventListener('DOMContentLoaded', function() {
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
            
            // Preserve search parameters in pagination links
            const paginationLinks = document.querySelectorAll('.pagination a');
            paginationLinks.forEach(link => {
                const url = new URL(link.href);
                const currentParams = new URLSearchParams(window.location.search);
                
                // Add all current search parameters to pagination links
                currentParams.forEach((value, key) => {
                    if (key !== 'page') {
                        url.searchParams.set(key, value);
                    }
                });
                
                link.href = url.toString();
            });
        });
    </script>
</body>
</html>