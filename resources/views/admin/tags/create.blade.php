@extends("layouts.admin_dash")

@section("content")
{{-- form to create tag in a card --}}
<div class="card">
    <div class="card-header pt-3 pb-5 d-flex justify-content-between align-items-center">
        <h1 class="card-title text-secondary">Create Tag</h1>
        <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Back to Tags</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.tags.store') }}" method="post" class="p-5">
            @csrf
            <div class="form-group">
                <label for="name" class="mb-2">Tag Name</label>
                <input type="text" class="form-control my-3" id="name" name="name" placeholder="Enter tag name">
                @error("name")
                    <div class="alert alert-danger my-2">
                        {{ $message }}

                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Tag</button>
        </form>
    </div>
    <div class="card-footer">
        
    </div>
</div>

    
    
@endsection