<?php
    require_once("header.php");
    if($_SESSION['userrole'] != "Administrator")
    {
        ?>
        <script type="text/javascript">
            window.location.href = "./home";
        </script>
        <?php
    }
?>
        <script type="text/javascript">
            var user_id = <?php echo $_REQUEST["id"]; ?>;
        </script>
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
                <h4 class="title">Edit User</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row py-4 px-3 px-lg-5">
                                    <div class="col-lg-10 col-md-8 mt-4 mt-lg-0">
                                        <form class="form-horizontal px-2 px-lg-4">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group pr-2">
                                                        <label class="text-dark font-medium">First Name</label>
                                                        <input class="form-control" type="text" id="e_firstname" 
                                                            placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3 mt-md-0">
                                                    <div class="form-group pl-1">
                                                        <label class="text-dark font-medium">Last Name</label>
                                                        <input class="form-control" type="text" id="e_lastname" 
                                                            placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row mt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group pr-1">
                                                        <label class="text-dark font-medium">Username</label>
                                                        <input class="form-control" type="text" id="e_username" 
                                                            placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3 mt-md-0">
                                                    <div class="form-group pl-1">
                                                        <label class="text-dark font-medium">Email</label>
                                                        <input class="form-control" type="text" id="e_email" 
                                                            placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row mt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group pr-1">
                                                        <label class="text-dark font-medium">Password</label>
                                                        <input class="form-control" type="password" id="e_password" 
                                                            placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group pr-1">
                                                        <label class="text-dark font-medium">Confirm Password</label>
                                                        <input class="form-control" type="password" id="e_confirmpassword" 
                                                            placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row mt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group pr-1">
                                                        <label class="text-dark font-medium">User Role</label>
                                                        <select class="form-control" id="e_userrole">
                                                            <option>Administrator</option>
                                                            <option>Subscriber</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group pr-1">
                                                        <label class="text-dark font-medium">User Status</label>
                                                        <select class="form-control" id="e_userstatus">
                                                            <option>Approved</option>
                                                            <option>Pending</option>
                                                            <option>Deleted</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row mt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary" id="save_change">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row mt-3" style="height: 0">
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap tether Core JavaScript -->
            <script src="./assets/libs/popper.js/dist/umd/popper.min.js"></script>
            <script src="./assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- apps -->
            <script src="./dist/js/app.min.js"></script>
            <script src="./dist/js/app.init.js"></script>
            <script src="./dist/js/feather.min.js"></script>
            <!--Custom JavaScript -->
            <script src="./dist/js/custom.min.js"></script>
            <script src="./assets/user-edit.js"></script>
<?php
    require_once("footer.php");
?>