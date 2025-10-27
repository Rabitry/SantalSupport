@extends('layouts.app')

@section('title', 'Manage Complaints - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>
                    <i class="fas fa-flag"></i> 
                    Post Complaints
                </h2>
                <div class="btn-group">
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back to Posts
                    </a>
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-eye"></i> View Public Posts
                    </a>
                </div>
            </div>

            <!-- Complaints List -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        Pending Complaints ({{ $complaints->total() }})
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($complaints->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Complained Post</th>
                                        <th>Complaint By</th>
                                        <th>Reason</th>
                                        <th>Submitted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($complaints as $complaint)
                                        <tr>
                                            <td>
                                                <div>
                                                    <strong>
                                                        <a href="{{ route('posts.show', $complaint->post->id) }}" 
                                                           target="_blank">
                                                            {{ Str::limit($complaint->post->title, 50) }}
                                                        </a>
                                                    </strong>
                                                </div>
                                                <small class="text-muted">
                                                    By: {{ $complaint->post->user->name }}
                                                </small>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $complaint->user->name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $complaint->user->email }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-1">{{ $complaint->reason }}</p>
                                                <small class="text-muted">
                                                    {{ Str::limit($complaint->reason, 100) }}
                                                </small>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $complaint->created_at->format('M j, Y') }}<br>
                                                    <span class="text-info">{{ $complaint->created_at->diffForHumans() }}</span>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('posts.show', $complaint->post->id) }}" 
                                                       class="btn btn-outline-primary" 
                                                       target="_blank"
                                                       title="View Post">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('admin.posts.destroy', $complaint->post->id) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" 
                                                                onclick="return confirm('Are you sure you want to delete this post? This will also delete all associated comments and complaints.')"
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
                            <i class="fas fa-flag fa-3x text-muted mb-3"></i>
                            <h4>No pending complaints</h4>
                            <p class="text-muted">All complaints have been resolved.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pagination -->
            @if($complaints->count() > 0)
                <div class="d-flex justify-content-center mt-4">
                    {{ $complaints->links() }}
                </div>
            @endif

            <!-- Complaint Statistics -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ \App\Models\Complaint::where('status', 'pending')->count() }}</h4>
                                    <p class="mb-0">Pending Complaints</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ \App\Models\Complaint::where('status', 'resolved')->count() }}</h4>
                                    <p class="mb-0">Resolved Complaints</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white">
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