<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
        <style type="text/css">
            body {
                margin-top: 20px;
                background: #e9e9e9;
            }

            .account-block {
                padding: 0;
                background-image: url('assets/img/logo.png');
                background-repeat: no-repeat;
                background-size: contain;
                background-position: center;
                height: 100%;
                position: relative;
            }

            .account-block .overlay {
                -webkit-box-flex: 1;
                -ms-flex: 1;
                flex: 1;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
            }

            .account-block .account-testimonial {
                text-align: center;
                color: #fff;
                position: absolute;
                margin: 0 auto;
                padding: 0 1.75rem;
                bottom: 3rem;
                left: 0;
                right: 0;
            }

            .text-theme {
                color: #f36a20 !important;
                text-decoration: none;
            }

            .btn-theme {
                background-color: #f36a20;
                border-color: #f36a20;
                color: #fff;
            }

            .btn-theme:hover {
                border-color: #f36a20;
                color: #f36a20;
            }
        </style>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>

    <body>
        <div id="main-wrapper" class="container">
            <div class="row justify-content-center align-items-center mb-5">
                <div class="col-xl-10">
                    <div class="card border-0">
                        <div class="card-body p-0">
                            <div class="row no-gutters">
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="mb-5">
                                            <h3 class="h4 font-weight-bold text-theme"><strong>Login</strong></h3>
                                        </div>

                                        <h6 class="h5 mb-0">Welcome back!</h6>
                                        <p class="text-muted mt-2 mb-5">Enter your email and password to access
                                            user dashboard.</p>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            @error('email')
                                            <div class="alert alert-danger" role="alert">
                                                <i class="fa fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <div class="form-group mb-3">
                                                <label for="email">Email</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                                    name="email" required autocomplete="email" value="{{old('email')}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="password">Password</label>
                                                <input type="password"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="password" name="password" required autocomplete="new-password">
                                                <a class="text-primary text-theme"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="g-recaptcha"
                                                    data-sitekey="6Lc3GYkjAAAAAEBgvmhODNpabheQabmB3eNb4IYQ"
                                                    data-callback="enableBtn"></div>
                                            </div>
                                            <button type="submit" id="btnSubmit" class="btn btn-theme"
                                                disabled>Login</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-lg-6 d-none d-lg-inline-block" style="background-color: #f36a20;">
                                    <div class="account-block rounded-right">
                                        <div class="overlay rounded-right"></div>
                                        <div class="account-testimonial">
                                            {{-- <h4 class="text-white mb-4">~ Gadget Store ~</h4> --}}
                                            <p class="lead text-white">~ Mi Ayam Goreng Enak Tenan ~</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <p class="text-center mt-3 mb-0">Don't have an account? <a href="{{route('register')}}"
                            class="text-primary ml-1 text-theme"><strong>Register</strong></a></p>

                    <!-- end row -->
                </div>
                <!-- end col -->
            </div>
            <!-- Row -->
        </div>

        <script src="plugins/jquery/jquery.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>
        <script>
            function enableBtn(){
                document.getElementById("btnSubmit").disabled = false;
            }
        </script>
    </body>

</html>