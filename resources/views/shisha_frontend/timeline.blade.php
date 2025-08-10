@extends("layouts.shisha")

@section("hero_section")
    <h1> SHARED SESHAS </h1>
@endsection


@section("content")
<div class="row">

    <!-- main:  timeline section -->
    <livewire:secret-timeline />
        <!-- sidebar -->
    <div class="col-md-4">
            <div class="row">
                <div class="col text-center  mb-4 pt-3">
                    <h4>  Shi Category </h4>
                </div>
            </div>

            <div class="row">
                <div class="col">
                   <x-category />
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