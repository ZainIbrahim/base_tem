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
                                Actions Management
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
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>Page</td>
                                        <td>User Name</td>
                                        <td>Date</td>
                                        <td class="action">Action</td>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="frm">
                        <div class="form-group">
                            <label for="name" class="control-label">Action Name:</label>
                            <input type="hidden" id="action_id" name="action_id">
                            <input type="hidden" id="session_id" name="session_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <select name="username" id="name" class=" form-control" title="Select User Name" required>
                            <option value="0">Please Select Action</option>
                            <option value="View">View</option>
                            <option value="Insert">Insert</option>
                            <option value="Update">Update</option>
                            <option value="Delete">Delete</option>
                            <option value="Print">Print</option>
                            <option value="PDF">PDF</option>
                            <option value="Excel >Excel</option>   
                                    <option value=" Generate">Generate</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="username" class="control-label">Page</label>
                            <select name="username" id="sub_id" class=" form-control" title="Select User Name" required>

                        </select>
                        </div>
                        <!-- <div class="table-responsive">
                                <table class="table table-striped" id="tbl_check">
                                    <thead>
                                        <td>
                                        <input type="checkbox"  name="sub_menus[]" id="` + item['sub_id'] + `" value="` + item['sub_id'] + `"  menu_id="` + item['menu_id'] + `">
                                        <label  for="check">View</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox"  name="sub_menus[]" id="` + item['sub_id'] + `" value="` + item['sub_id'] + `"  menu_id="` + item['menu_id'] + `">
                                        <label  for="check">Insert</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox"  name="sub_menus[]" id="` + item['sub_id'] + `" value="` + item['sub_id'] + `"  menu_id="` + item['menu_id'] + `">
                                        <label  for="check">Update</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox"  name="sub_menus[]" id="` + item['sub_id'] + `" value="` + item['sub_id'] + `"  menu_id="` + item['menu_id'] + `">
                                        <label  for="check">Delete</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox"  name="sub_menus[]" id="` + item['sub_id'] + `" value="` + item['sub_id'] + `"  menu_id="` + item['menu_id'] + `">
                                        <label  for="check">Print</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox"  name="sub_menus[]" id="` + item['sub_id'] + `" value="` + item['sub_id'] + `"  menu_id="` + item['menu_id'] + `">
                                        <label  for="check">Export</label>
                                        </td>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div> -->
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

        <script src="../scripts/actions.js"></script>