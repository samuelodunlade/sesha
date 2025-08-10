@extends("layouts.admin_dash")




@section("content")
        <div class="row vh-50 pt-5">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"> Secrets Shared</p>
                        <h6 class="mb-0">{{$secrets}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Categories</p>
                        <h6 class="mb-0">{{ $categories }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Tags</p>
                        <h6 class="mb-0">{{ $tags }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Views</p>
                        <h6 class="mb-0">{{ $views }}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row vh-50 pt-5" style="height: 50vh;">
            <div class="col-md-6">

                <form action="{{ route('admin.categories.recalculate') }}" method="post">
                    @csrf
                    <label class="form-label"> Due to secrets expiring, do this once a day</label>
                    <button type="submit" class="btn btn-primary">Recalculate Category Secret Count</button>
                </form>
            </div>

        </div>   

@endsection