<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield("title", 'SeSha: We listen, we dont judge')</title>
    <link rel="stylesheet" href="{{asset('/assets/fontawesome-free-6.6.0-web/css/all.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/assets/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/main.css')}}">
</head>
<body>

    <!--  navbar -->
        <section class="nav_area">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                  <a class="navbar-brand" href="#">SESHA  <i class="fa-solid fa-face-meh-blank"></i></a>
                  <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="hamburger-icon">
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                      </li>
                      {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Shi By Category
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Love and Relationship</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Crime</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Office and Job</a></li>
                        </ul>
                      </li> --}}
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('shisha.create') }}">Drop Shi</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('shisha.timeline') }}"> Sesha Timeline </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('shisha.terms') }}">Terms</a>  
                      </li>
                    </ul>
                  </div>
                </div>
            </nav>
              
        </section>
    <!-- navbar ends -->
    <!-- hero starts -->
        <section class="hero">
            <div class="container-fluid mycont"> 
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center">
                        @yield("hero_section")
                    </div>
                </div>
            </div>
        </section>
    <!-- hero ends -->
    <!-- main area -->
        <section class="main">
            <div class="container">
                @yield("content")
            </div>
        </section>
    <!-- main area ends-->

    <!-- footer section -->
        <section class="footer">
            <div class="container">
                <div class="row myrow">   
                    <div class="col-md-4">
                       <div class="footerbox">
                            <h4> About Us </h4>
                            <p>Sesha is a public forum that allows users to share anonymous messages or "secrets" without requiring authentication.</p>
                       </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footerbox">
                            <h4> Terms </h4>
                            <p>Sesha is a public forum that allows users to share anonymous messages or "secrets" without requiring authentication. The platform is intended for open expression, entertainment, and emotional release, not for harm, abuse, or targeting others. You can read more  <a href="{{ route('shisha.terms') }}">Here</a>  </p>
                       </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footerbox">
                            <h4> Links </h4>
                            <a href="/">Home</a>
                            <br>
                            <a href=""> Timeline </a>
                            <br>
                            <a href="">Drop sesha</a>
                       </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-center mt-5">
                        <h6>
                            &copy; 2025 <span id="year"></span> SeSha. All rights reserved. 
                            <a href="{{ route('shisha.terms') }}">Terms of Use</a> | <a href="{{ route('shisha.policy') }}">Privacy Policy</a>    
                        </h6>
                    </div>
                </div>
            </div>
        </section>
    <!-- footer section ends -->
    {{-- privacy modal --}}
    <!-- Privacy Consent Modal -->
      <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content shadow-lg rounded">
            <div class="modal-header">
              <h5 class="modal-title" id="privacyModalLabel">Privacy Notice</h5>
            </div>
            <div class="modal-body">
              <p>Welcome to <strong>Sesha</strong>.</p>
              <p>To help us keep the platform safe, fair, and free from abuse, we may store your IP address temporarily. This helps us limit spam, prevent over-posting and voting manipulation.</p>
              <p>We do <strong>not</strong> ask for your name or email, and we do <strong>not</strong> share your data with advertisers or third parties.</p>
              <p>By continuing to use Sesha, you agree to our <a href="/terms" target="_blank">Terms</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a>.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Decline</button>
              <button type="button" class="btn btn-primary" id="acceptPrivacy">Accept & Continue</button>
            </div>
          </div>
        </div>
      </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        if (!localStorage.getItem("seshaPrivacyAccepted")) {
          const privacyModal = new bootstrap.Modal(document.getElementById("privacyModal"));
          privacyModal.show();

          document.getElementById("acceptPrivacy").addEventListener("click", function () {
            localStorage.setItem("seshaPrivacyAccepted", "true");
            privacyModal.hide();
          });
        }
      });

    </script>
    <script src="{{asset('/assets/js/jquery.js')}}"></script>
    <script src="{{asset('/assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/assets/js/main.js')}}"></script>
</body>
</html>