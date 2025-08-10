@extends("layouts.shisha")


@section("title", "Shisha: Start Sharing Secrets")


@section("hero_section")
    <h1> START SHARING SHI  </h1>
    <P>Pour out all your heart out, like no one is watching, <br> <small>Remember we listen, we dont judge</small></P>
    <a href="#" class="btn btn-primary">Read <i class="fa-brands fa-readme"></i></a>
@endsection


@section("content")
    <div class="row">
        <div class="col-md-8">
            <livewire:create-secret />
        </div>

        <div class="col-md-4">
            <div class="px-3">
                <ul class="list-group">
                    <li class="list-group-item pry-bg alt-text" aria-current="true">Remember Our Rules</li>
                    <li class="list-group-item">No mentioning of names</li>
                    <li class="list-group-item">No description of someone</li>
                    <li class="list-group-item">We reserve the right to delete any content</li>
                </ul>
            </div>
        </div>
    </div>
@endsection