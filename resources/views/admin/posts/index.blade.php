@extends('layouts.app')

@section('title', 'Manage Posts - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>
                    <i class="fas fa-newspaper"></i> 
                    Manage Posts
                </h2>
                <div class="btn-group">
                    <a href="{{ route('admin.posts.complaints') }}" class="btn btn-outline-warning">
                        <i class="fas fa-flag"></i> View Complaints
                    </a>
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-eye"></i> View Public Posts
                    </a>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.posts.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Search posts by title or content..." 
                                           value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="type" class="form-control">
                                        <option value="all">All Types</option>
                                        @foreach($postTypes as $key => $value)
                                            <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Posts Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">All Posts ({{ $posts->total() }})</h5>
                </div>
                <div class="card-body p-0">
                    @if($posts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Type</th>
                                        <th>Comments</th>
                                        <th>Views</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>
                                                <div>
                                                    <a href="{{ route('posts.show', $post->id) }}" 
                                                       class="font-weight-bold" target="_blank">
                                                        {{ Str::limit($post->title, 60) }}
                                                    </a>
                                                </div>
                                                @if($post->category)
                                                    <small class="text-muted">{{ $post->category }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <strong>{{ $post->user->name }}</strong>
                                                        <br>
                                                        <small class="text-muted">{{ $post->user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ $post->type }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-light">
                                                    {{ $post->comments->count() }} comments
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $post->view_count }} views
                                                </small>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $post->created_at->format('M j, Y') }}<br>
                                                    <span class="text-info">{{ $post->created_at->diffForHumans() }}</span>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('posts.show', $post->id) }}" 
                                                       class="btn btn-outline-primary" 
                                                       target="_blank"
                                                       title="View Post">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" 
                                                                onclick="return confirm('Are you sure you want to delete this post? This action cannot be undone.')"
                                                                title="Delete Post">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h4>No posts found</h4>
                            <p class="text-muted">No posts match your search criteria.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pagination -->
            @if($posts->count() > 0)
                <div class="d-flex justify-content-center mt-4">
                    {{ $posts->links() }}
                </div>
            @endif

            <!-- Statistics -->
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ \App\Models\Post::count() }}</h4>
                                    <p class="mb-0">Total Posts</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-newspaper fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ \App\Models\Comment::count() }}</h4>
                                    <p class="mb-0">Total Comments</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-comments fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ \App\Models\User::count() }}</h4>
                                    <p class="mb-0">Total Users</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ \App\Models\Complaint::count() }}</h4>
                                    <p class="mb-0">Total Complaints</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-flag fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection