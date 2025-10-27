<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Community Posts - Santal Support</title>
    
    <!-- Tailwind CSS (Breeze default) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .post-card {
            transition: all 0.3s ease;
        }
        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .complaint-modal, .comments-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
        }
        .modal-content {
            max-height: 80vh;
            overflow-y: auto;
        }
        .pagination-btn {
            transition: all 0.3s ease;
        }
        .pagination-btn:hover:not(.disabled) {
            background-color: #3b82f6;
            color: white;
        }
        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">
                        <i class="fas fa-hands-helping text-blue-500 mr-2"></i>
                        Santal Support
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-plus mr-1"></i> Create Post
                        </a>
                        <a href="{{ route('posts.my-posts') }}" class="text-gray-700 hover:text-blue-500">
                            <i class="fas fa-user mr-1"></i> {{ Auth::user()->name }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-500">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Community Posts</h1>
            <div class="flex space-x-4">
                <a href="{{ route('posts.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    All Posts
                </a>
                <a href="{{ route('posts.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    <i class="fas fa-plus mr-1"></i> New Post
                </a>
                @auth
                    <a href="{{ route('posts.my-posts') }}" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
                        <i class="fas fa-user mr-1"></i> My Posts
                    </a>
                @endauth
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <form action="{{ route('posts.index') }}" method="GET" class="flex space-x-4">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Search posts..." class="flex-1 border border-gray-300 rounded px-4 py-2">
                <select name="type" class="border border-gray-300 rounded px-4 py-2">
                    <option value="all">All Types</option>
                    @foreach($postTypes as $key => $value)
                        <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Filter
                </button>
            </form>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Posts List -->
        @if($posts->count() > 0)
            <div class="space-y-6">
                @foreach($posts as $post)
                    <div class="bg-white rounded-lg shadow post-card p-6">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                    <a href="{{ route('posts.show', $post->id) }}" class="hover:text-blue-500">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                
                                <p class="text-gray-600 mb-4">
                                    {{ Str::limit(strip_tags($post->content), 200) }}
                                </p>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <span>
                                            <i class="fas fa-user mr-1"></i>
                                            {{ $post->user->name }}
                                        </span>
                                        <span>
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $post->created_at->diffForHumans() }}
                                        </span>
                                        <span>
                                            <i class="fas fa-eye mr-1"></i>
                                            {{ $post->view_count }} views
                                        </span>
                                        <span class="cursor-pointer hover:text-blue-500" onclick="openCommentsModal({{ $post->id }})">
                                            <i class="fas fa-comment mr-1"></i>
                                            {{ $post->comments->count() }} comments
                                        </span>
                                        @if($post->complaints && $post->complaints->count() > 0)
                                        <span class="text-red-500 cursor-pointer hover:text-red-600" onclick="openReportsModal({{ $post->id }})">
                                            <i class="fas fa-flag mr-1"></i>
                                            {{ $post->complaints->count() }} reports
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex space-x-2">
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                            {{ $postTypes[$post->type] }}
                                        </span>
                                        @if($post->category)
                                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                                {{ $post->category }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('posts.show', $post->id) }}" 
                               class="inline-flex items-center text-blue-500 hover:text-blue-600">
                                Read more & comment
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                            
                            @auth
                                @if(Auth::id() !== $post->user_id)
                                    <button onclick="openComplaintModal({{ $post->id }})" 
                                            class="inline-flex items-center text-red-500 hover:text-red-600">
                                        <i class="fas fa-flag mr-1"></i>
                                        Report Post
                                    </button>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <i class="fas fa-inbox text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No posts found</h3>
                <p class="text-gray-500 mb-6">Be the first to share something with the community!</p>
                <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">
                    <i class="fas fa-plus mr-2"></i>Create First Post
                </a>
            </div>
        @endif
    </div>

    <!-- Report Post Modal -->
    <div id="complaintModal" class="complaint-modal">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Report Post to Community</h3>
                    <button onclick="closeComplaintModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="complaintForm" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" id="complaintPostId">
                    
                    <div class="mb-4">
                        <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Reason for reporting
                        </label>
                        <select name="reason" id="reason" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Select a reason</option>
                            <option value="spam">Spam or misleading content</option>
                            <option value="harassment">Harassment or bullying</option>
                            <option value="inappropriate">Inappropriate content</option>
                            <option value="false_information">False information</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Additional details (optional)
                        </label>
                        <textarea name="description" id="description" rows="3" 
                                  class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Please provide more details about your complaint..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeComplaintModal()" 
                                class="px-4 py-2 text-gray-600 hover:text-gray-800">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Submit Report to Community
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- All Comments Modal -->
    <div id="commentsModal" class="comments-modal">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full p-6 modal-content">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">All Comments</h3>
                    <button onclick="closeCommentsModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div id="commentsList" class="space-y-4 mb-6">
                    <!-- Comments will be loaded here -->
                </div>
                
                <!-- Comments Pagination -->
                <div id="commentsPagination" class="flex justify-between items-center mt-4">
                    <!-- Pagination will be loaded here -->
                </div>
                
                <div class="mt-6">
                    <button onclick="closeCommentsModal()" 
                            class="w-full px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- All Reports Modal -->
    <div id="reportsModal" class="complaint-modal">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full p-6 modal-content">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">All Community Reports</h3>
                    <button onclick="closeReportsModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div id="reportsList" class="space-y-4 mb-6">
                    <!-- Reports will be loaded here -->
                </div>
                
                <!-- Reports Pagination -->
                <div id="reportsPagination" class="flex justify-between items-center mt-4">
                    <!-- Pagination will be loaded here -->
                </div>
                
                <div class="mt-6">
                    <button onclick="closeReportsModal()" 
                            class="w-full px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Updated JavaScript Section with Pagination -->
    <script>
        // Store current post IDs and page numbers
        let currentPostId = null;
        let currentCommentsPage = 1;
        let currentReportsPage = 1;

        // Complaint modal functions
        function openComplaintModal(postId) {
            console.log('Opening complaint modal for post:', postId);
            document.getElementById('complaintPostId').value = postId;
            document.getElementById('complaintForm').action = `/posts/${postId}/complain`;
            document.getElementById('complaintModal').style.display = 'block';
        }

        function closeComplaintModal() {
            document.getElementById('complaintModal').style.display = 'none';
            document.getElementById('complaintForm').reset();
        }

        // Comments modal functions with pagination
        function openCommentsModal(postId, page = 1) {
            console.log('Opening comments modal for post:', postId, 'page:', page);
            currentPostId = postId;
            currentCommentsPage = page;
            
            // Show loading state
            document.getElementById('commentsList').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-spinner fa-spin text-2xl text-blue-500 mb-2"></i>
                    <p class="text-gray-500">Loading comments...</p>
                </div>
            `;
            
            document.getElementById('commentsPagination').innerHTML = '';
            document.getElementById('commentsModal').style.display = 'block';
            
            // Load comments via AJAX with pagination
            fetch(`/posts/${postId}/comments-data?page=${page}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const commentsList = document.getElementById('commentsList');
                const commentsPagination = document.getElementById('commentsPagination');
                
                if (data.success && data.comments && data.comments.length > 0) {
                    // Render comments
                    commentsList.innerHTML = data.comments.map(comment => `
                        <div class="bg-gray-50 border border-gray-200 rounded p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center">
                                    <i class="fas fa-user-circle text-gray-400 mr-2"></i>
                                    <span class="font-medium text-gray-800">${comment.user.name}</span>
                                </div>
                                <span class="text-xs text-gray-500">${new Date(comment.created_at).toLocaleString()}</span>
                            </div>
                            <p class="text-gray-700">${comment.content}</p>
                        </div>
                    `).join('');

                    // Render pagination
                    if (data.pagination.last_page > 1) {
                        commentsPagination.innerHTML = `
                            <div class="flex items-center space-x-2">
                                <button 
                                    onclick="openCommentsModal(${postId}, ${data.pagination.current_page - 1})" 
                                    class="pagination-btn px-3 py-1 border border-gray-300 rounded ${data.pagination.current_page === 1 ? 'disabled' : ''}"
                                    ${data.pagination.current_page === 1 ? 'disabled' : ''}
                                >
                                    <i class="fas fa-chevron-left mr-1"></i> Previous
                                </button>
                                
                                <span class="text-sm text-gray-600">
                                    Page ${data.pagination.current_page} of ${data.pagination.last_page}
                                </span>
                                
                                <button 
                                    onclick="openCommentsModal(${postId}, ${data.pagination.current_page + 1})" 
                                    class="pagination-btn px-3 py-1 border border-gray-300 rounded ${!data.pagination.has_more ? 'disabled' : ''}"
                                    ${!data.pagination.has_more ? 'disabled' : ''}
                                >
                                    Next <i class="fas fa-chevron-right ml-1"></i>
                                </button>
                            </div>
                            <div class="text-sm text-gray-500">
                                Total: ${data.pagination.total} comments
                            </div>
                        `;
                    } else {
                        commentsPagination.innerHTML = `
                            <div class="text-sm text-gray-500">
                                Total: ${data.pagination.total} comments
                            </div>
                        `;
                    }
                } else {
                    commentsList.innerHTML = `
                        <div class="text-center py-8">
                            <i class="fas fa-comment-slash text-3xl text-gray-400 mb-2"></i>
                            <p class="text-gray-500">No comments yet</p>
                        </div>
                    `;
                    commentsPagination.innerHTML = '';
                }
            })
            .catch(error => {
                console.error('Error loading comments:', error);
                document.getElementById('commentsList').innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-2xl text-red-500 mb-2"></i>
                        <p class="text-red-500">Error loading comments</p>
                    </div>
                `;
                document.getElementById('commentsPagination').innerHTML = '';
            });
        }

        function closeCommentsModal() {
            document.getElementById('commentsModal').style.display = 'none';
            currentCommentsPage = 1; // Reset to first page
        }

        // Reports modal functions with pagination
        function openReportsModal(postId, page = 1) {
            console.log('Opening reports modal for post:', postId, 'page:', page);
            currentPostId = postId;
            currentReportsPage = page;
            
            // Show loading state
            document.getElementById('reportsList').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-spinner fa-spin text-2xl text-blue-500 mb-2"></i>
                    <p class="text-gray-500">Loading reports...</p>
                </div>
            `;
            
            document.getElementById('reportsPagination').innerHTML = '';
            document.getElementById('reportsModal').style.display = 'block';
            
            // Load reports via AJAX with pagination
            fetch(`/posts/${postId}/reports-data?page=${page}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const reportsList = document.getElementById('reportsList');
                const reportsPagination = document.getElementById('reportsPagination');
                
                if (data.success && data.reports && data.reports.length > 0) {
                    // Render reports
                    reportsList.innerHTML = data.reports.map(report => `
                        <div class="bg-red-50 border border-red-200 rounded p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center">
                                    <i class="fas fa-flag text-red-500 mr-2"></i>
                                    <span class="font-medium text-red-800">${report.reason}</span>
                                </div>
                                <div class="text-right text-xs text-gray-500">
                                    <div>${new Date(report.created_at).toLocaleString()}</div>
                                    <div>by ${report.user.name}</div>
                                </div>
                            </div>
                            ${report.description ? `<p class="text-red-600 text-sm mt-2">${report.description}</p>` : ''}
                        </div>
                    `).join('');

                    // Render pagination
                    if (data.pagination.last_page > 1) {
                        reportsPagination.innerHTML = `
                            <div class="flex items-center space-x-2">
                                <button 
                                    onclick="openReportsModal(${postId}, ${data.pagination.current_page - 1})" 
                                    class="pagination-btn px-3 py-1 border border-gray-300 rounded ${data.pagination.current_page === 1 ? 'disabled' : ''}"
                                    ${data.pagination.current_page === 1 ? 'disabled' : ''}
                                >
                                    <i class="fas fa-chevron-left mr-1"></i> Previous
                                </button>
                                
                                <span class="text-sm text-gray-600">
                                    Page ${data.pagination.current_page} of ${data.pagination.last_page}
                                </span>
                                
                                <button 
                                    onclick="openReportsModal(${postId}, ${data.pagination.current_page + 1})" 
                                    class="pagination-btn px-3 py-1 border border-gray-300 rounded ${!data.pagination.has_more ? 'disabled' : ''}"
                                    ${!data.pagination.has_more ? 'disabled' : ''}
                                >
                                    Next <i class="fas fa-chevron-right ml-1"></i>
                                </button>
                            </div>
                            <div class="text-sm text-gray-500">
                                Total: ${data.pagination.total} reports
                            </div>
                        `;
                    } else {
                        reportsPagination.innerHTML = `
                            <div class="text-sm text-gray-500">
                                Total: ${data.pagination.total} reports
                            </div>
                        `;
                    }
                } else {
                    reportsList.innerHTML = `
                        <div class="text-center py-8">
                            <i class="fas fa-flag text-3xl text-gray-400 mb-2"></i>
                            <p class="text-gray-500">No reports yet</p>
                        </div>
                    `;
                    reportsPagination.innerHTML = '';
                }
            })
            .catch(error => {
                console.error('Error loading reports:', error);
                document.getElementById('reportsList').innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-2xl text-red-500 mb-2"></i>
                        <p class="text-red-500">Error loading reports</p>
                    </div>
                `;
                document.getElementById('reportsPagination').innerHTML = '';
            });
        }

        function closeReportsModal() {
            document.getElementById('reportsModal').style.display = 'none';
            currentReportsPage = 1; // Reset to first page
        }

        // Close modals when clicking outside
        document.getElementById('complaintModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeComplaintModal();
            }
        });

        document.getElementById('commentsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCommentsModal();
            }
        });

        document.getElementById('reportsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReportsModal();
            }
        });

        // Handle complaint form submission with AJAX
        document.getElementById('complaintForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Submitting...';
            submitBtn.disabled = true;

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                if (data.success) {
                    closeComplaintModal();
                    showFlashMessage(data.message, 'success');
                    // Reload page after 1.5 seconds to show the new complaint
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showFlashMessage(data.message, 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                showFlashMessage('An error occurred while submitting your report. Please try again.', 'error');
            }
        });

        function showFlashMessage(message, type) {
            // Remove any existing flash messages
            const existingMessages = document.querySelectorAll('.custom-flash-message');
            existingMessages.forEach(msg => msg.remove());

            const flashDiv = document.createElement('div');
            flashDiv.className = `custom-flash-message fixed top-4 right-4 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white px-6 py-3 rounded-lg shadow-lg z-50`;
            flashDiv.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>${message}`;
            
            document.body.appendChild(flashDiv);
            
            setTimeout(() => {
                flashDiv.remove();
            }, 5000);
        }

        // Auto-hide existing flash messages
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const messages = document.querySelectorAll('.bg-green-100, .bg-red-100');
                messages.forEach(msg => {
                    msg.style.transition = 'opacity 0.5s ease';
                    msg.style.opacity = '0';
                    setTimeout(() => msg.remove(), 500);
                });
            }, 5000);
        });

        // Add Enter key support for form submission
        document.getElementById('complaintForm').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.dispatchEvent(new Event('submit'));
            }
        });
    </script>
</body>
</html>