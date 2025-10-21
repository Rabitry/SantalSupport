<!DOCTYPE html>
<html>
<head>
    <title>Population List</title>
    <style>
        /* Navbar */
        nav {
            background: #333;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        nav a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            color: #00bfff;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Filter Form */
        .filter-form {
            text-align: center;
            margin-bottom: 30px;
        }
        .filter-form select, .filter-form button {
            padding: 5px 10px;
            margin: 0 5px;
            font-size: 14px;
        }

        /* Card Grid */
        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background: white;
            width: 220px;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.2s;
        }

        .card:hover { transform: translateY(-5px); }

        .card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .circular { border-radius: 50%; }
        .rectangular { border-radius: 10%; }

        .card h3 { margin: 5px 0; font-size: 16px; }
        .card p { margin: 2px 0; font-size: 14px; color: #555; }

        /* Buttons */
        .btn {
            display: inline-block;
            margin: 5px 3px;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 13px;
            font-weight: bold;
        }
        .btn-edit { background: #007bff; }
        .btn-delete { background: #dc3545; }
        .btn-more { background: #28a745; }

        .btn:hover { opacity: 0.8; }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.6);
        }
        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 20px;
            width: 90%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-header h3 { margin: 0; }
        .close {
            color: #aaa;
            font-size: 24px;
            cursor: pointer;
        }
        .close:hover { color: black; }
        .modal-body { text-align: center; }
        .modal-body img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }
        .modal-body p { font-size: 15px; margin: 5px 0; }

        @media (max-width: 900px) { .card { width: 45%; } }
        @media (max-width: 600px) { .card { width: 90%; } }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @else
            @php
                $userProfile = \App\Models\Population::where('user_login_id', Auth::id())->first();
            @endphp

            @if(!$userProfile)
                <a href="{{ route('population.create') }}">Create Profile</a>
            @else
                <a href="{{ route('population.edit', $userProfile->id) }}">Update Profile</a>
            @endif

            <span style="margin-left:15px; color:#00bfff;">{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background:none; border:none; color:white; margin-left:10px; cursor:pointer;">Logout</button>
            </form>
        @endguest
    </nav>

    <h2>All Population Records</h2>

    <!-- Filter Form -->
    <form class="filter-form" method="GET" action="{{ route('population.index') }}">
        <label>Occupation:</label>
        <select name="occupation" onchange="this.form.submit()">
            <option value="all">All</option>
            @foreach($occupations as $occ)
                <option value="{{ $occ }}" {{ request('occupation') == $occ ? 'selected' : '' }}>{{ $occ }}</option>
            @endforeach
        </select>

        <label>District:</label>
        <select name="district" onchange="this.form.submit()">
            <option value="all">All</option>
            @foreach($districts as $dist)
                <option value="{{ $dist }}" {{ request('district') == $dist ? 'selected' : '' }}>{{ $dist }}</option>
            @endforeach
        </select>
    </form>

    <!-- Card Grid -->
    <div class="grid" id="populationGrid">
        @forelse($populations as $p)
            <div class="card">
                @php
                    $shape = strtolower($p->occupation) == 'student' ? 'circular' : 'rectangular';
                @endphp
                @if($p->profile_picture)
                    <img src="{{ asset('storage/'.$p->profile_picture) }}" class="{{ $shape }}">
                @else
                    <img src="https://via.placeholder.com/100" class="{{ $shape }}">
                @endif
                <h3>{{ $p->name }}</h3>
                <p><strong>Occupation:</strong> {{ $p->occupation }}</p>
                <p><strong>District:</strong> {{ $p->district }}</p>
                <p><strong>Phone:</strong> {{ $p->phone }}</p>

                <!-- Action Buttons -->
                <a href="{{ route('population.edit', $p->id) }}" class="btn btn-edit">Edit</a>
                <form action="{{ route('population.destroy', $p->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this profile?')">Delete</button>
                </form>
                <button class="btn btn-more" data-info='@json($p)' onclick="showDetails(this)">More Details</button>
            </div>
        @empty
            <p>No records found.</p>
        @endforelse
    </div>

    <!-- Modal -->
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalName"></h3>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="https://via.placeholder.com/120" alt="Profile">
                <p><strong>Sex:</strong> <span id="modalSex"></span></p>
                <p><strong>Occupation:</strong> <span id="modalOccupation"></span></p>
                <p><strong>College/University:</strong> <span id="modalCollege"></span></p>
                <p><strong>Subject/Department:</strong> <span id="modalSubject"></span></p>
                <p><strong>Blood Group:</strong> <span id="modalBlood"></span></p>
                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                <p><strong>District:</strong> <span id="modalDistrict"></span></p>
                <p><strong>Upazila:</strong> <span id="modalUpazila"></span></p>
            </div>
        </div>
    </div>

    <!-- Modal Script -->
    <script>
        function showDetails(button) {
            const p = JSON.parse(button.getAttribute('data-info'));
            document.getElementById('modalName').innerText = p.name || 'N/A';
            document.getElementById('modalSex').innerText = p.sex || 'N/A';
            document.getElementById('modalOccupation').innerText = p.occupation || 'N/A';
            document.getElementById('modalCollege').innerText = p.college_university || 'N/A';
            document.getElementById('modalSubject').innerText = p.subject_department || 'N/A';
            document.getElementById('modalBlood').innerText = p.blood_group || 'N/A';
            document.getElementById('modalEmail').innerText = p.email || 'N/A';
            document.getElementById('modalDistrict').innerText = p.district || 'N/A';
            document.getElementById('modalUpazila').innerText = p.upazila || 'N/A';

            const image = document.getElementById('modalImage');
            image.src = p.profile_picture ? '/storage/' + p.profile_picture : 'https://via.placeholder.com/120';
            document.getElementById('detailsModal').style.display = 'block';
        }
        function closeModal() { document.getElementById('detailsModal').style.display = 'none'; }
        window.onclick = function(e) {
            const modal = document.getElementById('detailsModal');
            if (e.target === modal) modal.style.display = 'none';
        }
    </script>
</body>
</html>
