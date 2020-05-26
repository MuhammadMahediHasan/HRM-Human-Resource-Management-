<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up | HRM360</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('login_asset/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('login_asset/css/style.css')}}">
</head>
<body>

    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-logo">
                    <img src="{{asset('backend_asset/logo.png')}}">
                </div>
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{asset('login_asset/images/hrm360login.png')}}" alt="sing up image"></figure>
                        <!-- <a href="#" class="signup-image-link">Create an account</a> -->
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form method="POST" class="register-form" id="login-form" action="{{ route('login') }}">
                          @csrf
                            <div class="form-group">
                                <label for="your_name">&nbsp;<i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input id="email" type="email" class="@error('email') is-invalid @enderror login-username" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus="true" id="your_name">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label for="your_pass">&nbsp;<i class="zmdi zmdi-lock"></i></label>

                                <input type="password" id="password your_pass" class="login-password @error('password') is-invalid @enderror" required="true" placeholder="Password" name="password" autocomplete="current-password" placeholder="Password"/>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="checkbox" name="remember" id="remember-me" class="agree-term" {{ old('remember') ? 'checked' : '' }}/>
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>

                        <div class="social-login">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{asset('/login_asset/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/login_asset/js/main.js')}}"></script>
</body>
</html>

