<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santal Community Directory - Population Registry</title>
    <style>
        /* === GLOBAL STYLES === */
        :root {
            --primary-color: #1a365d;
            --primary-dark: #0f2547;
            --secondary-color: #2d3748;
            --accent-color: #2b6cb0;
            --accent-dark: #1e4e8c;
            --light-color: #f7fafc;
            --border-color: #e2e8f0;
            --success-color: #2d8c4a;
            --error-color: #c53030;
            --info-color: #3182ce;
            --text-light: #718096;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', 'Roboto', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
        }
        
        h1, h2, h3, h4 {
            color: var(--primary-color);
            font-weight: 600;
            letter-spacing: -0.025em;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* === HEADER === */
        header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 16px 0;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo h1 {
            font-size: 24px;
            color: white;
            margin: 0;
            font-weight: 600;
        }
        
        .logo-icon {
            margin-right: 12px;
            font-size: 26px;
        }
        
        .dashboard-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            padding: 10px 18px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.1);
            font-size: 14px;
        }
        
        .dashboard-link:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-1px);
        }
        
        /* === NAVIGATION === */
        nav {
            background: white;
            border-bottom: 1px solid var(--border-color);
            padding: 14px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .search-form {
            display: flex;
            width: 100%;
            max-width: 450px;
        }
        
        .search-form input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-right: none;
            border-radius: 6px 0 0 6px;
            font-size: 14px;
            transition: all 0.2s;
        }
        
        .search-form input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(43, 108, 176, 0.1);
        }
        
        .search-form button {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 0 6px 6px 0;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.2s;
        }
        
        .search-form button:hover {
            background: var(--accent-dark);
        }
        
        .user-actions {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        
        .user-actions a, .logout-btn {
            color: var(--secondary-color);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.2s;
            padding: 8px 12px;
            border-radius: 4px;
        }
        
        .user-actions a:hover, .logout-btn:hover {
            color: var(--accent-color);
            background: rgba(43, 108, 176, 0.05);
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            background: rgba(43, 108, 176, 0.08);
            border-radius: 6px;
            border-left: 3px solid var(--accent-color);
        }
        
        .user-name {
            font-weight: 500;
            color: var(--secondary-color);
        }
        
        /* === MAIN CONTENT === */
        main {
            padding: 32px 0;
        }
        
        /* === FILTER SECTION === */
        .filter-section {
            background: white;
            border-radius: 10px;
            padding: 28px;
            margin-bottom: 28px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .section-title {
            font-size: 22px;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 22px;
            align-items: end;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--secondary-color);
        }
        
        .form-group select, .form-group input {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 14px;
            background: white;
            transition: all 0.2s;
        }
        
        .form-group select:focus, .form-group input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(43, 108, 176, 0.1);
        }
        
        .filter-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: flex-end;
            margin-top: 10px;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-primary {
            background: var(--accent-color);
            color: white;
        }
        
        .btn-secondary {
            background: #e2e8f0;
            color: var(--secondary-color);
        }
        
        .btn-primary:hover {
            background: var(--accent-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(43, 108, 176, 0.2);
        }
        
        .btn-secondary:hover {
            background: #cbd5e0;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
        }
        
        /* === CARD GRID === */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 28px;
            margin-bottom: 40px;
        }
        
        .profile-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .card-header h3 {
            color: white;
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }
        
        .card-body {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            display: block;
            border: 3px solid var(--border-color);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .profile-details {
            margin-bottom: 20px;
            flex-grow: 1;
        }
        
        .detail-item {
            display: flex;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .detail-label {
            font-weight: 600;
            min-width: 120px;
            color: var(--secondary-color);
        }
        
        .card-actions {
            display: flex;
            gap: 12px;
            margin-top: auto;
        }
        
        .card-actions .btn {
            flex: 1;
            padding: 10px 16px;
            font-size: 13px;
        }
        
        /* === NO RECORDS MESSAGE === */
        .no-records {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
            grid-column: 1 / -1;
        }
        
        .no-records h3 {
            margin-bottom: 15px;
            color: var(--secondary-color);
            font-size: 22px;
        }
        
        .no-records p {
            margin-bottom: 25px;
            color: var(--text-light);
            font-size: 16px;
        }
        
        /* === PAGINATION === */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 40px;
            gap: 8px;
        }
        
        .pagination a, .pagination span {
            padding: 10px 16px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            text-decoration: none;
            color: var(--accent-color);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .pagination a:hover {
            background: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .pagination .current {
            background: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
            font-weight: 600;
        }
        
        .pagination .disabled {
            color: #a0aec0;
            cursor: not-allowed;
            background: #f7fafc;
        }
        
        .pagination .dots {
            border: none;
            color: #a0aec0;
            padding: 10px 8px;
        }
        
        /* === MODAL === */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .modal-content {
            background: white;
            border-radius: 10px;
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 22px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 10px 10px 0 0;
        }
        
        .modal-header h3 {
            color: white;
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }
        
        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
            border-radius: 4px;
        }
        
        .close-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .modal-body {
            padding: 28px;
        }
        
        .modal-profile-image {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 25px;
            display: block;
            border: 4px solid var(--border-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .modal-details {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .modal-detail {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }
        
        .modal-detail:last-child {
            border-bottom: none;
        }
        
        .modal-label {
            font-weight: 600;
            min-width: 180px;
            color: var(--secondary-color);
        }
        
        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 25px;
            justify-content: flex-end;
        }
        
        /* === ALERTS === */
        .alert {
            padding: 16px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            font-weight: 500;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            border-left: 4px solid;
        }
        
        .alert-success {
            background: #f0fff4;
            color: var(--success-color);
            border-left-color: var(--success-color);
        }
        
        .alert-error {
            background: #fed7d7;
            color: var(--error-color);
            border-left-color: var(--error-color);
        }
        
        .alert-info {
            background: #bee3f8;
            color: var(--info-color);
            border-left-color: var(--info-color);
        }
        
        /* === RESPONSIVE DESIGN === */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-container {
                flex-direction: column;
                gap: 15px;
            }
            
            .search-form {
                max-width: 100%;
            }
            
            .filter-form {
                grid-template-columns: 1fr;
            }
            
            .cards-grid {
                grid-template-columns: 1fr;
            }
            
            .modal-content {
                width: 95%;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .filter-actions {
                justify-content: flex-start;
                width: 100%;
            }
            
            .modal-detail {
                flex-direction: column;
                gap: 5px;
            }
            
            .modal-label {
                min-width: auto;
            }
            
            .user-info {
                flex-direction: column;
                gap: 5px;
                align-items: flex-start;
                border-left: none;
                border-top: 3px solid var(--accent-color);
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <div class="logo-icon">🏛️</div>
                    <h1>Santal Community Directory</h1>
                </div>
                <a href="{{ url('/dashboard') }}" class="dashboard-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 8H1M1 8L8 15M1 8L8 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Go Back to Main Dashboard
                </a>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav>
        <div class="container nav-container">
            <form class="search-form" method="GET" action="{{ route('population.index') }}">
                <input type="text" name="search_college" placeholder="Search by college/university name..." value="{{ request('search_college') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            
            <div class="user-actions">
                @guest
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @else
                    @php
                        $userProfile = \App\Models\Population::where('user_id', Auth::id())->first();
                    @endphp
                    @if(!$userProfile)
                        <a href="{{ route('population.create') }}">Create Profile</a>
                    @else
                        <a href="{{ route('population.edit', $userProfile->id) }}">Update Profile</a>
                    @endif
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container">
        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        <!-- Filter Section -->
        <section class="filter-section">
            <div class="section-header">
                <h3 class="section-title">Filter Community Members</h3>
            </div>
            <form class="filter-form" method="GET" action="{{ route('population.index') }}">
                <div class="form-group">
                    <label for="search">Search by Name, Phone, or District</label>
                    <input type="text" id="search" name="search" placeholder="Enter name, phone, or district..." value="{{ request('search') }}">
                </div>

                <div class="form-group">
                    <label for="occupation">Occupation</label>
                    <select id="occupation" name="occupation">
                        <option value="all" {{ request('occupation') == 'all' ? 'selected' : '' }}>All Occupations</option>
                        <option value="Student" {{ request('occupation') == 'Student' ? 'selected' : '' }}>Student</option>
                        <option value="Jobholder" {{ request('occupation') == 'Jobholder' ? 'selected' : '' }}>Jobholder</option>
                        <option value="Teacher" {{ request('occupation') == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="Business" {{ request('occupation') == 'Business' ? 'selected' : '' }}>Business</option>
                        <option value="Other" {{ request('occupation') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="district">District</label>
                    <select id="district" name="district">
                        <option value="all" {{ request('district') == 'all' ? 'selected' : '' }}>All Districts</option>
                        @foreach($districts as $dist)
                            <option value="{{ $dist }}" {{ request('district') == $dist ? 'selected' : '' }}>{{ $dist }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="blood_group">Blood Group</label>
                    <select id="blood_group" name="blood_group">
                        <option value="all" {{ request('blood_group') == 'all' ? 'selected' : '' }}>All Blood Groups</option>
                        @foreach($bloodGroups as $bg)
                            <option value="{{ $bg }}" {{ request('blood_group') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" style="margin-right: 5px;">
                            <path d="M15.7 13.3l-3.81-3.83A5.93 5.93 0 0 0 13 6c0-3.31-2.69-6-6-6S1 2.69 1 6s2.69 6 6 6c1.3 0 2.48-.41 3.47-1.11l3.83 3.81c.19.2.45.3.7.3.25 0 .52-.09.7-.3a.996.996 0 0 0 0-1.4zM7 10.7c-2.59 0-4.7-2.11-4.7-4.7 0-2.59 2.11-4.7 4.7-4.7 2.59 0 4.7 2.11 4.7 4.7 0 2.59-2.11 4.7-4.7 4.7z"/>
                        </svg>
                        Apply Filters
                    </button>
                    @if(request()->anyFilled(['search', 'occupation', 'district', 'blood_group', 'search_college']))
                        <a href="{{ route('population.index') }}" class="btn btn-secondary">Clear Filters</a>
                    @endif
                </div>
            </form>
        </section>

        <!-- Cards Grid -->
        <div class="cards-grid">
            @forelse($populations as $p)
                <div class="profile-card">
                    <div class="card-header">
                        <h3>{{ $p->name }}</h3>
                    </div>
                    <div class="card-body">
                        @if($p->profile_picture)
                            <img src="{{ asset('storage/'.$p->profile_picture) }}" alt="Profile of {{ $p->name }}" class="profile-image">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($p->name) }}&background=2d3748&color=fff&size=100" alt="Profile" class="profile-image">
                        @endif
                        
                        <div class="profile-details">
                            <div class="detail-item">
                                <span class="detail-label">Occupation:</span>
                                <span>{{ $p->occupation }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">District:</span>
                                <span>{{ $p->district }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Phone:</span>
                                <span>{{ $p->phone }}</span>
                            </div>
                            @if($p->college_university)
                                <div class="detail-item">
                                    <span class="detail-label">College/University:</span>
                                    <span>{{ $p->college_university }}</span>
                                </div>
                            @endif
                            @if($p->blood_group)
                                <div class="detail-item">
                                    <span class="detail-label">Blood Group:</span>
                                    <span>{{ $p->blood_group }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-actions">
                            <button class="btn btn-primary" data-info='@json($p)' onclick="showDetails(this)">
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor" style="margin-right: 5px;">
                                    <path d="M8 0C3.58 0 0 3.58 0 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zM7 12.5c0 .83-.67 1.5-1.5 1.5S4 13.33 4 12.5 4.67 11 5.5 11 7 11.67 7 12.5zM8 4c-.28 0-.5.22-.5.5v5c0 .28.22.5.5.5s.5-.22.5-.5v-5C8.5 4.22 8.28 4 8 4z"/>
                                </svg>
                                View Details
                            </button>
                            <button class="btn btn-secondary" onclick="contactPerson('{{ $p->phone }}', '{{ $p->name }}')">
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor" style="margin-right: 5px;">
                                    <path d="M3.654 1.328a.5.5 0 0 0-.654.654l1.5 4.5a.5.5 0 0 0 .654.354l4.5-1.5a.5.5 0 0 0 .354-.654L8.328.654a.5.5 0 0 0-.654-.354l-4.5 1.5a.5.5 0 0 0-.354.654l1.5 4.5z"/>
                                </svg>
                                Contact
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-records">
                    <h3>No Records Found</h3>
                    <p>No community members match your search criteria.</p>
                    @if(Auth::check())
                        <a href="{{ route('population.create') }}" class="btn btn-primary">Create First Profile</a>
                    @else
                        <p>Please <a href="{{ route('login') }}">login</a> to create a profile.</p>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($populations->hasPages())
            <div class="pagination">
                {{-- Previous Page Link --}}
                @if($populations->onFirstPage())
                    <span class="disabled">&laquo; Previous</span>
                @else
                    <a href="{{ $populations->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">&laquo; Previous</a>
                @endif

                {{-- Pagination Elements --}}
                @php
                    $current = $populations->currentPage();
                    $last = $populations->lastPage();
                    $start = max($current - 2, 1);
                    $end = min($current + 2, $last);
                @endphp

                {{-- First Page --}}
                @if($start > 1)
                    <a href="{{ $populations->url(1) }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">1</a>
                    @if($start > 2)
                        <span class="dots">...</span>
                    @endif
                @endif

                {{-- Page Numbers --}}
                @for($i = $start; $i <= $end; $i++)
                    @if($i == $current)
                        <span class="current">{{ $i }}</span>
                    @else
                        <a href="{{ $populations->url($i) }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">{{ $i }}</a>
                    @endif
                @endfor

                {{-- Last Page --}}
                @if($end < $last)
                    @if($end < $last - 1)
                        <span class="dots">...</span>
                    @endif
                    <a href="{{ $populations->url($last) }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">{{ $last }}</a>
                @endif

                {{-- Next Page Link --}}
                @if($populations->hasMorePages())
                    <a href="{{ $populations->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">Next &raquo;</a>
                @else
                    <span class="disabled">Next &raquo;</span>
                @endif
            </div>
        @endif
    </main>

    <!-- Modal -->
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalName"></h3>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Profile" class="modal-profile-image">
                
                <div class="modal-details">
                    <div class="modal-detail">
                        <span class="modal-label">Gender:</span>
                        <span id="modalSex"></span>
                    </div>
                    <div class="modal-detail">
                        <span class="modal-label">Occupation:</span>
                        <span id="modalOccupation"></span>
                    </div>
                    <div class="modal-detail">
                        <span class="modal-label">College/University:</span>
                        <span id="modalCollege"></span>
                    </div>
                    <div class="modal-detail">
                        <span class="modal-label">Subject/Department:</span>
                        <span id="modalSubject"></span>
                    </div>
                    <div class="modal-detail">
                        <span class="modal-label">Blood Group:</span>
                        <span id="modalBlood"></span>
                    </div>
                    <div class="modal-detail">
                        <span class="modal-label">Email:</span>
                        <span id="modalEmail"></span>
                    </div>
                    <div class="modal-detail">
                        <span class="modal-label">Division:</span>
                        <span id="modalDivision"></span>
                    </div>
                    <div class="modal-detail">
                        <span class="modal-label">District:</span>
                        <span id="modalDistrict"></span>
                    </div>
                    <div class="modal-detail">
                        <span class="modal-label">Upazila:</span>
                        <span id="modalUpazila"></span>
                    </div>
                    <div class="modal-detail">
                        <span class="modal-label">Current Address:</span>
                        <span id="modalCurrentAddress"></span>
                    </div>
                </div>
                
                <div class="modal-actions">
                    <button class="btn btn-secondary" onclick="closeModal()">Close</button>
                    <button id="modalContactBtn" class="btn btn-primary">Contact</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentPerson = null;

        function showDetails(button) {
            currentPerson = JSON.parse(button.getAttribute('data-info'));
            
            document.getElementById('modalName').innerText = currentPerson.name || 'N/A';
            document.getElementById('modalSex').innerText = currentPerson.sex || 'N/A';
            document.getElementById('modalOccupation').innerText = currentPerson.occupation || 'N/A';
            document.getElementById('modalCollege').innerText = currentPerson.college_university || 'N/A';
            document.getElementById('modalSubject').innerText = currentPerson.subject_department || 'N/A';
            document.getElementById('modalBlood').innerText = currentPerson.blood_group || 'N/A';
            document.getElementById('modalEmail').innerText = currentPerson.email || 'N/A';
            document.getElementById('modalDivision').innerText = currentPerson.division || 'N/A';
            document.getElementById('modalDistrict').innerText = currentPerson.district || 'N/A';
            document.getElementById('modalUpazila').innerText = currentPerson.upazila || 'N/A';
            document.getElementById('modalCurrentAddress').innerText = currentPerson.current_address || 'N/A';
            
            const image = document.getElementById('modalImage');
            if (currentPerson.profile_picture) {
                image.src = '/storage/' + currentPerson.profile_picture;
            } else {
                image.src = 'https://ui-avatars.com/api/?name=' + encodeURIComponent(currentPerson.name) + '&background=2d3748&color=fff&size=140';
            }
            
            // Set up contact button
            document.getElementById('modalContactBtn').onclick = function() {
                contactPerson(currentPerson.phone, currentPerson.name);
            };
            
            document.getElementById('detailsModal').style.display = 'flex';
        }

        function closeModal() { 
            document.getElementById('detailsModal').style.display = 'none';
            currentPerson = null;
        }

        function contactPerson(phone, name) {
            if (confirm(`Do you want to contact ${name} at ${phone}?`)) {
                window.open(`tel:${phone}`, '_self');
            }
        }

        // Close modal when clicking outside
        window.onclick = function(e) {
            const modal = document.getElementById('detailsModal');
            if(e.target === modal) modal.style.display = 'none';
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if(e.key === 'Escape') {
                closeModal();
            }
        });

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