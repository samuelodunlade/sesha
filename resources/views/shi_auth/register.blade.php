@extends("layouts.auth")

@section("page_name", "Register")


@section("content")
    <form action="/register" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingText" placeholder="Sule Baba" name="name" value="{{old('name')}}">
            <label for="floatingText">Fullname</label>
            @error("name")
                <p class="alert alert-danger"> {{$message}} </p>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="sulebaba@email.com" name="email" value="{{old('email')}}">
            <label for="floatingInput">Email address</label>
            @error("email")
                <p class="alert alert-danger"> {{$message}} </p>
            @enderror
        </div>

        <div class="form-floating mb-4">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Password</label>
            @error("password")
                <p class="alert alert-danger"> {{$message}} </p>
            @enderror
        </div>

        <div class="form-floating mb-4">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Confirm Password" name="password_confirmation">
            <label for="floatingPassword"> Confirm Password</label>
            @error("password_confirmation")
                <p class="alert alert-danger"> {{$message}} </p>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Register</button>
        <p class="text-center mb-0">Already have an Account? <a href="{{ route('login') }}">Sign In</a></p>
    </form>
@endsection