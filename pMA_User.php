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
        if($user_user_type == "A")
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
                <?php require_once("include/library_pMA_User.php"); ?>
            </head>

            <body>                
                <div class="container">
                    <br>
                    <?php require_once("include/submenu_navbar.php"); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-inline">
                                Search : 
                                <input type="text" class="form-control" id="myInput" onkeyup="Func_Search(0)" placeholder="Search by user code.." title="Type user code">
                        
                                <div class="pull-right">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#insert_modal">
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
                            <!--<h5>User Data:</h5>-->
                            <?php include "pMA_User_list.php"; ?>
                        </div>
                    </div>
                </div>

                <!-- Modal - View Record -->
                <?php include "pMA_User_view_modal.php"; ?>
            
                <!-- Modal - Insert Record -->
                <?php include "pMA_User_insert_modal.php"; ?>
            </body>
        </html>
<?php
        }
        else
        {
            echo "<script> alert('You are not authorization for this menu ... Please contact your administrator!'); window.location.href='pMain.php'; </script>";
        }
    }
?>