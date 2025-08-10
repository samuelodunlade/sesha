@extends("layouts.admin_dash")

@section("content")
{{-- session('success')  --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
    </div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center pb-5 pt-3">
        <h1 class="card-title text-secondary">Tags</h1>
        <div class="card-tools">
            <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Add Tag</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td>
                        <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{-- {{ $tags->links() }} --}}
    </div>
</div>
{{-- end card  --}}

    
    
@endsection