@extends('layouts.app1')

@section('content')
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-6 mx-auto">
              <div class="auto-form-wrapper">
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group">
                    <label class="label">Username</label>
                    <div class="input-group">
                      <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-account-key"></i>
                        </span>
                      </div>
                      
                    </div>
                    <div class="text-danger">{{ $errors->first('username') }}</div>
                  </div>
                  <div class="form-group">
                    <label class="label">Password</label>
                    <div class="input-group">
                      <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-lock"></i>
                        </span>
                      </div>
                    </div>
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary submit-btn btn-block">Login</button>
                  </div>
                  <div class="form-group d-flex justify-content-between">
                    <div class="form-check form-check-flat mt-0">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Keep me signed in </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-small forgot-password text-black">Forgot Password</a>
                  </div>
                  <div class="form-group">
                  <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">Not a member ?</span>
                    <a href="{{ route('register') }}" class="text-black text-small">Create new account</a>
                  </div>
                </form>
              </div>
              
            </div>
             <p class="text-white text-center pt-3">copyright © {{ now()->year}}. All rights reserved.</p>
          </div>
          
        </div>
        <!-- content-wrapper ends -->
      </div>
      
      <!-- page-body-wrapper ends -->
    </div>
@endsection
