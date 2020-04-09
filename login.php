<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Territory Map</title>
    <!-- Custom CSS -->
    <link href="./dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/toastr/toastr.min.js"></script>
    <link href="./assets/libs/toastr/toastr.min.css" rel="stylesheet">
    <script src="./assets/global.js"></script>
    <script src="./assets/login.js"></script>
    <link href="./assets/style.css" rel="stylesheet">
    <style type="text/css">
        .active
        {
          display: block !important;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <section id="wrapper" class="new-login-register">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="login-form-panel d-flex justify-content-center align-items-center">
                    <form class="form-horizontal active" id="loginform">
                        <div class="d-flex justify-content-center mb-5">
                            <img src="./assets/images/logo.png" alt="icon" style="max-width: 150px;">
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-dark font-medium w-100">Username</label>
                                    <input class="form-control" type="text" placeholder="Enter Username" id="login-username">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Please enter your username to continue.</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-dark font-medium w-100">
                                        Password
                                        <!-- <a href="javascript:void(0)" id="to-recover" class="text-muted font-normal float-right">Forgot Password?</a> -->
                                    </label>
                                    <input class="form-control" type="password" placeholder="Enter Password" id="login-password">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Please enter your password to continue.</span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label text-dark" for="customCheck1">Remember
                                            Me</label>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-block btn-primary" type="button">Login</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <p class="mb-0 text-dark text-center">Don't have an account? <a class="font-medium"
                                            href="register">Register</a></p>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- <form class="form-horizontal" id="forgot-modal">
                        <div class="mb-5">
                            <h3>Forgot Password?</h3>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-dark font-medium w-100">Please send me your email address.</label>
                                    <input class="form-control" type="text" placeholder="Enter email address" id="forgot-email">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Invalid email address.</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-block btn-primary send" type="button">Send</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-block btn-primary back-btn" type="button">Back</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" id="forgot-second-modal">
                        <div class="mb-5">
                            <h3>Forgot Password?</h3>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-dark font-medium w-100">Verify Code</label>
                                    <input class="form-control" type="text" placeholder="Enter verify code" id="verifycode-input">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Please enter verify code received via email</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-dark font-medium w-100">Password</label>
                                    <input class="form-control" id="password-input" type="password">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Please enter password</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-dark font-medium w-100">Confirm password</label>
                                    <input class="form-control" id="password-input2" type="password">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Please enter confirm password</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-block btn-primary change" type="button">Change</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-block btn-primary back-btn" type="button">Back</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <p class="copytext">
                                        You have received verify code on your E-Mail. Type that code above and change your password. If there is another problem, Please contact us.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form> -->
                    <div class="form-row" style="height: 0">
                        <div id="alert-box" class="warning" style="display: none;">
                            <div class="alert-type-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="alert-main-body">
                                <h5 class="alert-title">Title here</p>
                                <h6 class="alert-content">Content here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $(".preloader").fadeOut();
    </script>
</body>

</html>