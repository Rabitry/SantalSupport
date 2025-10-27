<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics - Admin Dashboard</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
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
                        },
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b'
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
    <header class="bg-gradient-to-r from-teal-700 to-teal-800 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold flex items-center">
                        <i class="fas fa-chart-bar mr-3"></i>
                        Statistics Dashboard
                    </h1>
                    <p class="text-teal-100 mt-1">Santal Community Analytics & Insights</p>
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
                       class="px-3 py-2 rounded-lg hover:bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-user-friends mr-2"></i>
                        <span class="hidden sm:inline">Users</span>
                    </a>
                    <a href="{{ route('admin.statistics') }}" 
                       class="px-3 py-2 rounded-lg bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
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

        <!-- Overview Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Population -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 card-hover">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Total Population</p>
                        <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $populationStats->total }}</h3>
                        <p class="text-slate-400 text-xs mt-2">Registered Profiles</p>
                    </div>
                    <div class="bg-teal-50 p-3 rounded-lg">
                        <i class="fas fa-users text-teal-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Students -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 card-hover">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Students</p>
                        <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $populationStats->students }}</h3>
                        <p class="text-slate-400 text-xs mt-2">Student Profiles</p>
                    </div>
                    <div class="bg-amber-50 p-3 rounded-lg">
                        <i class="fas fa-graduation-cap text-amber-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Jobholders -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 card-hover">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Jobholders</p>
                        <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $populationStats->jobholders }}</h3>
                        <p class="text-slate-400 text-xs mt-2">Working Professionals</p>
                    </div>
                    <div class="bg-emerald-50 p-3 rounded-lg">
                        <i class="fas fa-briefcase text-emerald-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Gender Distribution -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 card-hover">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Gender Distribution</p>
                        <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $populationStats->males }}M / {{ $populationStats->females }}F</h3>
                        <p class="text-slate-400 text-xs mt-2">Male vs Female</p>
                    </div>
                    <div class="bg-purple-50 p-3 rounded-lg">
                        <i class="fas fa-venus-mars text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gender Distribution Chart -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8 card-hover">
            <h2 class="text-xl font-semibold text-slate-800 mb-6 flex items-center">
                <i class="fas fa-venus-mars mr-2 text-teal-500"></i>
                Gender Distribution
            </h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Male Progress -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-slate-700">Male</span>
                        <span class="text-sm text-slate-600">{{ $populationStats->males }} ({{ $populationStats->total > 0 ? round(($populationStats->males / $populationStats->total) * 100, 1) : 0 }}%)</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-3">
                        <div class="bg-teal-600 h-3 rounded-full smooth-transition" 
                             style="width: {{ $populationStats->total > 0 ? ($populationStats->males / $populationStats->total) * 100 : 0 }}%"></div>
                    </div>
                </div>

                <!-- Female Progress -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-slate-700">Female</span>
                        <span class="text-sm text-slate-600">{{ $populationStats->females }} ({{ $populationStats->total > 0 ? round(($populationStats->females / $populationStats->total) * 100, 1) : 0 }}%)</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-3">
                        <div class="bg-pink-500 h-3 rounded-full smooth-transition" 
                             style="width: {{ $populationStats->total > 0 ? ($populationStats->females / $populationStats->total) * 100 : 0 }}%"></div>
                    </div>
                </div>

                <!-- Total Summary -->
                <div class="bg-slate-50 rounded-xl p-4 text-center">
                    <div class="text-slate-500 text-sm mb-1">Total Population</div>
                    <div class="text-3xl font-bold text-teal-600">{{ $populationStats->total }}</div>
                    <div class="text-slate-400 text-xs mt-1">Registered Members</div>
                </div>
            </div>
        </div>

        <!-- Blood Group Statistics -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8 card-hover">
            <h2 class="text-xl font-semibold text-slate-800 mb-6 flex items-center">
                <i class="fas fa-tint mr-2 text-rose-500"></i>
                Blood Group Distribution
            </h2>
            
            @if($bloodGroupStats->count() > 0)
                <div class="space-y-4">
                    @foreach($bloodGroupStats as $bloodGroup)
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg smooth-transition hover:bg-slate-100">
                        <div class="flex items-center space-x-4">
                            <div class="bg-rose-100 text-rose-600 w-10 h-10 rounded-full flex items-center justify-center font-semibold">
                                {{ $bloodGroup->blood_group }}
                            </div>
                            <span class="font-medium text-slate-700">{{ $bloodGroup->blood_group }} Type</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-32 bg-slate-200 rounded-full h-3">
                                <div class="bg-rose-500 h-3 rounded-full smooth-transition" 
                                     style="width: {{ ($bloodGroup->count / $populationStats->total) * 100 }}%"></div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-slate-800">{{ $bloodGroup->count }}</div>
                                <div class="text-sm text-slate-500">{{ round(($bloodGroup->count / $populationStats->total) * 100, 1) }}%</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-tint text-slate-300 text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-slate-700 mb-2">No Blood Group Data</h3>
                    <p class="text-slate-500">Blood group information has not been collected yet.</p>
                </div>
            @endif
        </div>

        <!-- District Distribution -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8 card-hover">
            <h2 class="text-xl font-semibold text-slate-800 mb-6 flex items-center">
                <i class="fas fa-map-marker-alt mr-2 text-emerald-500"></i>
                District Distribution
            </h2>
            
            @if($districtStats->count() > 0)
                <div class="space-y-4">
                    @foreach($districtStats as $district)
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg smooth-transition hover:bg-slate-100">
                        <div class="flex items-center space-x-4">
                            <div class="bg-emerald-100 text-emerald-600 w-10 h-10 rounded-full flex items-center justify-center">
                                <i class="fas fa-map-pin"></i>
                            </div>
                            <span class="font-medium text-slate-700">{{ $district->district }}</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-32 bg-slate-200 rounded-full h-3">
                                <div class="bg-emerald-500 h-3 rounded-full smooth-transition" 
                                     style="width: {{ ($district->count / $populationStats->total) * 100 }}%"></div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-slate-800">{{ $district->count }}</div>
                                <div class="text-sm text-slate-500">{{ round(($district->count / $populationStats->total) * 100, 1) }}%</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-map-marker-alt text-slate-300 text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-slate-700 mb-2">No District Data</h3>
                    <p class="text-slate-500">District information has not been collected yet.</p>
                </div>
            @endif
        </div>

        <!-- Occupation Distribution -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8 card-hover">
            <h2 class="text-xl font-semibold text-slate-800 mb-6 flex items-center">
                <i class="fas fa-briefcase mr-2 text-amber-500"></i>
                Occupation Distribution
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Students -->
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 text-center smooth-transition hover:bg-amber-100">
                    <div class="bg-amber-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-graduation-cap text-amber-600 text-2xl"></i>
                    </div>
                    <div class="text-3xl font-bold text-amber-600 mb-2">{{ $populationStats->students }}</div>
                    <div class="text-amber-800 font-medium mb-1">Students</div>
                    <div class="text-amber-600 text-sm">
                        {{ $populationStats->total > 0 ? round(($populationStats->students / $populationStats->total) * 100, 1) : 0 }}% of total
                    </div>
                </div>

                <!-- Jobholders -->
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-6 text-center smooth-transition hover:bg-emerald-100">
                    <div class="bg-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-briefcase text-emerald-600 text-2xl"></i>
                    </div>
                    <div class="text-3xl font-bold text-emerald-600 mb-2">{{ $populationStats->jobholders }}</div>
                    <div class="text-emerald-800 font-medium mb-1">Jobholders</div>
                    <div class="text-emerald-600 text-sm">
                        {{ $populationStats->total > 0 ? round(($populationStats->jobholders / $populationStats->total) * 100, 1) : 0 }}% of total
                    </div>
                </div>

                <!-- Others -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-6 text-center smooth-transition hover:bg-slate-100">
                    <div class="bg-slate-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user text-slate-600 text-2xl"></i>
                    </div>
                    <div class="text-3xl font-bold text-slate-600 mb-2">
                        {{ $populationStats->total - $populationStats->students - $populationStats->jobholders }}
                    </div>
                    <div class="text-slate-800 font-medium mb-1">Others</div>
                    <div class="text-slate-600 text-sm">
                        {{ $populationStats->total > 0 ? round((($populationStats->total - $populationStats->students - $populationStats->jobholders) / $populationStats->total) * 100, 1) : 0 }}% of total
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Profiles -->
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-2xl p-6 shadow-sm card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-teal-100 text-sm font-medium mb-1">Total Profiles</div>
                        <div class="text-3xl font-bold">{{ $populationStats->total }}</div>
                        <div class="text-teal-100 text-xs mt-1">Registered Population</div>
                    </div>
                    <div class="bg-teal-400 bg-opacity-20 p-3 rounded-full">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Data Coverage -->
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-2xl p-6 shadow-sm card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-emerald-100 text-sm font-medium mb-1">Data Coverage</div>
                        <div class="text-3xl font-bold">{{ $bloodGroupStats->count() + $districtStats->count() }}</div>
                        <div class="text-emerald-100 text-xs mt-1">Blood Groups & Districts</div>
                    </div>
                    <div class="bg-emerald-400 bg-opacity-20 p-3 rounded-full">
                        <i class="fas fa-database text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Geographic Reach -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-2xl p-6 shadow-sm card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-purple-100 text-sm font-medium mb-1">Geographic Reach</div>
                        <div class="text-3xl font-bold">{{ $districtStats->count() }}</div>
                        <div class="text-purple-100 text-xs mt-1">Districts Covered</div>
                    </div>
                    <div class="bg-purple-400 bg-opacity-20 p-3 rounded-full">
                        <i class="fas fa-map text-2xl"></i>
                    </div>
                </div>
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

        // Add subtle animations to progress bars
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.bg-teal-600, .bg-pink-500, .bg-rose-500, .bg-emerald-500');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });
        });
    </script>
</body>
</html>