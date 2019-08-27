<?php
    include_once('include/chk_Session.php');
    if($user_email == "")
    {
        echo "<script> 
                alert('Warning! Please Login!'); 
                window.location.href='login.php'; 
            </script>";
    }
    else
    {
?>        
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>COA for Thai Kansai [v.1.0]</title>
                <link rel="icon" href="images/tmsc-logo-128.png" type="image/x-icon" />
                <link rel="shortcut icon" href="images/tmsc-logo-128.png" type="image/x-icon" />

                <?php require_once("include/library.php"); ?>    
            </head>
            
            <!--<body style='background-color:black;'>-->
            <body>
                <!-- Begin Body page -->
                <div class="container">
                    <br>
                    <!-- Begin Static navbar -->
                    <?php require_once("include/submenu_navbar.php"); ?>
                    <!-- End Static navbar -->

                    <!-- Begin content page-->
                    <div class="row">
                        <div class="col-lg-12 col-lg-offset-0 showStatus">
                            <?php
                                $param_inspectionDataMode='delete';
                                require_once("status_of_upload_COA_QcDataDetail.php"); 
                            ?>
                        </div>
                    </div>

                    <!-- End content page -->
                </div>
                <!-- End Body page -->

                <!-- Logout Modal-->
                <?php require_once("include/modal_logout.php"); ?>

                <!-- Change Password Modal-->
                <?php require_once("include/modal_chgpassword.php"); ?>

                <!-- Upload Modal-->
                <?php require_once("include/modal_upload_customer.php"); ?>

                <script>
                    $(document).ready(function(){
                        /*
                        $('#myTable_COA_QcDataDetail').dataTable({
                            "columnDefs": [ { type: 'date', 'targets': [0] } ],
                            "order": [[ 0, 'desc' ]],
                            "pageLength": 25
                        });
                        */
                        $('#myTable_COA_QcDataDetail').dataTable({
                            "columnDefs": [ { type: 'text', 'targets': [2] }, { type: 'date', 'targets': [0] }  ],
                            "order": [[ 2, 'asc' ], [ 0, 'desc' ]],
                            "pageLength": 25
                        });
                    });
                </script>
            </body>
        </html>
<?php
    }
?>