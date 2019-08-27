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
                        <div class="col-lg-6 col-lg-offset-3">                                                        
                            <div class="panel panel-primary" id="panel-header">
                                <div class="panel-heading">
                                    Criteria [ Query Inspection Result By Inspection Lot. ]                                 
                                </div>

                                <div class="panel-body">
                                    <form method="post" action="pQuery_02_Query.php">
                                        <input type="hidden" name="param_email" value="<?php echo $_SESSION['ses_email'];?>">                                        

                                        <div class="form-group">
                                            <div class="col-lg-6">
                                                <label>Inspection Lot.:</label>
                                                <input type="text" class="form-control" name="param_insp_lot">                                                
                                            </div>

                                            <div class="col-lg-12">
                                                <button type="submit" style="float: right; margin:2px;" class="btn btn-success">
                                                    <span class="fa fa-check fa-lg">&nbsp&nbspOK</span>
                                                </button>
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