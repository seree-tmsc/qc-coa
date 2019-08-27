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

            <body>
                <div class="container">
                    <br>
                    <?php require_once("include/submenu_navbar.php"); ?>

                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="panel panel-primary" id="panel-header">
                                <div class="panel-heading">
                                    Criteria [ Upload QC Data Detail (ZPQM_R0001_INSPRES) ]
                                </div>

                                <div class="panel-body">
                                    <form method="post" action="pUpload_QcDetail_Data_Main.php" enctype="multipart/form-data">
                                        <input type="hidden" name="param_email" value="<?php echo $_SESSION['ses_email'];?>">
                                        <div class="form-group">
                                            <label>Please select file (*.csv):</label>
                                            <input type="file" accept=".xls,.xlsx,.csv" required class="form-control" name="param_fileCSV" id="input_filename">
                                        </div>
                                        <button type="submit" style="float: right; margin:2px;" class="btn btn-success">
                                            <span class="fa fa-check fa-lg">&nbsp&nbspOK</span>
                                        </button>                                        
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