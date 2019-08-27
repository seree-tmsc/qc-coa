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
                <!-- Bootstrap -->
                <!--
                <link rel="stylesheet" href="../../vendors/bootstrap-3.3.7-dist/css/bootstrap.min.css">
                <script src="../../vendors/jquery-3.2.1/jquery-3.2.1.min.js"></script>
                <script src="../../vendors/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
                -->

                <!-- awesom icon -->
                <!--
                <link rel="stylesheet" href="../../vendors/font-awesome-4.7.0/css/font-awesome.min.css">
                -->

                <!-- my -->
                <!--
                <link rel="stylesheet" href="../../vendors/my/css/my.css">
                <script src="../../vendors/my/js/my.js" type="text/javascript"></script>
                -->

                <!-- DataTables -->
                <!--
                <link rel="stylesheet" href="../../vendors/DataTables/datatables.css">
                <script src="../../vendors/DataTables/datatables.js"></script>
                -->
                <?php require_once("library_pMA_Material_Master.php"); ?>
            </head>

            <body>                
                <div class="container">
                    <br>                    
                    <?php require_once("include/submenu_navbar.php"); ?> 

                    <!-- Content Section -->
                    <div class="row">
                        <div class="col-md-12">
                            <!--<p></p>-->
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-inline">                    
                                <div class="pull-right">
                                    <button class="btn btn-success btn-insert" data-toggle="modal" data-target="#insert_modal">
                                        <span class="glyphicon glyphicon-plus"></span> 
                                        Insert
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <p></p>
                            <?php include "pMA_Material_Master_List.php"; ?>
                        </div>
                    </div>
                </div>

                <!-- Modal - View Record -->
                <?php include "pMA_Material_Master_View_Modal.php"; ?>
            
                <!-- Modal - Insert Record -->
                <?php include "pMA_Material_Master_Insert_Modal.php"; ?>
            </body>
        </html>
<?php
    }
?>