<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Admin Dashboard</title>
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
        body { 
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif; 
            background: #f8fafc; 
        }
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
<body class="bg-slate-50">
    <!-- Admin Header -->
    <header class="bg-gradient-to-r from-primary-800 to-primary-900 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold flex items-center">
                        <i class="fas fa-user-edit mr-3"></i>
                        Edit User
                    </h1>
                    <p class="text-primary-100 mt-1">Santal Community Admin Dashboard</p>
                </div>
                <nav class="flex space-x-4">
                    <a href="{{ route('admin.users.index') }}" 
                       class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg font-medium smooth-transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Users
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
                    <!-- <a href="{{ route('dashboard') }}" 
                       class="px-3 py-2 rounded-lg hover:bg-slate-700 smooth-transition flex items-center text-sm lg:text-base">
                        <i class="fas fa-newspaper mr-2"></i>
                        <span class="hidden sm:inline">Posts</span>
                    </a> -->
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

    <div class="container mx-auto max-w-4xl p-6">
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

        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 mb-6 shadow-sm card-hover">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-rose-500 mr-3 text-lg mt-0.5"></i>
                    <div>
                        <h4 class="text-rose-800 font-semibold mb-2">Please fix the following errors:</h4>
                        <ul class="list-disc list-inside text-rose-600 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- User Information Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6 card-hover">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 p-5 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-xl font-bold flex items-center">
                            <i class="fas fa-user-circle mr-3"></i>
                            User Information
                        </h2>
                        <p class="text-primary-100 text-sm mt-1">Editing: {{ $user->name }}</p>
                    </div>
                    <div class="mt-2 md:mt-0 flex items-center text-sm">
                        <i class="fas fa-clock mr-1"></i>
                        <span>Last updated: {{ $user->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                            <i class="fas fa-id-card mr-2 text-primary-500"></i>
                            Basic Information
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                                    <i class="fas fa-user mr-1 text-slate-500"></i>Full Name
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                                       class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 smooth-transition shadow-sm"
                                       required>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                                    <i class="fas fa-envelope mr-1 text-slate-500"></i>Email Address
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                       class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 smooth-transition shadow-sm"
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- Role Management -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                            <i class="fas fa-user-shield mr-2 text-violet-500"></i>
                            Role Management
                        </h3>
                        
                        <div class="bg-violet-50 border border-violet-200 rounded-xl p-5 shadow-sm">
                            <label for="role" class="block text-sm font-medium text-slate-700 mb-3">
                                <i class="fas fa-user-tag mr-1 text-violet-500"></i>User Role
                            </label>
                            <select id="role" name="role" 
                                    class="w-full px-4 py-3 border border-violet-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 smooth-transition bg-white shadow-sm"
                                    required>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }} class="py-2">
                                    <i class="fas fa-user mr-2"></i> Regular User
                                </option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }} class="py-2">
                                    <i class="fas fa-crown mr-2"></i> Administrator
                                </option>
                            </select>
                            
                            <div id="role-info" class="mt-4 text-sm">
                                @if($user->role === 'admin')
                                    <div class="flex items-center bg-amber-50 border border-amber-200 px-4 py-3 rounded-lg">
                                        <i class="fas fa-crown mr-3 text-amber-500 text-lg"></i>
                                        <div>
                                            <span class="font-semibold text-amber-800">This user currently has Administrator privileges</span>
                                            <p class="text-amber-700 text-xs mt-1">Administrators have full access to all system features and data.</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center text-slate-600">
                                        <i class="fas fa-info-circle mr-3 text-primary-500"></i>
                                        <span>Select "Administrator" to grant full admin access to this user</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- User Status -->
                    @if(isset($user->status))
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                            <i class="fas fa-user-check mr-2 text-emerald-500"></i>
                            Account Status
                        </h3>
                        
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 shadow-sm">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-slate-700 mr-3">Current Status:</span>
                                    <span class="px-3 py-1.5 rounded-full text-xs font-semibold 
                                        {{ $user->status === 'approved' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 
                                           ($user->status === 'pending' ? 'bg-amber-100 text-amber-800 border border-amber-200' : 
                                           'bg-rose-100 text-rose-800 border border-rose-200') }} flex items-center">
                                        <i class="fas {{ $user->status === 'approved' ? 'fa-check-circle' : 
                                                       ($user->status === 'pending' ? 'fa-clock' : 
                                                       'fa-times-circle') }} mr-1.5"></i>
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </div>
                                <div class="flex space-x-2">
                                    @if($user->status === 'pending')
                                        <a href="{{ route('admin.users.approve', $user->id) }}" 
                                           class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm smooth-transition flex items-center shadow-sm">
                                            <i class="fas fa-check mr-2"></i>Approve Account
                                        </a>
                                    @endif
                                    @if($user->status === 'approved')
                                        <button type="button" 
                                                onclick="showRejectionModal()"
                                                class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-lg text-sm smooth-transition flex items-center shadow-sm">
                                            <i class="fas fa-times mr-2"></i>Reject Account
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-slate-200">
                        <div class="text-sm text-slate-500 flex items-center">
                            <i class="fas fa-calendar mr-2"></i>
                            Member since: {{ $user->created_at->format('M d, Y') }}
                        </div>
                        
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.users.index') }}" 
                               class="bg-slate-500 hover:bg-slate-600 text-white px-6 py-3 rounded-lg font-medium smooth-transition flex items-center shadow-sm">
                                <i class="fas fa-times mr-2"></i>Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-3 rounded-lg font-medium smooth-transition flex items-center shadow-sm">
                                <i class="fas fa-save mr-2"></i>Update User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="bg-white rounded-2xl shadow-sm border border-rose-200 overflow-hidden card-hover">
            <div class="bg-gradient-to-r from-rose-500 to-rose-600 p-5 text-white">
                <h2 class="text-xl font-bold flex items-center">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    Danger Zone
                </h2>
            </div>
            <div class="p-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex-1">
                        <h3 class="font-semibold text-rose-700 mb-1">Delete User Account</h3>
                        <p class="text-sm text-slate-600">Once deleted, this user account and all associated data cannot be recovered. This action is permanent.</p>
                    </div>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                          onsubmit="return confirmDeletion()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-rose-500 hover:bg-rose-600 text-white px-6 py-3 rounded-lg font-medium smooth-transition flex items-center shadow-sm">
                            <i class="fas fa-trash mr-2"></i>Delete User
                        </button>
                    </form>
                </div>
            </div>
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
                        <h3 class="text-lg font-semibold text-slate-800">Reject User Account</h3>
                        <p class="text-sm text-slate-600">This will revoke the user's access</p>
                    </div>
                </div>
                
                <form action="{{ route('admin.users.reject', $user->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Rejection Reason <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="rejection_reason" required 
                                  class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 smooth-transition"
                                  placeholder="Explain why this user account is being rejected..."
                                  rows="4"></textarea>
                        <p class="text-xs text-slate-500 mt-1">This reason will be visible to the user.</p>
                    </div>
                    
                    <div class="flex space-x-3">
                        <button type="submit" 
                                class="flex-1 bg-rose-500 hover:bg-rose-600 text-white px-6 py-3 rounded-lg font-medium smooth-transition flex items-center justify-center shadow-sm">
                            <i class="fas fa-ban mr-2"></i>Reject Account
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
        // Role selection change handler
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const roleInfo = document.getElementById('role-info');
            
            roleSelect.addEventListener('change', function() {
                if (this.value === 'admin') {
                    roleInfo.innerHTML = `
                        <div class="flex items-center bg-amber-50 border border-amber-200 px-4 py-3 rounded-lg">
                            <i class="fas fa-exclamation-triangle mr-3 text-amber-500 text-lg"></i>
                            <div>
                                <span class="font-semibold text-amber-800">Warning: This will grant full administrator privileges!</span>
                                <p class="text-amber-700 text-xs mt-1">Administrators have access to all system features, including user management and sensitive data.</p>
                            </div>
                        </div>
                    `;
                } else {
                    roleInfo.innerHTML = `
                        <div class="flex items-center text-slate-600">
                            <i class="fas fa-info-circle mr-3 text-primary-500"></i>
                            <span>Select "Administrator" to grant full admin access to this user</span>
                        </div>
                    `;
                }
            });
            
            // Add loading states to forms
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

        // Rejection modal functionality
        function showRejectionModal() {
            document.getElementById('rejectionModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeRejectionModal() {
            document.getElementById('rejectionModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Confirm deletion
        function confirmDeletion() {
            return confirm('Are you sure you want to permanently delete this user? This action cannot be undone and all user data will be lost.');
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const rejectionModal = document.getElementById('rejectionModal');
            if (event.target === rejectionModal) {
                closeRejectionModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeRejectionModal();
            }
        });
    </script>
</body>
</html>