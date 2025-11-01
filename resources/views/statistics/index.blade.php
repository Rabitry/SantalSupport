<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Statistics - Santal Directory</title>
    
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
                        secondary: {
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
        .gradient-bg {
            background: linear-gradient(135deg, #0f766e 0%, #115e59 100%);
        }
    </style>
</head>
<body class="bg-secondary-50 font-sans antialiased">
    <!-- Header -->
    <header class="gradient-bg text-white shadow-lg">
        <div class="container mx-auto px-6 py-6">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl font-bold flex items-center justify-center lg:justify-start">
                        <i class="fas fa-chart-pie mr-3"></i>
                        Community Statistics
                    </h1>
                    <p class="text-primary-100 mt-2">Santal Community Insights & Analytics</p>
                </div>
                <nav class="flex space-x-4 justify-center lg:justify-start">
                    <a href="{{ url('/') }}" 
                       class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg font-medium smooth-transition flex items-center">
                        <i class="fas fa-home mr-2"></i>
                        Back to Home
                    </a>
                    <a href="{{ url('/population') }}" 
                       class="bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-4 py-2 rounded-lg font-medium smooth-transition flex items-center">
                        <i class="fas fa-users mr-2"></i>
                        Directory
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <!-- Welcome Message -->
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 mb-8 card-hover">
            <div class="flex items-center space-x-4">
                <div class="bg-primary-100 text-primary-600 w-12 h-12 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-secondary-800">Community Insights</h2>
                    <p class="text-secondary-600">Explore statistics about our Santal community members</p>
                </div>
            </div>
        </div>

        <!-- Key Statistics Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Members -->
            <div class="bg-white rounded-xl shadow-sm border border-secondary-200 p-6 card-hover text-center">
                <div class="bg-primary-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-primary-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-secondary-800">{{ $populationStats->total }}</h3>
                <p class="text-secondary-600 font-medium">Total Members</p>
                <p class="text-secondary-400 text-sm mt-1">Registered in Directory</p>
            </div>

            <!-- Students -->
            <div class="bg-white rounded-xl shadow-sm border border-secondary-200 p-6 card-hover text-center">
                <div class="bg-amber-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-graduation-cap text-amber-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-secondary-800">{{ $populationStats->students }}</h3>
                <p class="text-secondary-600 font-medium">Students</p>
                <p class="text-secondary-400 text-sm mt-1">Pursuing Education</p>
            </div>

            <!-- Professionals -->
            <div class="bg-white rounded-xl shadow-sm border border-secondary-200 p-6 card-hover text-center">
                <div class="bg-emerald-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-briefcase text-emerald-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-secondary-800">{{ $populationStats->jobholders }}</h3>
                <p class="text-secondary-600 font-medium">Professionals</p>
                <p class="text-secondary-400 text-sm mt-1">Working Population</p>
            </div>

            <!-- Gender Balance -->
            <div class="bg-white rounded-xl shadow-sm border border-secondary-200 p-6 card-hover text-center">
                <div class="bg-purple-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-venus-mars text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-secondary-800">{{ $populationStats->males }}M / {{ $populationStats->females }}F</h3>
                <p class="text-secondary-600 font-medium">Gender Ratio</p>
                <p class="text-secondary-400 text-sm mt-1">Community Balance</p>
            </div>
        </div>

        <!-- Gender Distribution -->
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 mb-8 card-hover">
            <h2 class="text-xl font-semibold text-secondary-800 mb-6 flex items-center">
                <i class="fas fa-venus-mars mr-2 text-primary-500"></i>
                Gender Distribution
            </h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Male -->
                <div class="text-center">
                    <div class="bg-primary-50 rounded-xl p-6">
                        <div class="bg-primary-100 text-primary-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-mars text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary-800">{{ $populationStats->males }}</h3>
                        <p class="text-secondary-600 font-medium">Male Members</p>
                        <div class="mt-4 bg-secondary-200 rounded-full h-3">
                            <div class="bg-primary-600 h-3 rounded-full smooth-transition" 
                                 style="width: {{ $populationStats->total > 0 ? ($populationStats->males / $populationStats->total) * 100 : 0 }}%"></div>
                        </div>
                        <p class="text-secondary-500 text-sm mt-2">
                            {{ $populationStats->total > 0 ? round(($populationStats->males / $populationStats->total) * 100, 1) : 0 }}% of total
                        </p>
                    </div>
                </div>

                <!-- Female -->
                <div class="text-center">
                    <div class="bg-pink-50 rounded-xl p-6">
                        <div class="bg-pink-100 text-pink-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-venus text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary-800">{{ $populationStats->females }}</h3>
                        <p class="text-secondary-600 font-medium">Female Members</p>
                        <div class="mt-4 bg-secondary-200 rounded-full h-3">
                            <div class="bg-pink-500 h-3 rounded-full smooth-transition" 
                                 style="width: {{ $populationStats->total > 0 ? ($populationStats->females / $populationStats->total) * 100 : 0 }}%"></div>
                        </div>
                        <p class="text-secondary-500 text-sm mt-2">
                            {{ $populationStats->total > 0 ? round(($populationStats->females / $populationStats->total) * 100, 1) : 0 }}% of total
                        </p>
                    </div>
                </div>

                <!-- Total Summary -->
                <div class="text-center">
                    <div class="bg-secondary-50 rounded-xl p-6 h-full flex flex-col justify-center">
                        <div class="bg-secondary-100 text-secondary-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chart-pie text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary-800">{{ $populationStats->total }}</h3>
                        <p class="text-secondary-600 font-medium">Total Community</p>
                        <div class="mt-4">
                            <div class="flex justify-between text-sm text-secondary-500">
                                <span>Male: {{ $populationStats->total > 0 ? round(($populationStats->males / $populationStats->total) * 100, 1) : 0 }}%</span>
                                <span>Female: {{ $populationStats->total > 0 ? round(($populationStats->females / $populationStats->total) * 100, 1) : 0 }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Occupation Distribution -->
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 mb-8 card-hover">
            <h2 class="text-xl font-semibold text-secondary-800 mb-6 flex items-center">
                <i class="fas fa-briefcase mr-2 text-amber-500"></i>
                Occupation Overview
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
                        {{ $populationStats->total > 0 ? round(($populationStats->students / $populationStats->total) * 100, 1) : 0 }}% of community
                    </div>
                </div>

                <!-- Professionals -->
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-6 text-center smooth-transition hover:bg-emerald-100">
                    <div class="bg-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-briefcase text-emerald-600 text-2xl"></i>
                    </div>
                    <div class="text-3xl font-bold text-emerald-600 mb-2">{{ $populationStats->jobholders }}</div>
                    <div class="text-emerald-800 font-medium mb-1">Working Professionals</div>
                    <div class="text-emerald-600 text-sm">
                        {{ $populationStats->total > 0 ? round(($populationStats->jobholders / $populationStats->total) * 100, 1) : 0 }}% of community
                    </div>
                </div>

                <!-- Others -->
                <div class="bg-secondary-50 border border-secondary-200 rounded-xl p-6 text-center smooth-transition hover:bg-secondary-100">
                    <div class="bg-secondary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user text-secondary-600 text-2xl"></i>
                    </div>
                    <div class="text-3xl font-bold text-secondary-600 mb-2">
                        {{ $populationStats->total - $populationStats->students - $populationStats->jobholders }}
                    </div>
                    <div class="text-secondary-800 font-medium mb-1">Other Occupations</div>
                    <div class="text-secondary-600 text-sm">
                        {{ $populationStats->total > 0 ? round((($populationStats->total - $populationStats->students - $populationStats->jobholders) / $populationStats->total) * 100, 1) : 0 }}% of community
                    </div>
                </div>
            </div>
        </div>

        <!-- Blood Group Distribution -->
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 mb-8 card-hover">
            <h2 class="text-xl font-semibold text-secondary-800 mb-6 flex items-center">
                <i class="fas fa-tint mr-2 text-rose-500"></i>
                Blood Group Distribution
            </h2>
            
            @if($bloodGroupStats->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($bloodGroupStats as $bloodGroup)
                    <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 text-center smooth-transition hover:bg-rose-100">
                        <div class="bg-white text-rose-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 font-bold text-lg border border-rose-300">
                            {{ $bloodGroup->blood_group }}
                        </div>
                        <div class="text-2xl font-bold text-rose-600 mb-1">{{ $bloodGroup->count }}</div>
                        <div class="text-rose-800 font-medium text-sm">Blood Group {{ $bloodGroup->blood_group }}</div>
                        <div class="text-rose-600 text-xs mt-1">
                            {{ round(($bloodGroup->count / $populationStats->total) * 100, 1) }}% of community
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-tint text-secondary-300 text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-secondary-700 mb-2">Blood Group Data Coming Soon</h3>
                    <p class="text-secondary-500">We're collecting blood group information from our community members.</p>
                </div>
            @endif
        </div>

        <!-- Geographic Distribution -->
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 mb-8 card-hover">
            <h2 class="text-xl font-semibold text-secondary-800 mb-6 flex items-center">
                <i class="fas fa-map-marker-alt mr-2 text-emerald-500"></i>
                Community Geographic Spread
            </h2>
            
            @if($districtStats->count() > 0)
                <div class="space-y-4">
                    @foreach($districtStats->take(10) as $district)
                    <div class="flex items-center justify-between p-4 bg-secondary-50 rounded-lg smooth-transition hover:bg-secondary-100">
                        <div class="flex items-center space-x-4">
                            <div class="bg-emerald-100 text-emerald-600 w-10 h-10 rounded-full flex items-center justify-center">
                                <i class="fas fa-map-pin"></i>
                            </div>
                            <div>
                                <span class="font-medium text-secondary-700">{{ $district->district }}</span>
                                <p class="text-secondary-500 text-sm">{{ $district->count }} members</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-24 bg-secondary-200 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full smooth-transition" 
                                     style="width: {{ ($district->count / $populationStats->total) * 100 }}%"></div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-secondary-500">{{ round(($district->count / $populationStats->total) * 100, 1) }}%</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    @if($districtStats->count() > 10)
                    <div class="text-center pt-4">
                        <p class="text-secondary-500">... and {{ $districtStats->count() - 10 }} more districts</p>
                    </div>
                    @endif
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-map-marker-alt text-secondary-300 text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-secondary-700 mb-2">Geographic Data Coming Soon</h3>
                    <p class="text-secondary-500">We're mapping our community members across different districts.</p>
                </div>
            @endif
        </div>

        <!-- Community Impact -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Reach -->
            <div class="bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-2xl p-6 shadow-sm card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-primary-100 text-sm font-medium mb-1">Community Size</div>
                        <div class="text-3xl font-bold">{{ $populationStats->total }}</div>
                        <div class="text-primary-100 text-xs mt-1">Registered Members</div>
                    </div>
                    <div class="bg-primary-400 bg-opacity-20 p-3 rounded-full">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Geographic Coverage -->
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-2xl p-6 shadow-sm card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-emerald-100 text-sm font-medium mb-1">Districts Covered</div>
                        <div class="text-3xl font-bold">{{ $districtStats->count() }}</div>
                        <div class="text-emerald-100 text-xs mt-1">Geographic Reach</div>
                    </div>
                    <div class="bg-emerald-400 bg-opacity-20 p-3 rounded-full">
                        <i class="fas fa-map text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Data Diversity -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-2xl p-6 shadow-sm card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-purple-100 text-sm font-medium mb-1">Blood Groups</div>
                        <div class="text-3xl font-bold">{{ $bloodGroupStats->count() }}</div>
                        <div class="text-purple-100 text-xs mt-1">Different Types</div>
                    </div>
                    <div class="bg-purple-400 bg-opacity-20 p-3 rounded-full">
                        <i class="fas fa-tint text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="bg-primary-50 border border-primary-200 rounded-2xl p-8 text-center card-hover">
            <div class="bg-primary-100 text-primary-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-hands-helping text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-primary-800 mb-2">Join Our Growing Community</h2>
            <p class="text-primary-600 mb-6 max-w-2xl mx-auto">
                Be part of our vibrant Santal community. Register your profile to connect with others and contribute to our collective growth.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" 
                   class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold smooth-transition flex items-center justify-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Register Now
                </a>
                <a href="{{ url('/population') }}" 
                   class="bg-white hover:bg-primary-50 text-primary-600 border border-primary-600 px-6 py-3 rounded-lg font-semibold smooth-transition flex items-center justify-center">
                    <i class="fas fa-search mr-2"></i>
                    Browse Directory
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-secondary-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex items-center space-x-3">
                    <div class="bg-primary-600 w-8 h-8 rounded-full flex items-center justify-center">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="text-lg font-semibold">Santal Community</span>
                </div>
                <div class="text-secondary-300 text-center md:text-right">
                    <p>Community Statistics & Insights</p>
                    <p class="text-sm mt-1">&copy; {{ date('Y') }} Santal Community Directory. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Animate progress bars on page load
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.bg-primary-600, .bg-pink-500, .bg-emerald-500, .bg-rose-500');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>