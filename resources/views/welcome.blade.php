<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Helpdesk App</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/welpg/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="assets/welpg/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="assets/welpg/css/agency.min.css" rel="stylesheet">

        <!-- Styles -->

    </head>
     <body id="page-top">

    <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">HelpDesk</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{ url('/home') }}">Home</a>
                                </li>
                                
                            @else
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link js-scroll-trigger" href="{{ route('register') }}">Register</a>
                                    </li>                     
                                @endif
                            @endauth
                             
                        @endif

                    </ul>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <header class="masthead">
            <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome To Our HelpDesk App!</div>
                <div class="intro-heading">If it's worth doing. It's worth automating.</div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#">Tell Me More</a>
            </div>
            </div>
        </header>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                <span class="copyright">Copyright &copy; Your Website {{date('Y')}}</span>
                </div>
                <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li class="list-inline-item">
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    </li>
                    <li class="list-inline-item">
                    <a href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    </li>
                    <li class="list-inline-item">
                    <a href="#">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    </li>
                </ul>
                </div>
                <div class="col-md-4">
                <ul class="list-inline quicklinks">
                {{-- <li class="list-inline-item">
                        <a href="#">Privacy Policy</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">Terms of Use</a>
                    </li> 
                --}}
                </ul>
                </div>
            </div>
            </div>
        </footer>



        <!-- Bootstrap core JavaScript -->
        <script src="assets/welpg/vendor/jquery/jquery.min.js"></script>
        <script src="assets/welpg/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="assets/welpg/vendor/jquery/easing/jquery.easing.min.js"></script>

        <!-- Contact form JavaScript -->
     
      

        <!-- Custom scripts for this template -->
        <script src="assets/js/agency.min.js"></script>

    </body>
</html>
