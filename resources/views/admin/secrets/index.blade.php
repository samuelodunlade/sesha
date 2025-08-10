@extends('layouts.admin_dash')


@section("content")
<div class="row py-5 bg-white">
    <div class="col-md-10 offset-md-1 bg-white">
            <h1 class="mb-4 text-secondary">Manage  Secrets</h1>

            @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
    </div>
    <livewire:admin-manage-secret />

</div>
@endsection