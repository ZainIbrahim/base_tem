<?php
session_start();

if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
}

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
        <meta name="author" content="Bootlab">

        <title>Base|System</title>

        <link rel="preconnect" href="http://fonts.gstatic.com/" crossorigin>

        <!-- PICK ONE OF THE STYLES BELOW -->
        <link href="../assets/css/classic.css" rel="stylesheet">
        <link href="../assets/toastr/toastr.min.css" rel="stylesheet">
          <!-- file_uploads -->
        <link rel="stylesheet" href="../assets/dropify/dropify.min.css" />
        <link rel="stylesheet" href="../assets/jquery-file-upload/jquery.uploadfile.min.css" />
        <link rel="stylesheet" href="../assets/jquery-tags-input/jquery.tagsinput.min.css" />
        <!-- <link href="css/corporate.css" rel="stylesheet"> -->
        <!-- <link href="../assets/css/modern.css" rel="stylesheet"> -->

        <!-- BEGIN SETTINGS -->
        <!-- You can remove this after picking a style -->
        <style>
            body {
                opacity: 0;
            }
        </style>
        <!-- <script src="../assets/js/settings.js"></script> -->
        <!-- END SETTINGS -->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-6"></script> -->
        <!-- <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-120946860-6');
</script> -->
    </head>

    <body>
        <div class="wrapper">
            <nav id="sidebar" class="sidebar" >
                <div class="sidebar-content ">
                    <a class="sidebar-brand" href="index">
                        <i class="align-middle" data-feather="box"></i>
                        <b class="align-middle">Base System</b>
                    </a>

                    <ul class="sidebar-nav">
                        <li class="sidebar-item" id="sidbarnav">



                            <!-- <li class="sidebar-item">
                                <a href="#supplier" data-toggle="collapse" class="sidebar-link collapsed">
                                    <i class="fas fa-industry text-white"></i> <span class="align-middle">Supplier</span>
                                </a>
                                <ul id="supplier" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                                    <li class="sidebar-item"><a class="sidebar-link" href="supplier.php">Manage Supplier</a>
                                    </li>
                                    <li class="sidebar-item"><a class="sidebar-link" href="supplier_payment.php">Supplier
									Payment</a></li>
                                    <li class="sidebar-item"><a class="sidebar-link" href="supplier_payments.php">Supplier
											Payments</a></li>
                                </ul>

                            </li>  -->


                    </ul>

                </div>
            </nav>