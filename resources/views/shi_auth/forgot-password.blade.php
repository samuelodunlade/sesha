@extends("layouts.auth")

@section("page_name", "Forget Password")


@section("content")
    <p class="text-center">Enter Your email to recover your password.</p>
    @if (session("status"))
        <p class="alert alert-success">
            {{session("status")}}
        </p>
    @endif
    <form action="{{route('password.email')}}" method="post">
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

        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Email Password Reset Link</button>
    </form>
@endsection