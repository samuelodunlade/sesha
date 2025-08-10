@extends("layouts.auth")


@section("page_name", "Login")


@section("content")
    <form action="/login" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
            <label for="floatingInput">Email address</label>
            @error("email")
                <p class="alert alert-danger">
                    {{$message}}
                </p>
            @enderror
        </div>
        <div class="form-floating mb-4">
            <input type="password" class="form-control" id="mypassword" placeholder="Password" name="password">
            <label for="mypassword">Password</label>
            @error("password")
                <p class="alert alert-danger">
                    {{$message}}
                </p>
            @enderror
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="passtoggle" name="remember">
                <label class="form-check-label" for="passtoggle" id='toggle_label'>show Password</label>
            </div>
            <a href="{{route('password.request')}}">Forgot Password</a>
        </div>
        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
        <p class="text-center mb-0">Don't have an Account? <a href="{{route('register')}}">Sign Up</a></p>
    </form>
@endsection


@section("scripts")
    <script>
        $(document).ready(function() {
            //when passtoggle is clicked, toggle the type of the password input and 
            $("#passtoggle").click(function() {
                if ($(this).is(":checked")) {
                    $("#mypassword").attr("type", "text");
                    $("#toggle_label").text("hide Password");
                } else {
                    $("#mypassword").attr("type", "password");
                    $("#toggle_label").text("show Password");
                }
            });
        });
    </script>   
@endsection