<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Users - Admin</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: #f8f9fa; 
            margin: 0; 
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
        .table { 
            background: white; 
            border-radius: 10px; 
            overflow: hidden; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        th, td { 
            padding: 12px 15px; 
            text-align: left; 
            border-bottom: 1px solid #ddd; 
        }
        th { 
            background: #ffc107; 
            color: black; 
            font-weight: 600;
        }
        .btn { 
            padding: 8px 15px; 
            text-decoration: none; 
            border-radius: 5px; 
            font-size: 12px; 
            border: none; 
            cursor: pointer; 
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-success { 
            background: #28a745; 
            color: white; 
        }
        .btn-success:hover {
            background: #218838;
            transform: translateY(-1px);
        }
        .btn-danger { 
            background: #dc3545; 
            color: white; 
        }
        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-1px);
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .id-images { 
            display: flex; 
            gap: 10px; 
            margin-top: 5px; 
        }
        .id-image { 
            width: 80px; 
            height: 60px; 
            object-fit: cover; 
            border-radius: 5px; 
            cursor: pointer; 
            border: 2px solid #dee2e6;
            transition: all 0.3s;
        }
        .id-image:hover {
            border-color: #007bff;
            transform: scale(1.05);
        }
        .modal { 
            display: none; 
            position: fixed; 
            z-index: 1000; 
            left: 0; 
            top: 0; 
            width: 100%; 
            height: 100%; 
            background-color: rgba(0,0,0,0.9); 
        }
        .modal-content { 
            margin: 2% auto; 
            display: block; 
            max-width: 90%; 
            max-height: 90%; 
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0,0,0,0.5);
        }
        .close { 
            position: absolute; 
            top: 20px; 
            right: 35px; 
            color: white; 
            font-size: 40px; 
            font-weight: bold; 
            cursor: pointer; 
            background: rgba(0,0,0,0.5);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .close:hover {
            background: rgba(0,0,0,0.8);
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        .user-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <h1>⏳ Pending Users - Santal Community</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}" style="color: white;">← Back to Dashboard</a>
            <a href="{{ route('admin.users.index') }}" style="color: white; margin-left: 15px;">View All Users</a>
        </div>
    </div>

    <div class="admin-nav">
        <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
        <a href="{{ route('admin.populations.index') }}">👥 Populations</a>
        <a href="{{ route('admin.users.index') }}">👤 Users</a>
        <a href="{{ route('admin.users.pending') }}">⏳ Pending ({{ $users->count() }})</a>
        <a href="{{ route('admin.statistics') }}">📈 Statistics</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: white; cursor: pointer;">🚪 Logout</button>
        </form>
    </div>

    <div class="container">
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

        <div style="background: #fff3cd; color: #856404; padding: 20px; border-radius: 10px; margin-bottom: 25px; border: 1px solid #ffeaa7; display: flex; align-items: center; gap: 15px;">
            <div style="font-size: 24px;">⏳</div>
            <div style="flex: 1;">
                <h3 style="margin: 0 0 5px 0;">Pending User Approvals</h3>
                <p style="margin: 0;">You have <strong>{{ $users->count() }}</strong> user(s) waiting for approval. Please review their ID documents.</p>
            </div>
        </div>

        @if($users->count() > 0)
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>User Information</th>
                        <th>ID Documents</th>
                        <th>Registration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="user-info">
                                <strong>{{ $user->name }}</strong>
                                <div style="color: #6c757d; font-size: 14px; margin-top: 5px;">
                                    📧 {{ $user->email }}<br>
                                    🆔 National ID: {{ $user->national_id }}<br>
                                    @if($user->student_id)
                                    🎓 Student ID: {{ $user->student_id }}
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="id-images">
                                @if($user->id_card_front)
                                    <img src="{{ $user->getIdCardFrontUrl() }}" alt="ID Front" class="id-image" 
                                         onclick="openModal('{{ $user->getIdCardFrontUrl() }}')"
                                         title="Click to view front side">
                                @else
                                    <div style="background: #f8f9fa; padding: 10px; border-radius: 5px; text-align: center; color: #6c757d;">
                                        No Front Image
                                    </div>
                                @endif
                                @if($user->id_card_back)
                                    <img src="{{ $user->getIdCardBackUrl() }}" alt="ID Back" class="id-image" 
                                         onclick="openModal('{{ $user->getIdCardBackUrl() }}')"
                                         title="Click to view back side">
                                @else
                                    <div style="background: #f8f9fa; padding: 10px; border-radius: 5px; text-align: center; color: #6c757d;">
                                        No Back Image
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <strong>{{ $user->created_at->format('M d, Y') }}</strong><br>
                            <small style="color: #6c757d;">
                                {{ $user->created_at->diffForHumans() }}
                            </small>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success" 
                                            onclick="return confirm('Approve {{ $user->name }}? They will be able to login and access the community.')">
                                        ✅ Approve
                                    </button>
                                </form>
                                <button type="button" class="btn btn-danger" 
                                        onclick="showRejectionModal({{ $user->id }}, '{{ $user->name }}')">
                                    ❌ Reject
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="text-align: center; margin-top: 20px; color: #6c757d;">
            Showing {{ $users->count() }} pending user(s)
        </div>
        @else
        <div class="empty-state">
            <div class="empty-state-icon">🎉</div>
            <h3 style="color: #6c757d; margin-bottom: 10px;">No Pending Users</h3>
            <p style="color: #6c757d; margin-bottom: 20px;">All user registrations have been processed!</p>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">View All Users</a>
        </div>
        @endif
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <!-- Rejection Modal -->
    <div id="rejectionModal" class="modal">
        <div style="background: white; margin: 10% auto; padding: 30px; border-radius: 15px; width: 500px; max-width: 90%; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
            <h3 style="margin-top: 0; color: #dc3545;">❌ Reject User Registration</h3>
            <p style="color: #6c757d; margin-bottom: 20px;" id="rejectUserInfo">Reject user registration?</p>
            
            <form id="rejectionForm" method="POST">
                @csrf
                <div style="margin: 20px 0;">
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Rejection Reason:</label>
                    <textarea name="rejection_reason" required 
                              style="width: 100%; height: 120px; padding: 12px; border: 1px solid #ddd; border-radius: 8px; resize: vertical;"
                              placeholder="Please provide a clear reason for rejection. This will be shown to the user..."
                              oninput="updateCharCount(this)"></textarea>
                    <div style="text-align: right; margin-top: 5px;">
                        <span id="charCount" style="color: #6c757d; font-size: 12px;">0/500 characters</span>
                    </div>
                </div>
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeRejectionModal()">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject User</button>
                </div>
            </form>
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

        function showRejectionModal(userId, userName) {
            currentUserId = userId;
            document.getElementById('rejectUserInfo').textContent = `Reject registration for ${userName}?`;
            document.getElementById('rejectionForm').action = `/admin/users/${userId}/reject`;
            document.getElementById('rejectionModal').style.display = 'block';
            
            // Reset form
            document.querySelector('#rejectionForm textarea').value = '';
            updateCharCount(document.querySelector('#rejectionForm textarea'));
        }

        function closeRejectionModal() {
            document.getElementById('rejectionModal').style.display = 'none';
            currentUserId = null;
        }

        // Character count for rejection reason
        function updateCharCount(textarea) {
            const charCount = textarea.value.length;
            document.getElementById('charCount').textContent = `${charCount}/500 characters`;
            
            if (charCount > 500) {
                document.getElementById('charCount').style.color = '#dc3545';
            } else {
                document.getElementById('charCount').style.color = '#6c757d';
            }
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

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
                closeRejectionModal();
            }
        });

        // Auto-hide success messages after 5 seconds
        setTimeout(function() {
            const successMessages = document.querySelectorAll('[style*="background: #d4edda"]');
            successMessages.forEach(function(message) {
                message.style.display = 'none';
            });
        }, 5000);
    </script>
</body>
</html>