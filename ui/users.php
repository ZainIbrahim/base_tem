<?php

include "sidebar.php";
include "header.php";

?>

    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h5 class="card-title mb-0">
                                Users Management
                                <button class="btn btn-success float-right" id="Insert">
                                <i class="fas fa-plus-circle"></i>
                                Add
                            </button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tbl_users">
                                    <thead>
                                    <td style="font-weight: bolder;">ID</td>
                                            <td style="font-weight: bolder;">Image</td>
                                            <td style="font-weight: bolder;">Full Name</td>
                                            <td style="font-weight: bolder;">User Name</td>
                                            <td style="font-weight: bolder;">Email</td>
                                            <td style="font-weight: bolder;">User Status</td>
                                            <td style="font-weight: bolder;">User Type</td>
                                            <td style="font-weight: bolder;">Date</td>
                                            <td class="action" style="font-weight: bolder;">Action</td>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal" id="mdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">New message</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" id="frm_users">
                                    <div class="form-group">
                                        <label for="user_name" class="control-label">User Name:</label>
                                        <input type="hidden" id="user_id" name="user_id">
                                        <input type="hidden" id="session_id" name="session_id" value="<?php echo $_SESSION['user_id']; ?>">
                                        <input type="hidden" id="type" name="session_id" value="<?php echo $_SESSION['type']; ?>">
                                        <input type="text" class="form-control" id="user_name" name="user_name" required placeholder="User Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
                                    </div>
                                    <div class="form-group" id="row">
    
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="emp" class="control-label">Full name:</label>
                                                <input type="text" class="form-control" id="full_name" name="full_name" required placeholder="Full Name">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="user_status" class="control-label">User Status:</label>
                                                <select name="user_status" id="user_status" class=" form-control" title="Select User Status" required>
                                                                <option value="0">Please Select Status</option>
                                                                <option value="active">Active</option>
                                                                <option value="disabled">Disabled</option>
                                                            </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="user_type" class="control-label">User Status:</label>
                                                <select name="user_type" id="user_type" class=" form-control" title="Select User Type" required>
                                                               
                                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" id="date" name="date" class=" form-control" required value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="submit" name="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Save</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal" id="mdl_image" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update The Image.</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" id="img_update_frm" enctype="multipart/form-data">
                                    <input type="hidden" id="id" name="id">
                                    <input type="file" id="file" name="file" class="dropify" required />


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
    <?php

include "footer.php";

?>

        <script src="../scripts/users.js"></script>