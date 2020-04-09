<?php
    require_once("header.php");
?>
        <script type="text/javascript">
            var user_role = '<?php echo $_SESSION["userrole"] ?>';
        </script>
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            
            <div class="container-fluid">
                <h4 class="title">Users</h4>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" style="width:100%" id="user_table">
                            <thead>
                                <tr>
                                    <th class="font-medium">No</th>
                                    <th class="font-medium">Name</th>
                                    <th class="font-medium">Role</th>
                                    <th class="font-medium">Email</th>
                                    <th class="font-medium">Status</th>
                                    <th class="font-medium"></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
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

            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
            <script src="./assets/user-list.js"></script>
<?php
    require_once("footer.php");
?>