<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Admin</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8f9fa; margin: 0; }
        .admin-header { background: linear-gradient(135deg, #dc3545, #c82333); color: white; padding: 15px 30px; }
        .admin-nav { background: #343a40; padding: 10px 30px; }
        .admin-nav a { color: white; text-decoration: none; margin-right: 20px; padding: 8px 15px; border-radius: 5px; }
        .admin-nav a:hover { background: #495057; }
        .container { max-width: 1400px; margin: 20px auto; padding: 20px; }
        
        /* Search and Filter Styles */
        .search-filter-container { 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            margin-bottom: 20px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: end;
        }
        .search-box { flex: 1; min-width: 300px; }
        .search-box input, .filter-select select { 
            width: 100%; 
            padding: 10px; 
            border: 1px solid #ddd; 
            border-radius: 5px; 
            font-size: 14px;
        }
        .filter-select { min-width: 200px; }
        .search-btn { 
            background: #007bff; 
            color: white; 
            border: none; 
            padding: 10px 20px; 
            border-radius: 5px; 
            cursor: pointer;
            font-size: 14px;
        }
        .search-btn:hover { background: #0056b3; }
        .reset-btn { 
            background: #6c757d; 
            color: white; 
            border: none; 
            padding: 10px 20px; 
            border-radius: 5px; 
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .reset-btn:hover { background: #545b62; }
        
        .table { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #007bff; color: white; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge-admin { background: #dc3545; color: white; }
        .badge-user { background: #6c757d; color: white; }
        .badge-success { background: #28a745; color: white; }
        .badge-warning { background: #ffc107; color: black; }
        .badge-danger { background: #dc3545; color: white; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 12px; border: none; cursor: pointer; }
        .btn-view { background: #17a2b8; color: white; }
        .btn-edit { background: #ffc107; color: black; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .id-images { display: flex; gap: 10px; margin-top: 5px; }
        .id-image { width: 60px; height: 40px; object-fit: cover; border-radius: 4px; cursor: pointer; border: 1px solid #ddd; }
        
        /* Pagination Styles */
        .pagination { 
            display: flex; 
            justify-content: center; 
            margin-top: 20px; 
            gap: 5px;
        }
        .pagination a, .pagination span {
            padding: 8px 12px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #007bff;
        }
        .pagination a:hover {
            background: #007bff;
            color: white;
        }
        .pagination .current {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }
        .pagination .disabled {
            color: #6c757d;
            cursor: not-allowed;
        }
        
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); }
        .modal-content { margin: 5% auto; display: block; max-width: 80%; max-height: 80%; }
        .close { position: absolute; top: 20px; right: 35px; color: white; font-size: 40px; font-weight: bold; cursor: pointer; }
        
        /* Results Count */
        .results-count { 
            background: #e9ecef; 
            padding: 10px 15px; 
            border-radius: 5px; 
            margin-bottom: 15px;
            font-size: 14px;
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <h1>👤 User Management - Santal Community</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}" style="color: white;">← Back to Dashboard</a>
        </div>
    </div>

    <div class="admin-nav">
        <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
        <a href="{{ route('admin.populations.index') }}">👥 Populations</a>
        <a href="{{ route('admin.users.index') }}">👤 Users</a>
        <a href="{{ route('admin.statistics') }}">📈 Statistics</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: white; cursor: pointer;">🚪 Logout</button>
        </form>
    </div>

    <div class="container">
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Search and Filter Section -->
        <div class="search-filter-container">
            <form method="GET" action="{{ route('admin.users.index') }}" style="display: contents;">
                <div class="search-box">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Search Users:</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search by name, email, student ID, national ID...">
                </div>
                
                <div class="filter-select">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Status:</label>
                    <select name="status">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                
                <div class="filter-select">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Role:</label>
                    <select name="role">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                
                <div class="filter-select">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Profile Created:</label>
                    <select name="profile_created">
                        <option value="">All</option>
                        <option value="yes" {{ request('profile_created') == 'yes' ? 'selected' : '' }}>Profile Created</option>
                        <option value="no" {{ request('profile_created') == 'no' ? 'selected' : '' }}>No Profile</option>
                    </select>
                </div>
                
                <button type="submit" class="search-btn">🔍 Search</button>
                <a href="{{ route('admin.users.index') }}" class="reset-btn">🔄 Reset</a>
            </form>
        </div>

        <!-- Results Count - FIXED -->
        <div class="results-count">
            @php
                $totalUsers = $users->total() ?? $users->count();
                $firstItem = method_exists($users, 'firstItem') ? $users->firstItem() : 1;
                $lastItem = method_exists($users, 'lastItem') ? $users->lastItem() : $users->count();
            @endphp
            
            Showing {{ $firstItem }} - {{ $lastItem }} of {{ $totalUsers }} users
            @if(request()->has('search') || request()->has('status') || request()->has('role') || request()->has('profile_created'))
                (Filtered Results)
            @endif
        </div>

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Student ID</th>
                        <th>National ID</th>
                        <th>ID Documents</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Profile</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->student_id ?? 'N/A' }}</td>
                        <td>{{ $user->national_id ?? 'N/A' }}</td>
                        <td>
                            <div class="id-images">
                                @if($user->id_card_front)
                                    <img src="{{ $user->getIdCardFrontUrl() }}" alt="Front" class="id-image" 
                                         onclick="openModal('{{ $user->getIdCardFrontUrl() }}')">
                                @else
                                    <span class="text-muted">No front</span>
                                @endif
                                @if($user->id_card_back)
                                    <img src="{{ $user->getIdCardBackUrl() }}" alt="Back" class="id-image" 
                                         onclick="openModal('{{ $user->getIdCardBackUrl() }}')">
                                @else
                                    <span class="text-muted">No back</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge {{ $user->role === 'admin' ? 'badge-admin' : 'badge-user' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge 
                                {{ $user->status === 'approved' ? 'badge-success' : '' }}
                                {{ $user->status === 'pending' ? 'badge-warning' : '' }}
                                {{ $user->status === 'rejected' ? 'badge-danger' : '' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                            @if($user->status === 'rejected' && $user->rejection_reason)
                                <br><small title="{{ $user->rejection_reason }}" style="color: #dc3545; cursor: help;">ⓘ</small>
                            @endif
                        </td>
                        <td>
                            @if($user->population)
                                <span style="color: #28a745;">✓ Created</span>
                            @else
                                <span style="color: #dc3545;">✗ Not Created</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <div style="display: flex; flex-direction: column; gap: 5px;">
                                <!-- Approval/Rejection Buttons -->
                                @if($user->status === 'pending')
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Approve this user?')">✅ Approve</button>
                                    </form>
                                    <button type="button" class="btn btn-danger" onclick="showRejectionModal({{ $user->id }})">❌ Reject</button>
                                @elseif($user->status === 'approved')
                                    <span class="text-success">✓ Approved</span>
                                    @if($user->approved_by)
                                        <small>by {{ $user->approver->name ?? 'Admin' }}</small>
                                    @endif
                                    <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning" onclick="return confirm('Mark as pending?')">↩️ Revoke</button>
                                    </form>
                                @else
                                    <span class="text-danger">✗ Rejected</span>
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Approve this user?')">✅ Approve</button>
                                    </form>
                                @endif
                                
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit">✏️ Edit</a>
                                
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this user permanently?')">🗑️ Delete</button>
                                    </form>
                                @else
                                    <span style="color: #6c757d; font-size: 10px;">Current User</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" style="text-align: center; padding: 20px; color: #6c757d;">
                            No users found matching your criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination - FIXED -->
        @if(method_exists($users, 'links'))
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if($users->onFirstPage())
                <span class="disabled">&laquo; Previous</span>
            @else
                <a href="{{ $users->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">&laquo; Previous</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                @if($page == $users->currentPage())
                    <span class="current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">Next &raquo;</a>
            @else
                <span class="disabled">Next &raquo;</span>
            @endif
        </div>
        @endif

        <!-- Image Modal -->
        <div id="imageModal" class="modal">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="modalImage">
        </div>

        <!-- Rejection Modal -->
        <div id="rejectionModal" class="modal">
            <div style="background: white; margin: 10% auto; padding: 20px; border-radius: 10px; width: 500px;">
                <h3>Reject User Registration</h3>
                <form id="rejectionForm" method="POST">
                    @csrf
                    <div style="margin: 15px 0;">
                        <label style="display: block; margin-bottom: 5px; font-weight: bold;">Rejection Reason:</label>
                        <textarea name="rejection_reason" required style="width: 100%; height: 100px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" 
                                  placeholder="Please provide a reason for rejection..."></textarea>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn btn-danger">Reject User</button>
                        <button type="button" class="btn btn-secondary" onclick="closeRejectionModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Image modal functionality
        function openModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('imageModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        // Rejection modal functionality
        let currentUserId = null;

        function showRejectionModal(userId) {
            currentUserId = userId;
            document.getElementById('rejectionForm').action = `/admin/users/${userId}/reject`;
            document.getElementById('rejectionModal').style.display = 'block';
        }

        function closeRejectionModal() {
            document.getElementById('rejectionModal').style.display = 'none';
            currentUserId = null;
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const imageModal = document.getElementById('imageModal');
            const rejectionModal = document.getElementById('rejectionModal');
            
            if (event.target === imageModal) {
                closeModal();
            }
            if (event.target === rejectionModal) {
                closeRejectionModal();
            }
        }
    </script>
</body>
</html>