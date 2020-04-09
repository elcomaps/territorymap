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
    <script src="./assets/register.js"></script>
    <link href="./assets/style.css" rel="stylesheet">
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
                <div class="register-form-panel d-flex justify-content-center align-items-center">
                    <form class="form-horizontal" id="loginform">
                        <div class="d-flex justify-content-center mb-5">
                            <img src="./assets/images/logo.png" alt="icon" style="max-width: 150px;">
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-dark font-medium w-100">First Name</label>
                                    <input class="form-control" type="text" placeholder="Enter your first name" id="register-firstname">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Please enter your first name to continue.</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-dark font-medium w-100">Last Name</label>
                                    <input class="form-control" type="text" placeholder="Enter your last name" id="register-lastname">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Please enter your last name to continue.</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-dark font-medium w-100">Username</label>
                                    <input class="form-control" type="text" placeholder="Enter your user name" id="register-username">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Please enter your username to continue.</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-dark font-medium w-100">Email</label>
                                    <input class="form-control" type="email" placeholder="Enter your email address" id="register-email">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Please enter a valid email address.</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-dark font-medium w-100">Password</label>
                                    <input class="form-control" type="password" placeholder="Enter password" id="register-password">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Please enter your password to continue.</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="text-dark font-medium w-100">Confirm Password</label>
                                    <input class="form-control" type="password" placeholder="Enter Password Again" id="register-confirmpassword">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Please enter your password to continue.</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-block btn-primary" type="button" id="register_btn">Register</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <p class="mb-0 text-dark text-center">Already have an account? <a
                                            class="font-medium" href="login">Login</a></p>
                                </div>
                            </div>
                        </div>
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
                    </form>
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