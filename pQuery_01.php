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
                <title>TMSC Print Package Status Label v.0.1</title>

                <?php require_once("include/library.php"); ?>    
            </head>

            <body>                
                <div class="container">
                    <br>                    
                    <?php require_once("include/submenu_navbar.php"); ?>

                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">                                                        
                            <div class="panel panel-primary" id="panel-header">
                                <div class="panel-heading">
                                    Criteria [ Query Inspection Lot Data ]                                 
                                </div>

                                <div class="panel-body">
                                    <form method="post" action="pQuery_01_Query.php">
                                        <input type="hidden" name="param_email" value="<?php echo $_SESSION['ses_email'];?>">                                        

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <label>Please select material code :</label>
                                                <?php require_once("dtl_inspection_list_all.php")?>                                                
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <label>Mat-Code:</label>
                                                <p id="var1" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_mat_code" name="param_mat_code">
                                            </div>
                                            <div class="col-lg-5">
                                                <label>Mat-Name:</label>
                                                <p id="var2" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_mat_name" name="param_mat_name">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Lot-No.:</label>
                                                <p id="var3" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_lot_no" name="param_lot_no">                                                
                                            </div>

                                            <div class="col-lg-12">
                                                <button type="submit" style="float: right; margin:2px;" class="btn btn-success">
                                                    <span class="fa fa-check fa-lg">&nbsp&nbspOK</span>
                                                </button>
                                                <!--
                                                <button type="cancel" style="float: right; margin:2px;" class="btn btn-danger" 
                                                    onclick ="javascript:window.location.href='pMain.php';return false;">
                                                    <span class="fa fa-close fa-lg"></span> Cancel
                                                </button>
                                                -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 

                </div>                
            </body>
        </html>
<?php
    }
?>