<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Population Profiles - Santal Community</title>
    <style>
        /* === GLOBAL STYLES === */
        body {
            margin: 0;
            font-family: "Poppins", Arial, sans-serif;
            background: linear-gradient(135deg, #f0f4ff, #e4f0eb);
            color: #333;
            min-height: 100vh;
        }
        h2 {
            text-align: center;
            color: #004080;
            margin: 30px 0 15px;
            font-size: 26px;
        }

        /* === NAVBAR === */
        nav {
            background: linear-gradient(90deg, #0066cc, #009688);
            color: white;
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }
        .nav-left h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .nav-center {
            display: flex;
            align-items: center;
        }
        .search-box {
            display: flex;
            margin-right: 20px;
        }
        .search-box input {
            padding: 8px 12px;
            border: none;
            border-radius: 4px 0 0 4px;
            font-size: 14px;
            width: 250px;
        }
        .search-box button {
            padding: 8px 15px;
            background: #ffd700;
            color: #333;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-weight: 600;
        }
        .nav-right a, .nav-right button {
            color: white;
            background: transparent;
            border: none;
            text-decoration: none;
            margin-left: 18px;
            font-weight: 500;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }
        .nav-right a:hover, .nav-right button:hover { color: #ffd700; }

        /* === SUCCESS/ERROR MESSAGES === */
        .alert {
            padding: 12px 20px;
            margin: 15px 20px;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-info {
            background: #cce7ff;
            color: #004085;
            border: 1px solid #b3d7ff;
        }

        /* === FILTER FORM === */
        .filter-container {
            background: white;
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            align-items: center;
        }
        .filter-group {
            display: flex;
            flex-direction: column;
        }
        .filter-group label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #555;
        }
        .filter-form select, .filter-form input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            background: white;
        }
        .filter-form button {
            padding: 8px 20px;
            background: #009688;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 20px;
        }
        .filter-form button:hover {
            background: #00796b;
        }

        /* === CARD GRID === */
        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 0 20px 40px;
        }
        .card {
            background: white;
            width: 250px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .card img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid #009688;
        }
        .card h3 { 
            margin: 8px 0; 
            font-size: 17px; 
            color: #004080; 
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card p { 
            font-size: 14px; 
            color: #555; 
            margin: 4px 0; 
            text-align: left;
        }
        .card-actions {
            margin-top: 15px;
            display: flex;
            gap: 8px;
            justify-content: center;
        }
        .btn-more {
            background: linear-gradient(90deg, #009688, #007bff);
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: background 0.3s, transform 0.2s;
            flex: 1;
        }
        .btn-more:hover {
            background: linear-gradient(90deg, #007bff, #009688);
            transform: scale(1.05);
        }
        .btn-contact {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: background 0.3s;
            flex: 1;
        }
        .btn-contact:hover {
            background: #218838;
        }

        /* === ENHANCED PAGINATION STYLES === */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px 0 10px;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pagination a, .pagination span {
            padding: 10px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            min-width: 44px;
            text-align: center;
            display: inline-block;
        }

        .pagination a:hover {
            background: linear-gradient(135deg, #007bff, #009688);
            color: white;
            border-color: #007bff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        .pagination .current {
            background: linear-gradient(135deg, #007bff, #009688);
            color: white;
            border-color: #007bff;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(0, 123, 255, 0.2);
        }

        .pagination .disabled {
            color: #6c757d;
            cursor: not-allowed;
            background: #f8f9fa;
            border-color: #dee2e6;
        }

        .pagination .dots {
            padding: 10px 8px;
            color: #6c757d;
            font-weight: 500;
        }

        /* Results Count */
        .results-count {
            text-align: center;
            margin: 10px 0 30px;
            color: #666;
            font-size: 14px;
            background: #f8f9fa;
            padding: 10px 20px;
            border-radius: 8px;
            display: inline-block;
            margin: 10px auto 30px;
        }

        /* === NO RECORDS MESSAGE === */
        .no-records {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        .no-records h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .no-records p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* === MODAL === */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
        }
        .modal-content {
            background: rgba(255, 255, 255, 0.98);
            margin: 5% auto;
            padding: 25px;
            width: 90%;
            max-width: 600px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.25);
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn { 
            from {opacity:0; transform:translateY(-20px);} 
            to {opacity:1; transform:translateY(0);} 
        }
        .modal-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 2px solid #009688; 
            padding-bottom: 15px; 
            margin-bottom: 20px; 
        }
        .modal-header h3 { 
            margin:0; 
            color:#004080; 
            font-size: 24px;
        }
        .close { 
            font-size:28px; 
            cursor:pointer; 
            color:#888; 
            transition:0.3s; 
        }
        .close:hover { color:#000; }
        .modal-body { 
            text-align:center; 
        }
        .modal-body img { 
            width:140px; 
            height:140px; 
            border-radius:50%; 
            object-fit:cover; 
            margin-bottom:20px; 
            border:4px solid #007bff; 
        }
        .modal-body p { 
            font-size:16px; 
            margin:8px 0; 
            text-align: left;
            padding: 0 20px;
        }
        .modal-body strong {
            color: #004080;
            min-width: 150px;
            display: inline-block;
        }

        /* === RESPONSIVE DESIGN === */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                gap: 10px;
                padding: 15px;
            }
            .nav-center {
                order: 3;
                width: 100%;
                justify-content: center;
            }
            .search-box input {
                width: 200px;
            }
            .card {
                width: 100%;
                max-width: 300px;
            }
            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }
            .filter-group {
                width: 100%;
            }
            .pagination {
                gap: 5px;
            }
            .pagination a, .pagination span {
                padding: 8px 12px;
                font-size: 13px;
                min-width: 40px;
            }
            .pagination .dots {
                padding: 8px 6px;
            }
        }

        @media (max-width: 480px) {
            .pagination {
                gap: 3px;
            }
            .pagination a, .pagination span {
                padding: 6px 10px;
                font-size: 12px;
                min-width: 36px;
            }
        }
    </style>
</head>
<body>

<nav>
    <div class="nav-left">
        <h2>🏠 Santal Community</h2>
    </div>
    
    <div class="nav-center">
        <!-- Search Box -->
        <form class="search-box" method="GET" action="{{ route('population.index') }}">
            <input type="text" name="search" placeholder="Search by name, phone, or district..." 
                   value="{{ request('search') }}">
            <button type="submit">🔍 Search</button>
        </form>
    </div>
    
    <div class="nav-right">
        @guest
            <a href="{{ route('login') }}">🔑 Login</a>
            <a href="{{ route('register') }}">📝 Register</a>
        @else
            @php
                $userProfile = \App\Models\Population::where('user_id', Auth::id())->first();
            @endphp
            @if(!$userProfile)
                <a href="{{ route('population.create') }}">➕ Create Profile</a>
            @else
                <a href="{{ route('population.edit', $userProfile->id) }}">✏️ Update Profile</a>
            @endif
            <span style="margin-left:15px; font-weight:500;">👤 {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">🚪 Logout</button>
            </form>
        @endguest
    </div>
</nav>

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
@endif
@if(session('info'))
    <div class="alert alert-info">{{ session('info') }}</div>
@endif

<h2>👥 All Population Records</h2>

<!-- Enhanced Filter Form -->
<div class="filter-container">
    <form class="filter-form" method="GET" action="{{ route('population.index') }}">
        <div class="filter-group">
            <label>🔍 Search:</label>
            <input type="text" name="search" placeholder="Name, phone, district..." value="{{ request('search') }}">
        </div>

        <div class="filter-group">
            <label>💼 Occupation:</label>
            <select name="occupation" onchange="this.form.submit()">
                <option value="all" {{ request('occupation') == 'all' ? 'selected' : '' }}>All Occupations</option>
                <option value="Student" {{ request('occupation') == 'Student' ? 'selected' : '' }}>Student</option>
                <option value="Jobholder" {{ request('occupation') == 'Jobholder' ? 'selected' : '' }}>Jobholder</option>
                <option value="Teacher" {{ request('occupation') == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="Business" {{ request('occupation') == 'Business' ? 'selected' : '' }}>Business</option>
                <option value="Other" {{ request('occupation') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="filter-group">
            <label>📍 District:</label>
            <select name="district" onchange="this.form.submit()">
                <option value="all" {{ request('district') == 'all' ? 'selected' : '' }}>All Districts</option>
                @foreach($districts as $dist)
                    <option value="{{ $dist }}" {{ request('district') == $dist ? 'selected' : '' }}>{{ $dist }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label>🩸 Blood Group:</label>
            <select name="blood_group" onchange="this.form.submit()">
                <option value="all" {{ request('blood_group') == 'all' ? 'selected' : '' }}>All Blood Groups</option>
                @foreach($bloodGroups as $bg)
                    <option value="{{ $bg }}" {{ request('blood_group') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Apply Filters</button>
        @if(request()->anyFilled(['search', 'occupation', 'district', 'blood_group']))
            <a href="{{ route('population.index') }}" style="margin-left: 10px; color: #dc3545; text-decoration: none;">
                Clear Filters
            </a>
        @endif
    </form>
</div>

<!-- Results Count -->
<div style="text-align: center; margin: 15px 0; color: #666; font-size: 14px;">
    @php
        $total = $populations->total();
        $from = $populations->firstItem();
        $to = $populations->lastItem();
    @endphp
    @if($total > 0)
        Showing {{ $from }} to {{ $to }} of {{ $total }} records
        @if(request()->anyFilled(['search', 'occupation', 'district', 'blood_group']))
            <br><small style="color: #009688; font-weight: 500;">(Filtered Results)</small>
        @endif
    @endif
</div>

<!-- Card Grid -->
<div class="grid">
    @forelse($populations as $p)
        <div class="card">
            @if($p->profile_picture)
                <img src="{{ asset('storage/'.$p->profile_picture) }}" alt="Profile of {{ $p->name }}">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($p->name) }}&background=009688&color=fff&size=110" alt="Profile">
            @endif
            <h3>{{ $p->name }}</h3>
            <p><strong>💼 Occupation:</strong> {{ $p->occupation }}</p>
            <p><strong>📍 District:</strong> {{ $p->district }}</p>
            <p><strong>📞 Phone:</strong> {{ $p->phone }}</p>
            @if($p->blood_group)
                <p><strong>🩸 Blood Group:</strong> {{ $p->blood_group }}</p>
            @endif
            
            <div class="card-actions">
                <button class="btn-more" data-info='@json($p)' onclick="showDetails(this)">View Details</button>
                <button class="btn-contact" onclick="contactPerson('{{ $p->phone }}', '{{ $p->name }}')">
                    Contact
                </button>
            </div>
        </div>
    @empty
        <div class="no-records">
            <h3>📭 No records found</h3>
            <p>No population records match your search criteria.</p>
            @if(Auth::check())
                <a href="{{ route('population.create') }}" style="color: #007bff; text-decoration: none; font-weight: 600;">
                    ➕ Create the first profile?
                </a>
            @else
                <p>Please <a href="{{ route('login') }}" style="color: #007bff;">login</a> to create a profile.</p>
            @endif
        </div>
    @endforelse
</div>

<!-- Enhanced Pagination -->
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

<!-- Enhanced Modal -->
<div id="detailsModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalName"></h3>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <img id="modalImage" src="" alt="Profile">
            <p><strong>👤 Sex:</strong> <span id="modalSex"></span></p>
            <p><strong>💼 Occupation:</strong> <span id="modalOccupation"></span></p>
            <p><strong>🎓 College/University:</strong> <span id="modalCollege"></span></p>
            <p><strong>📚 Subject/Department:</strong> <span id="modalSubject"></span></p>
            <p><strong>🩸 Blood Group:</strong> <span id="modalBlood"></span></p>
            <p><strong>📧 Email:</strong> <span id="modalEmail"></span></p>
            <p><strong>🏛️ Division:</strong> <span id="modalDivision"></span></p>
            <p><strong>📍 District:</strong> <span id="modalDistrict"></span></p>
            <p><strong>🏘️ Upazila:</strong> <span id="modalUpazila"></span></p>
            <p><strong>🏠 Current Address:</strong> <span id="modalCurrentAddress"></span></p>
            
            <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee;">
                <button onclick="closeModal()" style="background: #6c757d; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">
                    Close
                </button>
                <button id="modalContactBtn" style="background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                    📞 Contact
                </button>
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
        image.src = 'https://ui-avatars.com/api/?name=' + encodeURIComponent(currentPerson.name) + '&background=007bff&color=fff&size=140';
    }
    
    // Set up contact button
    document.getElementById('modalContactBtn').onclick = function() {
        contactPerson(currentPerson.phone, currentPerson.name);
    };
    
    document.getElementById('detailsModal').style.display = 'block';
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

// Auto-submit form when filters change
document.addEventListener('DOMContentLoaded', function() {
    const filterSelects = document.querySelectorAll('select[name="occupation"], select[name="district"], select[name="blood_group"]');
    
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            // Small delay to ensure the value is updated
            setTimeout(() => {
                this.form.submit();
            }, 100);
        });
    });
});
</script>
</body>
</html>