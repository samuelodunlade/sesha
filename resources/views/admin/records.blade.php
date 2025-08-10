@extends('layouts.admin_dash')

@section("content")

<div class="row py-5 bg-white">
    <div class="col-md-10 offset-md-1 bg-white">
            <h1 class="mb-4 text-secondary">Secret Records</h1>
    </div>
    {{-- most viewed secrets in table format in card --}}
    <div class="col-md-10 offset-md-1 bg-white">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0 text-primary">Top Five Most Viewed Secrets</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th> Title </th>
                                <th> Category </th>
                                <th> Upvote </th>
                                <th> Downvote </th>
                                <th> Views </th>
                                <th> Date </th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($most_viewed as $secret)
                                <tr>
                                    <td>{{ $secret->title }}</td>
                                    <td>{{ $secret->category->title }}</td>
                                    <td>{{ $secret->upvotes }}</td>
                                    <td>{{ $secret->downvotes }}</td>
                                    <td>{{ $secret->views }}</td>
                                    <td>{{ $secret->created_at }}</td>
                                    <td>
                                        @if($secret->expires_at && $secret->expires_at->isPast())
                                            <span class="badge bg-danger">Expired</span>
                                        @elseif($secret->expires_at)
                                            <span class="badge bg-warning text-dark">
                                                Expires: {{ $secret->expires_at->diffForHumans() }}
                                            </span>
                                        @endif
                                        @if($secret->is_blocked)
                                        <span class="badge bg-danger">Blocked</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('admin.secrets.show', $secret->id) }}" class="btn btn-primary">View</a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>  

    {{-- top 5 most liked secrets --}}
    <div class="col-md-10 offset-md-1 bg-white">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0 text-primary">Top Five Most Liked Secrets</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th> Title </th>
                                <th> Category </th>
                                <th> Upvote </th>
                                <th> Downvote </th>
                                <th> Views </th>
                                <th> Date </th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($most_liked as $secret)
                                <tr>
                                    <td>{{ $secret->title }}</td>
                                    <td>{{ $secret->category->title }}</td>
                                    <td>{{ $secret->upvotes }}</td>
                                    <td>{{ $secret->downvotes }}</td>
                                    <td>{{ $secret->views }}</td>
                                    <td>{{ $secret->created_at }}</td>
                                    <td>
                                        @if($secret->expires_at && $secret->expires_at->isPast())
                                            <span class="badge bg-danger">Expired</span>
                                        @elseif($secret->expires_at)
                                            <span class="badge bg-warning text-dark">
                                                Expires: {{ $secret->expires_at->diffForHumans() }}
                                            </span>
                                        @endif
                                        @if($secret->is_blocked)
                                        <span class="badge bg-danger">Blocked</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('admin.secrets.show', $secret->id) }}" class="btn btn-primary">View</a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div> 

    {{-- top 5 most disliked secrets --}}
    
    <div class="col-md-10 offset-md-1 bg-white">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0 text-primary">Top Five Most DisLiked Secrets</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th> Title </th>
                                <th> Category </th>
                                <th> Upvote </th>
                                <th> Downvote </th>
                                <th> Views </th>
                                <th> Date </th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($most_disliked as $secret)
                                <tr>
                                    <td>{{ $secret->title }}</td>
                                    <td>{{ $secret->category->title }}</td>
                                    <td>{{ $secret->upvotes }}</td>
                                    <td>{{ $secret->downvotes }}</td>
                                    <td>{{ $secret->views }}</td>
                                    <td>{{ $secret->created_at }}</td>
                                    <td>
                                        @if($secret->expires_at && $secret->expires_at->isPast())
                                            <span class="badge bg-danger">Expired</span>
                                        @elseif($secret->expires_at)
                                            <span class="badge bg-warning text-dark">
                                                Expires: {{ $secret->expires_at->diffForHumans() }}
                                            </span>
                                        @endif
                                        @if($secret->is_blocked)
                                        <span class="badge bg-danger">Blocked</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('admin.secrets.show', $secret->id) }}" class="btn btn-primary">View</a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div> 
   

    



</div>    
@endsection