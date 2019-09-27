<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layouts.inc.header')
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
          <div class="row flex-grow">
            <div class="col-lg-7 mx-auto text-white">
              <div class="row align-items-center d-flex flex-row">
                <div class="col-lg-6 text-lg-right pr-lg-4">
                  <h1 class="display-1 mb-0">404</h1>
                </div>
                <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                  <h2>Customer Survey</h2>
                  
                </div>
              </div>
              <div class="row mt-5">
                <div class="col-12 text-center mt-xl-2">
                  <h4 class="font-weight-light">How do you rate our IT helpdesk service?</h4>
                  <form method="POST" action="{{ route('survey.store')}}" class="mt-2">
                    @csrf
                    <div class="form-group">
                      <div class="form-check-inline">
                          <label class="form-check-label" for="radio1">
                              <input type="radio" class="form-check-input" id="radio1" name="satisfaction" value="0" checked>Terrible
                          </label>
                      </div>
                      <div class="form-check-inline">
                          <label class="form-check-label" for="radio2">
                              <input type="radio" class="form-check-input" id="radio2" name="satisfaction" value="1">Bad</label>
                      </div>
                      <div class="form-check-inline">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" id="radio3" name="satisfaction" value="2">Okay</label>
                      </div>
                      <div class="form-check-inline">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" id="radio3" name="satisfaction" value="3">Good</label>
                      </div>
                      <div class="form-check-inline">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" id="radio3" name="satisfaction" value="4">Great </label>
                      </div>
                    </div>
                      <div class="form-group">
                        <textarea class="form-control" id="exampleTextarea1" name="comment" rows="2" placeholder="Comment..."></textarea>
                      </div>
                      <button type="submit" class="btn btn-success mr-2">Submit</button>
                  </form>
                </div>
              </div>
              <div class="row mt-5">
                <div class="col-12 mt-xl-2">
                  <p class="text-white font-weight-medium text-center">Copyright &copy; {{ now()->year}} All rights reserved.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="../assets/js/shared/off-canvas.js"></script>
    <script src="../assets/js/shared/misc.js"></script>
    <!-- endinject -->
  </body>
</html>