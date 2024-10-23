{{--  @extends('public.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5 mb-5">
                <div class="card-header">{{ __('Register') }} Panel</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  --}}


@extends('public.othermaster')

@section('header_css')
<link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
{{--  <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">  --}}
<link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/vendor/animate/animate.css">
{{--  <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/vendor/css-hamburgers/hamburgers.min.css">  --}}
<link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/vendor/animsition/css/animsition.min.css">
{{--  <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/vendor/select2/select2.min.css">  --}}
{{--  <link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/vendor/daterangepicker/daterangepicker.css">  --}}
<link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/css/util.css">
<link rel="stylesheet" type="text/css" href="{{url('/')}}/login_assets/css/main.css">
@endsection

@section('content')

<div class="limiter" style="margin-top: 30px">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url({{url('/')}}/login_assets/images/bg-01.jpg);">
                <span class="login100-form-title-1">
                    Sign Up
                </span>
            </div>

            <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                @honeypot
                @csrf

                <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                    <span class="label-input100" for="name">Name : </span>
                    <input id="name" type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter Your Name" style="border: none !important">
                    <span class="focus-input100"></span>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                    <span class="label-input100" for="email">Email : </span>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Your Email" style="border: none !important">
                    <span class="focus-input100"></span>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="wrap-input100 validate-input m-b-26" data-validate="Contact is required">
                    <span class="label-input100" for="contact">Contact : </span>
                    <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus placeholder="+8801000000000" style="border: none !important">
                    <span class="focus-input100"></span>
                    @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                    <span for="password" class="label-input100">Password</span>
                    <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="New  password" required autocomplete="new-password" style="border: none !important">
                    <span class="focus-input100"></span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="wrap-input100 validate-input m-b-18">
                    <span for="password-confirm" class="label-input100">Password</span>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password" style="border: none !important">
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        {{ __('Register') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('footer_js')
    <script src="{{url('/')}}/login_assets/vendor/animsition/js/animsition.min.js"></script>
    {{--  <script src="{{url('/')}}/login_assets/vendor/bootstrap/js/popper.js"></script>
    <script src="{{url('/')}}/login_assets/vendor/bootstrap/js/bootstrap.min.js"></script>  --}}
    {{--  <script src="{{url('/')}}/login_assets/vendor/select2/select2.min.js"></script>  --}}
    {{--  <script src="{{url('/')}}/login_assets/vendor/daterangepicker/moment.min.js"></script>  --}}
    {{--  <script src="{{url('/')}}/login_assets/vendor/daterangepicker/daterangepicker.js"></script>  --}}
    {{--  <script src="{{url('/')}}/login_assets/vendor/countdowntime/countdowntime.js"></script>  --}}
    <script src="{{url('/')}}/login_assets/js/main.js"></script>
@endsection
