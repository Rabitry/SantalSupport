<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Populations - Admin</title>
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
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 12px; border: none; cursor: pointer; }
        .btn-view { background: #17a2b8; color: white; }
        .btn-edit { background: #ffc107; color: black; }
        .btn-delete { background: #dc3545; color: white; }
        
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
        
        /* Results Count */
        .results-count { 
            background: #e9ecef; 
            padding: 10px 15px; 
            border-radius: 5px; 
            margin-bottom: 15px;
            font-size: 14px;
            color: #495057;
        }
        
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <h1>👥 Manage Populations - Santal Community</h1>
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
            <form method="GET" action="{{ route('admin.populations.index') }}" style="display: contents;">
                <div class="search-box">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Search Populations:</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search by name, email, phone, occupation...">
                </div>
                
                <div class="filter-select">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Occupation:</label>
                    <select name="occupation">
                        <option value="">All Occupations</option>
                        @foreach($occupations as $occupation)
                            <option value="{{ $occupation }}" {{ request('occupation') == $occupation ? 'selected' : '' }}>
                                {{ $occupation }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-select">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">District:</label>
                    <select name="district">
                        <option value="">All Districts</option>
                        @foreach($districts as $district)
                            <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>
                                {{ $district }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="search-btn">🔍 Search</button>
                <a href="{{ route('admin.populations.index') }}" class="reset-btn">🔄 Reset</a>
            </form>
        </div>

        <!-- Results Count -->
        <div class="results-count">
            @php
                $totalPopulations = $populations->total() ?? $populations->count();
                $firstItem = method_exists($populations, 'firstItem') ? $populations->firstItem() : 1;
                $lastItem = method_exists($populations, 'lastItem') ? $populations->lastItem() : $populations->count();
            @endphp
            
            Showing {{ $firstItem }} - {{ $lastItem }} of {{ $totalPopulations }} populations
            @if(request()->has('search') || request()->has('occupation') || request()->has('district'))
                (Filtered Results)
            @endif
        </div>

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Occupation</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>District</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($populations as $population)
                    <tr>
                        <td>{{ $population->id }}</td>
                        <td>
                            @if($population->profile_picture)
                                <img src="{{ asset('storage/'.$population->profile_picture) }}" alt="Profile" class="profile-img">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($population->name) }}&background=007bff&color=fff&size=40" alt="Profile" class="profile-img">
                            @endif
                        </td>
                        <td>{{ $population->name }}</td>
                        <td>{{ $population->occupation }}</td>
                        <td>{{ $population->phone }}</td>
                        <td>{{ $population->email }}</td>
                        <td>{{ $population->district }}</td>
                        <td>
                            <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                <a href="{{ route('admin.populations.show', $population->id) }}" class="btn btn-view">👁️ View</a>
                                <a href="{{ route('admin.populations.edit', $population->id) }}" class="btn btn-edit">✏️ Edit</a>
                                <form action="{{ route('admin.populations.destroy', $population->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this population?')">🗑️ Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 20px; color: #6c757d;">
                            No populations found matching your criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($populations, 'links'))
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if($populations->onFirstPage())
                <span class="disabled">&laquo; Previous</span>
            @else
                <a href="{{ $populations->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">&laquo; Previous</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach($populations->getUrlRange(1, $populations->lastPage()) as $page => $url)
                @if($page == $populations->currentPage())
                    <span class="current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if($populations->hasMorePages())
                <a href="{{ $populations->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">Next &raquo;</a>
            @else
                <span class="disabled">Next &raquo;</span>
            @endif
        </div>
        @endif
    </div>

    <script>
        // Preserve search parameters in pagination links
        document.addEventListener('DOMContentLoaded', function() {
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