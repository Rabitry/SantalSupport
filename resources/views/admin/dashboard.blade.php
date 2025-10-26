<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Santal Community</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .admin-header {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-nav {
            background: #343a40;
            padding: 10px 30px;
        }
        .admin-nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .admin-nav a:hover {
            background: #495057;
        }
        .container {
            max-width: 1400px;
            margin: 20px auto;
            padding: 20px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .stat-card h3 {
            margin: 0;
            color: #333;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 600;
        }
        .stat-number {
            font-size: 42px;
            font-weight: bold;
            margin: 15px 0;
            font-family: 'Arial', sans-serif;
        }
        .stat-users { color: #007bff; }
        .stat-populations { color: #28a745; }
        .stat-pending { color: #ffc107; }
        .stat-approved { color: #20c997; }
        .stat-rejected { color: #dc3545; }
        .stat-admins { color: #6f42c1; }
        .stat-students { color: #e83e8c; }
        
        .quick-actions {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .quick-actions h2 {
            margin-top: 0;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        .action-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px 15px;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            text-decoration: none;
            color: white;
        }
        .action-icon {
            font-size: 32px;
            margin-bottom: 10px;
            display: block;
        }
        .action-text {
            font-weight: 600;
            font-size: 14px;
        }
        
        .pending-alert {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 1px solid #ffc107;
            color: #856404;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .pending-alert-icon {
            font-size: 24px;
        }
        .pending-alert-content {
            flex: 1;
        }
        .pending-alert h3 {
            margin: 0 0 5px 0;
            font-size: 18px;
        }
        .pending-alert p {
            margin: 0;
            font-size: 14px;
        }
        
        .recent-activity {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .recent-activity h2 {
            margin-top: 0;
            color: #333;
            border-bottom: 2px solid #28a745;
            padding-bottom: 10px;
        }
        .activity-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .activity-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .activity-item:last-child {
            border-bottom: none;
        }
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        .activity-content {
            flex: 1;
        }
        .activity-title {
            font-weight: 600;
            margin-bottom: 3px;
        }
        .activity-time {
            font-size: 12px;
            color: #6c757d;
        }
        
        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
            .admin-nav {
                text-align: center;
            }
            .admin-nav a {
                margin: 5px;
                display: inline-block;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .action-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <h1>🏠 Santal Community - Admin Dashboard</h1>
        <div>
            <span>Welcome, {{ Auth::user()->name }}</span>
            <a href="{{ route('population.index') }}" style="color: white; margin-left: 15px;">← Back to Site</a>
        </div>
    </div>

    <div class="admin-nav">
        <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
        <a href="{{ route('admin.populations.index') }}">👥 Manage Populations</a>
        <a href="{{ route('admin.users.index') }}">👤 Manage Users</a>
        <a href="{{ route('admin.users.pending') }}">⏳ Pending Users ({{ $pendingUsers }})</a>
        <a href="{{ route('admin.statistics') }}">📈 Statistics</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: white; cursor: pointer;">🚪 Logout</button>
        </form>
    </div>

    <div class="container">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                ❌ {{ session('error') }}
            </div>
        @endif

        <!-- Pending Users Alert -->
        @if($pendingUsers > 0)
        <div class="pending-alert">
            <div class="pending-alert-icon">⏳</div>
            <div class="pending-alert-content">
                <h3>Pending User Approvals</h3>
                <p>You have <strong>{{ $pendingUsers }}</strong> user(s) waiting for approval. Please review their ID documents and approve or reject their registration.</p>
            </div>
            <a href="{{ route('admin.users.pending') }}" style="background: #ffc107; color: #212529; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: 600; white-space: nowrap;">
                Review Now
            </a>
        </div>
        @endif

        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Users</h3>
                <div class="stat-number stat-users">{{ $totalUsers }}</div>
                <p>Registered Users</p>
            </div>
            <div class="stat-card">
                <h3>Total Profiles</h3>
                <div class="stat-number stat-populations">{{ $totalPopulations }}</div>
                <p>Population Profiles</p>
            </div>
            <div class="stat-card">
                <h3>Pending Approval</h3>
                <div class="stat-number stat-pending">{{ $pendingUsers }}</div>
                <p>Users Waiting</p>
            </div>
            <div class="stat-card">
                <h3>Approved Users</h3>
                <div class="stat-number stat-approved">{{ $approvedUsers }}</div>
                <p>Active Users</p>
            </div>
            <div class="stat-card">
                <h3>Rejected Users</h3>
                <div class="stat-number stat-rejected">{{ $rejectedUsers }}</div>
                <p>Rejected Registrations</p>
            </div>
            <div class="stat-card">
                <h3>Admin Users</h3>
                <div class="stat-number stat-admins">{{ $totalAdmins }}</div>
                <p>Administrators</p>
            </div>
            <div class="stat-card">
                <h3>Student Profiles</h3>
                <div class="stat-number stat-students">{{ $totalStudents }}</div>
                <p>Student Members</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2>🚀 Quick Actions</h2>
            <div class="action-grid">
                <a href="{{ route('admin.users.pending') }}" class="action-card" style="background: linear-gradient(135deg, #ffc107, #ffb300);">
                    <span class="action-icon">⏳</span>
                    <div class="action-text">Review Pending Users</div>
                    <small>{{ $pendingUsers }} waiting</small>
                </a>
                <a href="{{ route('admin.populations.index') }}" class="action-card" style="background: linear-gradient(135deg, #007bff, #0056b3);">
                    <span class="action-icon">👥</span>
                    <div class="action-text">Manage All Profiles</div>
                    <small>{{ $totalPopulations }} profiles</small>
                </a>
                <a href="{{ route('admin.users.index') }}" class="action-card" style="background: linear-gradient(135deg, #28a745, #20c997);">
                    <span class="action-icon">👤</span>
                    <div class="action-text">Manage Users</div>
                    <small>{{ $totalUsers }} users</small>
                </a>
                <a href="{{ route('admin.statistics') }}" class="action-card" style="background: linear-gradient(135deg, #6f42c1, #e83e8c);">
                    <span class="action-icon">📈</span>
                    <div class="action-text">View Statistics</div>
                    <small>Analytics & Reports</small>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="recent-activity">
            <h2>📋 Recent Activity</h2>
            <ul class="activity-list">
                @php
                    $recentUsers = \App\Models\User::with('approver')->latest()->take(5)->get();
                    $recentPopulations = \App\Models\Population::latest()->take(3)->get();
                @endphp
                
                @foreach($recentUsers as $user)
                <li class="activity-item">
                    <div class="activity-icon" style="background: {{ $user->status === 'approved' ? '#d4edda' : ($user->status === 'pending' ? '#fff3cd' : '#f8d7da') }};">
                        @if($user->status === 'approved') ✅
                        @elseif($user->status === 'pending') ⏳
                        @else ❌
                        @endif
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">
                            {{ $user->name }} 
                            <span style="font-weight: normal; color: #6c757d;">({{ $user->email }})</span>
                        </div>
                        <div class="activity-time">
                            Registered {{ $user->created_at->diffForHumans() }}
                            @if($user->status === 'approved' && $user->approver)
                                • Approved by {{ $user->approver->name }}
                            @elseif($user->status === 'rejected')
                                • Rejected
                            @else
                                • Waiting approval
                            @endif
                        </div>
                    </div>
                </li>
                @endforeach
                
                @foreach($recentPopulations as $population)
                <li class="activity-item">
                    <div class="activity-icon" style="background: #cce7ff;">👤</div>
                    <div class="activity-content">
                        <div class="activity-title">
                            {{ $population->name }} 
                            <span style="font-weight: normal; color: #6c757d;">- {{ $population->occupation }}</span>
                        </div>
                        <div class="activity-time">
                            Profile created {{ $population->created_at->diffForHumans() }} • {{ $population->district }}
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            
            @if($recentUsers->isEmpty() && $recentPopulations->isEmpty())
            <div style="text-align: center; padding: 40px; color: #6c757d;">
                <div style="font-size: 48px; margin-bottom: 10px;">📊</div>
                <h3>No Recent Activity</h3>
                <p>Activity will appear here as users register and create profiles.</p>
            </div>
            @endif
        </div>
    </div>

    <script>
        // Auto-hide success messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const successMessages = document.querySelectorAll('[style*="background: #d4edda"]');
                successMessages.forEach(function(message) {
                    message.style.display = 'none';
                });
            }, 5000);
        });

        // Refresh pending users count every 30 seconds
        setInterval(function() {
            fetch('{{ route("admin.dashboard") }}')
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const pendingLink = doc.querySelector('a[href*="pending"]');
                    if (pendingLink) {
                        const currentLink = document.querySelector('a[href*="pending"]');
                        if (currentLink) {
                            currentLink.innerHTML = pendingLink.innerHTML;
                        }
                    }
                })
                .catch(error => console.log('Auto-refresh failed:', error));
        }, 30000);
    </script>
</body>
</html>