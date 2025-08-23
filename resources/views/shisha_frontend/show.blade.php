@extends("layouts.shisha")

@section("hero_section")
    <h1> {{ $secret->title }}  </h1>
    <h3> Category: <strong> <a href="{{ route('shisha.bycategory', ['cat_name'=>$secret->category->slug]) }}">{{ $secret->category->title }}</a> </strong>  </h3>
@endsection


@section("content")
<div class="row">
        <!-- main -->
        <div class="col-md-8">
            <div class="text-center mb-3">
               @livewire('secret-voting', ['secret' => $secret]) 
            </div>
            

        {{-- secret detail --}}
        {{-- bootstrap card --}}
        <div class="card">
            @if($secret->category->cover_image)
            <img src="{{ asset('storage/'.$secret->category->cover_image) }}" 
                alt="{{ $secret->category->title }} " 
                class="card-img-top">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center">
                    <i class="bi bi-image text-muted" style="font-size: 1.5rem;"></i>
                </div>
            @endif
            <div class="card-body">
              <h5 class="card-title">{{ $secret->summary }} </h5>
              <p class="card-text">{!! $secret->content !!}</p>
            </div>
            <h6 class="card-title p-3 text-danger"> Related Secrets </h6>
            <ul class="list-group list-group-flush">
                @forelse ($secret->related($secret->category_id) as $sec)
                <li class="list-group-item">
                    <a href="{{ route('shisha.show', ['secret'=>$sec->slug]) }}">
                        {{ $sec->title }}
                    </a>
                </li>  
                @empty
                <li class="list-group-item">
                    <p class="alert alert-warning">
                        No related secrets found.
                    </p>
                </li>
                @endforelse
              
            
            </ul>
            {{-- <div class="card-body">
              <a href="#" class="card-link">Card link</a>
              <a href="#" class="card-link">Another link</a>
            </div> --}}
        </div>

        </div>
        <!-- sidebar -->
        <div class="col-md-4">
            <div class="row">
                <div class="col text-center  mb-4 pt-3">
                    <h4>  Shi Category </h4>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <x-category/>
                </div>
            </div>
            <div class="row">
                <div class="col text-center   mb-4 pt-3">
                    <h4> Popular  Shi Tags </h4>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="shi-cat-box">
                        <ul class="list-group">
                            <li class="list-group-item">An item</li>
                            <li class="list-group-item">A second item</li>
                            <li class="list-group-item">A third item</li>
                            <li class="list-group-item">A fourth item</li>
                            <li class="list-group-item">And a fifth one</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection