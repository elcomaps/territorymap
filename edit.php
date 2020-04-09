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
            var sp_id = <?php echo $_REQUEST["id"]; ?>;
        </script>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="max-width: 1600px;">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <h4 class="title">Edit</h4>
                <div class="row">
                    <div class="col-md-6" style="max-width: 650px;">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal px-2 px-lg-4">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group pr-1">
                                                <label class="text-dark font-medium">Name</label>
                                                <input class="form-control" type="text" id="sp_name" 
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3 mt-md-0">
                                            <div class="form-group pl-1">
                                                <label class="text-dark font-medium">Level</label>
                                                <select class="form-control" id="sp_level">
                                                    <option>Distributor</option>
                                                    <option>Showroom</option>
                                                    <option>Sales Manager</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group pr-1">
                                                <label class="text-dark font-medium">Phone</label>
                                                <input class="form-control" type="text" id="sp_phone" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3 mt-md-0">
                                            <div class="form-group pl-1">
                                                <label class="text-dark font-medium">Address</label>
                                                <input class="form-control" type="text" id="sp_address" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group pr-1">
                                                <label class="text-dark font-medium">Fax</label>
                                                <input class="form-control" type="text" id="sp_fax" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3 mt-md-0">
                                            <div class="form-group pl-1">
                                                <label class="text-dark font-medium">Email</label>
                                                <input class="form-control" type="text" id="sp_email" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group pr-1">
                                                <label class="text-dark font-medium">Note</label>
                                                <input class="form-control" type="text" id="sp_note" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3 mt-md-0">
                                            <div class="form-group pl-1" style="display: none;">
                                                <label class="text-dark font-medium">Sales Manager</label>
                                                <select class="form-control" id="sp_manager">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type='text' id="sp_color"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary" id="sp_save">Save Changes</button>
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
                    <div class="col-md-6">
                        <div id="map">
                            
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

            <script src="./assets/libs/simplemaps/mapdata.js"></script>
            <script src="./assets/libs/simplemaps/countymap.js"></script>
            <script src="./assets/libs/simplemaps/select.js"></script>
            <link rel="stylesheet" media="screen" type="text/css" href="./assets/libs/spectrum/spectrum.css" />
            <script type="text/javascript" src="./assets/libs/spectrum/spectrum.js"></script>
            <script src="./assets/sp_edit.js"></script>
<?php
    require_once("footer.php");
?>