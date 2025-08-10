@extends("layouts.admin_dash")

@section("content")
{{-- card with form to change profile picture only --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-secondary">Profile Picture</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('admin.profile.updatePicture') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group my-3">
                                <label for="picture">Upload New Profile Picture</label>
                                <input type="file" class="form-control mt-2" id="picture" name="picture" accept="image/*">
                                @error('picture')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profile Picture</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                         <p class="text-muted">Current Profile Picture:</p>
                           @if(auth()->user()->display_picture)
                           <img src="{{ asset('storage/' . auth()->user()->display_picture) }}" alt="Profile Picture" class="img-thumbnail" style="max-width: 150px;"> 
                            @else
                            <img class="rounded-circle" src="/admin/img/user.jpg" alt="" style="max-width: 150px;">
                            
                            @endif
                        
                    </div>
                </div>
                


            </div>
            
        </div>        
</div>

    

@endsection