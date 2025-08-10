@extends("layouts.shisha")

@section("title")
    Calm Down....
@endsection

@section("hero_section")
    <div class="col-md-8 offset-md-2 text-center">
        <h1> COOL OFF ZONE</h1>
        <P>You are moving too fast </P>
        <a href="{{ route('shisha.create') }}" class="btn btn-primary"> Share  <i class="fa-solid fa-share"></i></a>
        <a href="{{ route('shisha.timeline') }}" class="btn btn-primary">Read <i class="fa-brands fa-readme"></i></a>
    </div>
@endsection

@section("content")
    <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
            <p>There is limit to the number of secrets you can share per our and per day </p>
            <p> Please wait for a while and try again </p>
            <a href="{{ route('shisha.timeline') }}" class="btn btn-primary">Read <i class="fa-brands fa-readme"></i></a>
            <img src="/assets/images/429.jpg" alt="" class="img-fluid mt-5">
           
        </div>
    </div>
    @endsection