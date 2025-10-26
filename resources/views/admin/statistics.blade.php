<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics - Admin</title>
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
            max-width: 1200px;
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
        }
        .stat-card h3 {
            margin: 0;
            color: #333;
            font-size: 14px;
            text-transform: uppercase;
        }
        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #dc3545;
            margin: 10px 0;
        }
        .chart-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .chart-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 8px;
        }
        .stats-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .stats-list li {
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stats-list li:last-child {
            border-bottom: none;
        }
        .count-badge {
            background: #007bff;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        .progress-bar {
            background: #e9ecef;
            border-radius: 10px;
            height: 20px;
            margin-top: 5px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #007bff, #0056b3);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <h1>📈 Statistics - Santal Community</h1>
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

        <!-- Overview Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Population</h3>
                <div class="stat-number">{{ $populationStats->total }}</div>
                <p>Registered Profiles</p>
            </div>
            <div class="stat-card">
                <h3>Students</h3>
                <div class="stat-number">{{ $populationStats->students }}</div>
                <p>Student Profiles</p>
            </div>
            <div class="stat-card">
                <h3>Jobholders</h3>
                <div class="stat-number">{{ $populationStats->jobholders }}</div>
                <p>Working Professionals</p>
            </div>
            <div class="stat-card">
                <h3>Gender Distribution</h3>
                <div class="stat-number">{{ $populationStats->males }}M / {{ $populationStats->females }}F</div>
                <p>Male vs Female</p>
            </div>
        </div>

        <!-- Gender Distribution -->
        <div class="chart-container">
            <div class="chart-title">👥 Gender Distribution</div>
            <div style="display: flex; gap: 20px; align-items: center;">
                <div style="flex: 1;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span>Male: {{ $populationStats->males }} ({{ $populationStats->total > 0 ? round(($populationStats->males / $populationStats->total) * 100, 1) : 0 }}%)</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $populationStats->total > 0 ? ($populationStats->males / $populationStats->total) * 100 : 0 }}%; background: #007bff;"></div>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin: 15px 0 5px 0;">
                        <span>Female: {{ $populationStats->females }} ({{ $populationStats->total > 0 ? round(($populationStats->females / $populationStats->total) * 100, 1) : 0 }}%)</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $populationStats->total > 0 ? ($populationStats->females / $populationStats->total) * 100 : 0 }}%; background: #e83e8c;"></div>
                    </div>
                </div>
                <div style="width: 150px; text-align: center;">
                    <div style="font-size: 14px; color: #666; margin-bottom: 5px;">Total</div>
                    <div style="font-size: 32px; font-weight: bold; color: #dc3545;">{{ $populationStats->total }}</div>
                </div>
            </div>
        </div>

        <!-- Blood Group Statistics -->
        <div class="chart-container">
            <div class="chart-title">🩸 Blood Group Distribution</div>
            @if($bloodGroupStats->count() > 0)
                <ul class="stats-list">
                    @foreach($bloodGroupStats as $bloodGroup)
                    <li>
                        <span style="font-weight: bold;">{{ $bloodGroup->blood_group }}</span>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <span class="count-badge">{{ $bloodGroup->count }}</span>
                            <div style="width: 100px;">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ ($bloodGroup->count / $populationStats->total) * 100 }}%;"></div>
                                </div>
                            </div>
                            <span style="font-size: 12px; color: #666; min-width: 40px;">
                                {{ round(($bloodGroup->count / $populationStats->total) * 100, 1) }}%
                            </span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @else
                <p style="text-align: center; color: #666; padding: 20px;">No blood group data available</p>
            @endif
        </div>

        <!-- District Distribution -->
        <div class="chart-container">
            <div class="chart-title">📍 District Distribution</div>
            @if($districtStats->count() > 0)
                <ul class="stats-list">
                    @foreach($districtStats as $district)
                    <li>
                        <span>{{ $district->district }}</span>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <span class="count-badge">{{ $district->count }}</span>
                            <div style="width: 100px;">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ ($district->count / $populationStats->total) * 100 }}%; background: #28a745;"></div>
                                </div>
                            </div>
                            <span style="font-size: 12px; color: #666; min-width: 40px;">
                                {{ round(($district->count / $populationStats->total) * 100, 1) }}%
                            </span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @else
                <p style="text-align: center; color: #666; padding: 20px;">No district data available</p>
            @endif
        </div>

        <!-- Occupation Distribution -->
        <div class="chart-container">
            <div class="chart-title">💼 Occupation Distribution</div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                    <div style="font-size: 24px; font-weight: bold; color: #007bff;">{{ $populationStats->students }}</div>
                    <div style="font-size: 14px; color: #666;">Students</div>
                    <div style="font-size: 12px; color: #999; margin-top: 5px;">
                        {{ $populationStats->total > 0 ? round(($populationStats->students / $populationStats->total) * 100, 1) : 0 }}%
                    </div>
                </div>
                <div style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                    <div style="font-size: 24px; font-weight: bold; color: #28a745;">{{ $populationStats->jobholders }}</div>
                    <div style="font-size: 14px; color: #666;">Jobholders</div>
                    <div style="font-size: 12px; color: #999; margin-top: 5px;">
                        {{ $populationStats->total > 0 ? round(($populationStats->jobholders / $populationStats->total) * 100, 1) : 0 }}%
                    </div>
                </div>
                <div style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                    <div style="font-size: 24px; font-weight: bold; color: #ffc107;">
                        {{ $populationStats->total - $populationStats->students - $populationStats->jobholders }}
                    </div>
                    <div style="font-size: 14px; color: #666;">Others</div>
                    <div style="font-size: 12px; color: #999; margin-top: 5px;">
                        {{ $populationStats->total > 0 ? round((($populationStats->total - $populationStats->students - $populationStats->jobholders) / $populationStats->total) * 100, 1) : 0 }}%
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="chart-container">
            <div class="chart-title">📋 Quick Summary</div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                <div style="padding: 15px; background: linear-gradient(135deg, #007bff, #0056b3); color: white; border-radius: 8px;">
                    <div style="font-size: 16px; font-weight: bold;">Total Profiles</div>
                    <div style="font-size: 32px; font-weight: bold; margin-top: 10px;">{{ $populationStats->total }}</div>
                </div>
                <div style="padding: 15px; background: linear-gradient(135deg, #28a745, #20c997); color: white; border-radius: 8px;">
                    <div style="font-size: 16px; font-weight: bold;">Active Data</div>
                    <div style="font-size: 32px; font-weight: bold; margin-top: 10px;">{{ $bloodGroupStats->count() + $districtStats->count() }}</div>
                    <div style="font-size: 12px; margin-top: 5px;">Blood Groups & Districts</div>
                </div>
                <div style="padding: 15px; background: linear-gradient(135deg, #6f42c1, #e83e8c); color: white; border-radius: 8px;">
                    <div style="font-size: 16px; font-weight: bold;">Coverage</div>
                    <div style="font-size: 32px; font-weight: bold; margin-top: 10px;">{{ $districtStats->count() }}</div>
                    <div style="font-size: 12px; margin-top: 5px;">Districts Covered</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>