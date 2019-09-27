@extends('layouts.app')

@section('content')
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-6 mx-auto">
              <h2 class="text-center mb-4">Reset Password</h2>
              <div class="auto-form-wrapper">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
   
                    <div class="form-group">
                        <label class="label">Email</label>
                        <div class="input-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Password</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                            <div class="text-danger">{{ $errors->first('password') }}</div>
                        </div>
                    </div>
                  <div class="form-group">
                    <label class="label ">Confirm Password</label>
                    <div class="input-group">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary submit-btn btn-block">Reset Password</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection
