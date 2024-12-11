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
                                Users Privillage
                            </button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" id="frm">
                                <div class="form-group mb-5">
                                    <div class="col-md-6">
                                        <select class=" form-control" id="user_id" name="user_id" required title="Select User">

                                </select>
                                    </div>
                                </div>


                                <div class=" table table-responsive table-borderless">
                                    <table class="table" id="tbl">
                                        <thead>


                                        </thead>

                                        <tbody>
                                            <!-- <tr>
                                            <i class="fas fa-home"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>Dashboard</label></tr><br>

                                        </tr>
                                        <tr>
                                            <div class="custom-control custom-checkbox ml-5 mt-3">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">Dashboard</label>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="custom-control custom-checkbox mt-3" style="margin-left: 100px;">
                                                <input type="checkbox" class="custom-control-input" id="check">
                                                <label class="custom-control-label" for="check">Users</label>
                                            </div>
                                        </tr>
                                        <tr>
                                            <hr class=" border-bottom mb-5">
                                        </tr> -->


                                        </tbody>
                                    </table>

                                </div>
                                <div class="card-footer">
                                    <div class="col-md-4">
                                        <button type="submit" id="submit" name="submit" class=" form-control btn btn-primary">Grant Priviledge</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>


    <?php

include "footer.php";

?>

        <script src="../scripts/user_priv.js"></script>