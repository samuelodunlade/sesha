@extends("layouts.shisha")

@section("hero_section")
    <h1> SHARED SHISHAS  </h1>
    <h3> <strong>Tag: </strong>   #{{ $tag->name }} </h3>
@endsection


@section("content")
<div class="row">
    <!-- main -->
    <div class="col-md-8">
            <!-- all shi -->
        @forelse ( $tag->secrets as $secret )
            <x-single-secret :secret="$secret" />
        @empty

            {{-- alert box to show no secrets for this tag --}}
            <div class="alert alert-warning">
                <h4 class="alert-heading"> No Secrets Found </h4>
                <p> There are no secrets available for this tag. </p>
                <hr>
                <p class="mb-0"> Please check back later or try a different tag. </p>
            </div>

        @endforelse
            

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
                    <h4> Popular  Secrets </h4>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="shi-cat-box">
                        <x-popular-secrets />
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection