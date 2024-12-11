<?php

include "sidebar.php";
include "header.php";

?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Receipt Voucher</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Receipt Voucher</h5>
                    </div>
                    <div class="card-body">
                        <div id="print_voucher">
                            <div id="original_voucher">
                                <div style="text-align: center;">
                                        <img width="80%" src="../assets/img/header_logo.png" alt="Receipt Voucher">
                                        <h2 style="font-weight: bold; text-align: center;">
                                            Receipt Voucher
                                        </h2>
                                </div>
                                <div>
                                    <span>
                                        <span style="font-weight: bold;">Voucher:</span>
                                        <span id="voucher"></span>
                                    </span>
                                    <span style="float:right">
                                        <span style="font-weight: bold;">Date:</span>
                                        <span id="date"></span>
                                    </span>
                                </div>
                                <br>
                                <table width="100%" border="1" cellspacing="0" cellpadding="5px">
                                    <tr>
                                        <th width="30%">Customer</th>
                                        <th colspan="2" id="customers" ></th>
                                    </tr>
                                    <tr>
                                        <th width="30%">Project</th>
                                        <th colspan="2" id="projects"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Description</th>
                                        <th width="40%">Amount</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" id="description"></th>
                                        <th id="amount"></th>
                                    </tr>
                                </table>
                                <br>
                                <p>
                                    <span><b>NB:</b> All Receipts are not refundable</span>
                                    <span style="float: right"><b>Cashier:</b> ___________________</span>
                                </p>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div id="copy_voucher">

                            </div>
                        </div>
                        <button type="button" id="print" class="btn btn-primary">Print</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<?php

include "footer.php";

?>

<script src="../script/receipt_voucher.js">
    </script>