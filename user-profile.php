<?php
    require_once("header.php");
?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <h4 class="title">Settings</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row py-4 px-3 px-lg-5">
                                    <div class="col-lg-2 col-md-4">
                                        <div class="text-center">
                                            <div>
                                                <img src="./assets/images/users/<?php echo $_SESSION['usericon']; ?>" width="150"
                                                    class="rounded-circle user-photo" alt="user" />
                                            </div>
                                            <div class="upload-btn-wrapper">
                                                <button class="btn btn-primary mt-4">Change Picture</button>
                                                <input type="file" class="upload" accept="image/*" name="usericon" id="settings-box-picture-change">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-8 mt-4 mt-lg-0">
                                        <form class="form-horizontal px-2 px-lg-4">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group pr-2">
                                                        <label class="text-dark font-medium">Username</label>
                                                        <input class="form-control" type="text" id="settings-username" 
                                                            placeholder="Enter your name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3 mt-md-0">
                                                    <div class="form-group pl-1">
                                                        <label class="text-dark font-medium">Email</label>
                                                        <input class="form-control" type="text" id="settings-email" 
                                                            placeholder="Enter email address">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group pr-2">
                                                        <label class="text-dark font-medium">First Name</label>
                                                        <input class="form-control" type="text" id="settings-firstname" 
                                                            placeholder="Enter your first name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3 mt-md-0">
                                                    <div class="form-group pl-1">
                                                        <label class="text-dark font-medium">Last Name</label>
                                                        <input class="form-control" type="text" id="settings-lastname" 
                                                            placeholder="Enter your last name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row mt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group pr-1">
                                                        <label class="text-dark font-medium">New Password</label>
                                                        <input class="form-control" type="password" id="settings-newpassword" 
                                                            placeholder="Enter new password">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3 mt-md-0">
                                                    <div class="form-group pl-1">
                                                        <label class="text-dark font-medium">Confirm
                                                            Password</label>
                                                        <input class="form-control" type="password" id="settings-confirmpassword" 
                                                            placeholder="Confirm new password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row mt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group pr-1">
                                                        <label class="text-dark font-medium">Old Password</label>
                                                        <input class="form-control" type="password" id="settings-oldpassword" 
                                                            placeholder="Enter old password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary" id="user-update">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="alert-box" class="warning" style="display: none;">
                                                <div class="alert-type-icon">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="alert-main-body">
                                                    <h5 class="alert-title">Title here</p>
                                                    <h6 class="alert-content">Content here</p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Bootstrap tether Core JavaScript -->
            <script src="./assets/libs/popper.js/dist/umd/popper.min.js"></script>
            <script src="./assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- apps -->
            <script src="./dist/js/app.min.js"></script>
            <script src="./dist/js/app.init.js"></script>
            <script src="./dist/js/feather.min.js"></script>
            <!--Custom JavaScript -->
            <script src="./dist/js/custom.min.js"></script>
            <script src="./assets/profile.js"></script>
<?php
    require_once("footer.php");
?>