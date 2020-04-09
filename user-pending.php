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
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <h4 class="title d-block d-md-flex align-items-end">
                    Pending Users
                    <div class="ml-auto mt-2 mt-md-0">
                        <div class="dropdown mega-dropdown pending-users-filter">
                            <button class="btn btn-custom no-background checkbox-action" type="button" info="save">
                                Save
                            </button>
                            <button class="btn btn-custom no-background checkbox-action" type="button" info="edit">
                                Edit
                            </button>
                            <button class="btn btn-custom no-background checkbox-action" type="button" info="approve">
                                Approve
                            </button>
                            <button class="btn btn-custom no-background checkbox-action" type="button" info="delete">
                                Delete
                            </button>
                            <select class="custom-select font-16 auto-width page-rowcount" id="pending-users-rowcount" title="Rows on page">
                                <option value="10">Results (10)</option>
                                <option value="25">Results (25)</option>
                                <option value="50">Results (50)</option>
                                <option value="100">Results (100)</option>
                            </select>
                            <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                                Advance Filter
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <form class="filter-form">
                                    <div class="condition-rows">
                                        <div class="form-row">
                                            <div class="col-md-3">
                                                <select class="custom-select filter-include">
                                                    <option selected>Include</option>
                                                    <option>Exclude</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mt-2 mt-md-0">
                                                <select class="custom-select filter-item">
                                                    <option value="user_role" selected>Role</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mt-2 mt-md-0">
                                                <select class="custom-select filter-group">
                                                    <option selected>Administrator</option>
                                                    <option>Subscriber</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row pt-3">
                                        <div class="col-12">
                                            <a href="#" class="font-normal add-condition"><i class="mr-2"
                                                    data-feather="plus-circle"></i> Add
                                                Condition</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="col-12">
                                            <button class="btn btn-primary mr-1 filter-apply">Apply</button>
                                            <button class="btn btn-outline-primary filter-clear">Clear</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive pending-users">
                            <table class="table table-borderless v-middle no-wrap">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-medium">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="checkbox_header">
                                                <label class="custom-control-label text-dark" for="checkbox_header"></label>
                                            </div>
                                        </th>
                                        <th class="font-medium desc" info="user_login">Username<i class="fa fa-angle-down"></i></th>
                                        <th class="font-medium desc" info="user_firstname">First Name<i class="fa fa-angle-down"></i></th>
                                        <th class="font-medium desc" info="user_lastname">Last Name<i class="fa fa-angle-down"></i></th>
                                        <th class="font-medium desc" info="user_email">Email<i class="fa fa-angle-down"></i></th>
                                        <th class="font-medium desc" info="user_role">Role<i class="fa fa-angle-down"></i></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <p class="pending-users-nomessage">There is no pending user available at the moment.</p>
                    </div>
                </div>
            </div>
            <div style="display: none;" id="usertable-dropbox">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle link" href="#" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i data-feather="more-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" action="edit-row" href="#"><i class="mr-2"
                                data-feather="edit"></i>Edit User</a>
                        <a class="dropdown-item" action="approve-user" href="#"><i class="mr-2"
                                data-feather="check-circle"></i>Approve User</a>
                        <a class="dropdown-item" action="delete-user" href="#"><i class="mr-2"
                                data-feather="delete"></i>Delete User</a>
                    </div>
                </div>
            </div>
            <div style="display: none;" id="usertable-dropbox-editsave">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle link" href="#" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i data-feather="more-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" action="save-edit" href="#"><i class="mr-2"
                                data-feather="check-circle"></i>Save</a>
                        <a class="dropdown-item" action="cancel-edit" href="#"><i class="mr-2"
                                data-feather="delete"></i>Cancel</a>
                    </div>
                </div>
            </div>
            <div style="display: none;" id="usertable-filtercondition">
                <div class="form-row">
                    <div class="col-md-3">
                        <select class="custom-select filter-include">
                            <option selected>Include</option>
                            <option>Exclude</option>
                        </select>
                    </div>
                    <div class="col-md-3 mt-2 mt-md-0">
                        <select class="custom-select filter-item">
                            <option value="user_role" selected>Role</option>
                        </select>
                    </div>
                    <div class="col-md-3 mt-2 mt-md-0">
                        <select class="custom-select filter-group">
                            <option selected>Administrator</option>
                            <option>Subscriber</option>
                        </select>
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
            <script src="./assets/user-function.js"></script>
            <script src="./assets/user-pending.js"></script>
<?php
    require_once("footer.php");
?>