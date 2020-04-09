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
                <h4 class="title">
                    <div class="row" style="display: flex; align-items: center;">
                        <div class="col-md-3">
                            <select class="form-control" id="searchby">
                                <option value="state">Search by State</option>
                                <option value="city">Search by City</option>
                                <option value="zipcode">Search by Zip Code</option>
                            </select>
                        </div>
                        <div class="col-md-6 searchable_widget">
                            <div id="searchby_state">
                                <select data-placeholder="Choose a State..." id="region_list" style="width:350px;" tabindex="1">
                                    <option value=""></option>
                                </select>       
                            </div>
                            <div id="searchby_city">
                                <select data-placeholder="Choose a City..." id="state_list" style="width:350px;" tabindex="2">
                                    <option value=""></option>
                                </select>    
                            </div>
                            <div id="searchby_zipcode" style="display: none;">
                                <input class="form-control" type="text" id="zipcode" placeholder="Input Zip Code and press Enter." style="width:350px;" tabindex="3">    
                            </div>
                        </div>  
                    </div>  
                </h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive" style="max-height: 800px; overflow-y: auto;">
                            <table class="table table-borderless v-middle no-wrap" id="sp_table">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-medium">No</th>
                                        <th class="font-medium">Name</th>
                                        <th class="font-medium">Level</th>
                                        <th class="font-medium">Address</th>
                                        <th class="font-medium">Phone</th>
                                        <th class="font-medium">Fax</th>
                                        <th class="font-medium">Email</th>
                                        <th class="font-medium">Note</th>
                                        <th class="font-medium">Sales Manager</th>
                                        <th class="font-medium">Map Color</th>
                                <?php 
                                    if($_SESSION["userrole"] == "Administrator") 
                                        echo '<th class="font-medium"></th>'; 
                                ?>        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
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

            <script src="./assets/libs/simplemaps/mapdata.js"></script>
            <script src="./assets/libs/simplemaps/countymap.js"></script>
            <link rel="stylesheet" href="./assets/libs/chosen/chosen.css">
            <script type='text/javascript' src='./assets/libs/chosen/chosen.jquery.min.js'></script>
            <script src="./assets/index.js"></script>
<?php
    require_once("footer.php");
?>