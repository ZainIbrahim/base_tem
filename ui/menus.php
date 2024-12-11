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
                                Menus Management
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
                                        <tr>
                                            <td style="font-weight: bolder">ID</td>
                                            <td style="font-weight: bolder">Menu Name</td>
                                            <td style="font-weight: bolder">Icon Name</td>
                                            <td style="font-weight: bolder">User Name</td>
                                            <td style="font-weight: bolder">Date</td>
                                            <td style="font-weight: bolder">Action</td>
                                        </tr>
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

    <div class="modal fade" id="mdl" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New / Edit Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="frm">
                        <div class="form-group">
                            <label for="name" class="control-label">Menu Name:</label>
                            <input type="hidden" id="menu_id" name="menu_id">
                            <input type="hidden" id="session_id" name="session_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="icon" class="control-label">Menu Icon:</label>
                            <input type="text" class="form-control" id="icon" name="icon" required>
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

            </form>
        </div>
    </div>

    <?php

include "footer.php";

?>

        <script src="../scripts/menus.js"></script>