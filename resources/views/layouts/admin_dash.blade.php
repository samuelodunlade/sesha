<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sesha Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Sesha Admin" name="keywords">
    <meta content="Sesha Admin" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('/admin/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('/admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/css/main.css')}}" rel="stylesheet">
    <style>
        .text-primary{
            color: #a3b1f0 !important;
        }
    </style>

</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-5"></i>Sesha</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        {{-- if there is no profile image show default else show profile image --}}
                        @if(auth()->user()->display_picture)
                            <img class="rounded-circle" src="{{ asset('storage/' . auth()->user()->display_picture) }}" alt="" style="width: 40px; height: 40px; object-fit: cover;">
                        @else
                        <img class="rounded-circle" src="/admin/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        
                        @endif

                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                       
                        
                    </div>
                    <div class="ms-3">
                        {{-- break auth()->user()->name into two part using space and display first parts --}}
                       
                        
                        <h6 class="mb-0">Welcome  {{ str_contains(auth()->user()->name, ' ') ? $nameParts = explode(' ', auth()->user()->name)[0] : $nameParts = auth()->user()->name }}</h6>
                        <span>{{auth()->user()->role}} </span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{route('dashboard')}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="/admin/categories" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Categories</a>
                    <a href="/admin/secrets" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Secrets</a>
                    <a href="{{ route('admin.tags.index') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tags</a>
                    <a href="{{ route('admin.dashboard.records') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Records</a>
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item active">Blank Page</a>
                        </div>
                    </div> --}} 
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars" style="color:whitesmoke;"></i>
                </a>
                {{-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form> --}}
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="/admin/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex" >Notification
                                
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="badge bg-danger rounded-pill ms-2">{{auth()->user()->unreadNotifications->count()}}</span>
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                            <a class="dropdown-item" href="{{ $notification->data['link'] }}">
                                <strong>{{ $notification->data['title'] }}</strong>
                                <p class="fw-normal mb-0">{{ $notification->data['message'] }}</p>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </a>
                            <hr class="dropdown-divider">
                            @empty
                            <span class="dropdown-item">No new notifications</span>
                            @endforelse
                            
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                             @if(auth()->user()->display_picture)
                            <img class="rounded-circle" src="{{ asset('storage/' . auth()->user()->display_picture) }}" alt="" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                            <img class="rounded-circle" src="/admin/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            
                            @endif
                            <span class="d-none d-lg-inline-flex"> {{ str_contains(auth()->user()->name, ' ') ? $nameParts = explode(' ', auth()->user()->name)[0] : $nameParts = auth()->user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{ route('admin.profile.show') }}" class="dropdown-item">My Profile</a>
                            {{-- <a href="#" class="dropdown-item">Settings</a> --}}
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                @yield("content")
            </div>
            <!-- Blank End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="/" style="color: #a3b1f0">Sesha </a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end " style="color:transparent;">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com" style="color:transparent;">HTML Codex</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" style="color:black;background:#a3b1f0;border:none;"><i class="bi bi-arrow-up"></i></a>
    </div>
    @yield("scripts")
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/admin/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('/admin/lib/waypoints/waypoints.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('/admin/js/main.js')}}"></script>
</body>

</html>