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
                                    Criteria [ Query Material Movement Data By Material Doc. ]                                 
                                </div>

                                <div class="panel-body">
                                    <form method="post" action="pQuery_03_Query.php">
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <label>Please select material code :</label>
                                                <?php require_once("dtl_material_list_all.php")?>                                                
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Mat-Code:</label>
                                                <p id="var1" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_mat_code" name="param_mat_code">
                                            </div>
                                            <div class="col-lg-8">
                                                <label>Mat-Name:</label>
                                                <p id="var2" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_mat_name" name="param_mat_name">
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Material Document:</label>
                                                <input type="text" class="form-control" name="param_mat_doc_no">                                                
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