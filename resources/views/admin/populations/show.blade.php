<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Population - Admin</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8f9fa; margin: 0; }
        .admin-header { background: linear-gradient(135deg, #dc3545, #c82333); color: white; padding: 15px 30px; }
        .admin-nav { background: #343a40; padding: 10px 30px; }
        .admin-nav a { color: white; text-decoration: none; margin-right: 20px; padding: 8px 15px; border-radius: 5px; }
        .admin-nav a:hover { background: #495057; }
        .container { max-width: 800px; margin: 20px auto; padding: 20px; }
        .profile-card { background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); overflow: hidden; }
        .profile-header { background: linear-gradient(135deg, #007bff, #0056b3); color: white; padding: 30px; text-align: center; }
        .profile-image { width: 120px; height: 120px; border-radius: 50%; border: 4px solid white; margin: 0 auto 15px; object-fit: cover; }
        .profile-name { font-size: 24px; font-weight: bold; margin-bottom: 5px; }
        .profile-body { padding: 25px; }
        .info-section { margin-bottom: 25px; }
        .info-section h3 { color: #007bff; border-bottom: 2px solid #e9ecef; padding-bottom: 8px; margin-bottom: 15px; }
        .info-item { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f8f9fa; }
        .info-label { font-weight: 600; color: #495057; }
        .info-value { color: #212529; }
        .action-buttons { display: flex; gap: 10px; margin-top: 25px; }
        .btn { padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: 600; }
        .btn-back { background: #6c757d; color: white; }
        .btn-edit { background: #ffc107; color: black; }
        .btn-delete { background: #dc3545; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="admin-header">
        <h1>👤 View Population Profile</h1>
        <div>
            <a href="{{ route('admin.populations.index') }}" style="color: white;">← Back to Populations</a>
        </div>
    </div>

    <div class="admin-nav">
        <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
        <a href="{{ route('admin.populations.index') }}">👥 Populations</a>
        <a href="{{ route('admin.users.index') }}">👤 Users</a>
        <a href="{{ route('admin.users.pending') }}">⏳ Pending</a>
        <a href="{{ route('admin.statistics') }}">📈 Statistics</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: white; cursor: pointer;">🚪 Logout</button>
        </form>
    </div>

    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                @if($population->profile_picture)
                    <img src="{{ asset('storage/'.$population->profile_picture) }}" alt="Profile" class="profile-image">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($population->name) }}&background=ffffff&color=007bff&size=120" alt="Profile" class="profile-image">
                @endif
                <div class="profile-name">{{ $population->name }}</div>
                <div>{{ $population->occupation }}</div>
            </div>

            <div class="profile-body">
                <!-- Personal Information -->
                <div class="info-section">
                    <h3>👤 Personal Information</h3>
                    <div class="info-item">
                        <span class="info-label">Name:</span>
                        <span class="info-value">{{ $population->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Gender:</span>
                        <span class="info-value">{{ $population->sex }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Occupation:</span>
                        <span class="info-value">{{ $population->occupation }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Blood Group:</span>
                        <span class="info-value">
                            @if($population->blood_group)
                                <strong style="color: #dc3545;">{{ $population->blood_group }}</strong>
                            @else
                                Not specified
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Education Information -->
                <div class="info-section">
                    <h3>🎓 Education</h3>
                    <div class="info-item">
                        <span class="info-label">College/University:</span>
                        <span class="info-value">{{ $population->college_university ?? 'Not specified' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Subject/Department:</span>
                        <span class="info-value">{{ $population->subject_department ?? 'Not specified' }}</span>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="info-section">
                    <h3>📞 Contact</h3>
                    <div class="info-item">
                        <span class="info-label">Phone:</span>
                        <span class="info-value">{{ $population->phone }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $population->email }}</span>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="info-section">
                    <h3>📍 Location</h3>
                    <div class="info-item">
                        <span class="info-label">Division:</span>
                        <span class="info-value">{{ $population->division }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">District:</span>
                        <span class="info-value">{{ $population->district }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Upazila:</span>
                        <span class="info-value">{{ $population->upazila }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Address:</span>
                        <span class="info-value">{{ $population->current_address }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('admin.populations.index') }}" class="btn btn-back">← Back</a>
                    <a href="{{ route('admin.populations.edit', $population->id) }}" class="btn btn-edit">✏️ Edit</a>
                    <form action="{{ route('admin.populations.destroy', $population->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this profile?')">🗑️ Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>