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
                                submenus Management
                                <button class="btn btn-success float-right" id="Insert">
                                <i class="fas fa-plus-circle"></i>
                                Add
                            </button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tbl">
                                    <thead>
                                        <td style="font-weight: bolder;">ID</td>
                                        <td style="font-weight: bolder;">Sub Menu Name</td>
                                        <td style="font-weight: bolder;">Sub Menu link </td>
                                        <td style="font-weight: bolder;">Sub Menu Name</td>
                                        <td style="font-weight: bolder;">Created User</td>
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
                    <form action="" method="POST" id="frm">
                        <div class="form-group">
                            <label for="name" class="control-label">Name:</label>
                            <input type="hidden" id="sub_id" name="sub_id">
                            <input type="hidden" id="session_id" name="session_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="link" class="control-label">Link:</label>
                            <input type="text" class="form-control" id="link" name="link" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="control-label">Menu Name:</label>
                            <select name="username" id="menu_id" class=" form-control" title="Select User Name" required>
                                                          
                                    </select>
                        </div>
                        <div class="form-group">
                            <input type="date" id="date" name="date" class=" form-control" required value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php

include "footer.php";

?>

        <script src="../scripts/submenus.js"></script>