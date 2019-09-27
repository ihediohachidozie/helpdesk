@extends('layouts.app1')

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
                <div class="row w-100">
                    <div class="col-lg-6 mx-auto">
                        <div class="auto-form-wrapper">
                            <div class="text-success">{{ session('status') ? session('status'): ''}}</div>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="label">Email</label>
                                    <div class="input-group">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-email"></i>
                                            </span>
                                        </div>
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary submit-btn btn-block">Send Password Reset Link</button>
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
