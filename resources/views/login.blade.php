<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('admin/assets/images/favicon-32x32.png') }}" type="image/png">
    <!-- loader-->
    <link href="{{ asset('admin/assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('admin/assets/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/plugins/metismenu/mm-vertical.css') }}">
    <!--bootstrap css-->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="{{ asset('admin/assets/css/bootstrap-extended.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/ssass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/sass/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>

<body>

    <!--authentication-->
    <div class="auth-basic-wrapper d-flex align-items-center justify-content-center">
        <div class="container-fluid my-5 my-lg-0">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
                    <div
                        class="card rounded-4 mb-0 border-top border-bottom border-start border-end border-4 border-primary border-gradient-1">
                        <div class="card-body p-5">
                            <div class="text-center">
                                <img src="{{ asset('admin/assets/images/logo1.png') }}" class="mb-4" width="145"
                                    alt="">
                            </div>

                            {{-- <h4 class="fw-bold">Get Started Now</h4>
                            <p class="mb-0">Enter your credentials to login your account</p> --}}

                            <div class="form-body my-5">
                                <form class="row g-3" method="POST" action="">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputUserCode" class="form-label">User Code</label>
                                        <input type="text" name="code" class="form-control" id="inputUserCode"
                                            placeholder="Enter Your User Code">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0"
                                                id="inputChoosePassword" name="password" value="12345678"
                                                placeholder="Enter Password">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class="bi bi-eye-slash-fill"></i></a>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Remember
                                                Me</label>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-md-6 text-end"> <a href="auth-basic-forgot-password.html">Forgot
                                            Password ?</a>
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-dark">Login</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-start">
                                            <p class="mb-0">Don't have an account yet? <a href="{{ route('register') }}">Sign up
                                                    here</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </div>
    <!--authentication-->


    <!--plugins-->
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi-eye-slash-fill");
                    $('#show_hide_password i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                    $('#show_hide_password i').addClass("bi-eye-fill");
                }
            });
        });


        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;
                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;
                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

</body>

</html>
