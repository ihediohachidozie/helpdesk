<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.inc.header')
</head>
<body>
    <div id="app">
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            @include('layouts.inc.navbar')
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar.html -->
                @include('layouts.inc.sidebar')
                <!-- partial -->
                
                @yield('content')
                
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
              <!-- Logout Modal-->
            @include('layouts.inc.logout')
        </div>
    </div>
    <!-- container-scroller -->
    @include('layouts.inc.footer-script')
    <!-- End custom js for this page-->
</body>

</html>
