@extends('layouts.admin_dash')


@section("content")
    <h1> {{ $secret->title }} </h1>
    <p> Category: <strong>{{ $secret->category->title }}</strong>  </p>
    <p> Summary: <strong>{{ $secret->summary }}</strong>  </p>
    <br>
    @if(session("success"))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> <span class="fa fa-check"> &nbsp; </span> Success! </strong> {{ session("success") }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    {{-- if secret has expired show a form for admin to extend it  --}}
    @if ($secret->expires_at && $secret->expires_at->isPast())
        <form action="/admin/secrets/{{ $secret->id }}}/update" method="post" class="bg-white shadow-sm p-3 mb-5 rounded">
            <h3 class="text-center text-primary my-3"> Secret Expired <strong>But You can extend it</strong></h3>
            <hr>
            @csrf
            @method("patch")
            <div class="row mb-3 p-3">
                <div class="col-md-6">
                   <label for="expires_at" class="mb-3">Set New Expiration Date</label> 
                </div>
                
                <div class="col-md-6">
                    <select class="form-select border-0" id="Lifecycle" name="lifecycle"  wire:model='lifecycle'>
                        <option value="" selected>How long should your shi be available</option>
                        @foreach($expirationOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select> 
                        @error("lifecycle")
                            <div class="alert alert-danger mt-2">
                                {{$message}}
                            </div>
                        @enderror
                </div>
                
                
            </div>
            <button type="submit" class="btn btn-primary">Extend Secret Lifecycle</button>
        </form>
    @endif
    <hr>
    <p> {{ $secret->content }} </p>
    <p> {{ $secret->created_at }} </p>

    <hr/>
    <h3> Manage Tag for this secret </h3>
    <livewire:secret-tag-manager :secret="$secret" />
@endsection


@section("scripts")
   @push('scripts')
        <script>
        document.addEventListener('livewire:load', function() {
            // Focus input after tag is added
            Livewire.on('tag-added', () => {
                document.querySelector('[wire\\:model="tagInput"]').focus();
            });
            
            // Handle keyboard navigation for Enter key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target.getAttribute('wire:model') === 'tagInput') {
                    Livewire.emit('selectHighlighted');
                }
            });
        });
        </script>
    @endpush
@endsection