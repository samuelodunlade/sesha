@extends("layouts.shisha")

@section('hero_section')
    <div class="col-md-8 offset-md-2 text-center">
        <h1> SECRET SHARING PLATFORM  </h1>
        <P>We Listen but we dont judge</P>
        <a href="{{ route('shisha.create') }}" class="btn btn-primary"> Share  <i class="fa-solid fa-share"></i></a>
        <a href="{{ route('shisha.timeline') }}" class="btn btn-primary">Read <i class="fa-brands fa-readme"></i></a>
    </div>
@endsection

@section('content')
<div class="row">
    <!-- main -->
    <div class="col-md-8">
        {{-- shi Title --}}
        <div class="row">
            <div class="col text-center mb-3">
                <h2 class="main-h2"> Editor's Selected Shi </h2>
            </div>
        </div>
        <!-- all shi -->

        @foreach ($secrets as $secret)
            <x-single-secret :secret="$secret" />
        @endforeach
        
        {{ $secrets->links() }}
        




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
                {{-- categories list --}}
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


                


