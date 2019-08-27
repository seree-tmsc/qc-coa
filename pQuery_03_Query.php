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
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1">
                            <div class="panel panel-info" id="panel-header">
                                <div class="panel-heading" align="center" style="color:navy">
                                    Material Movement Data By Material Doc.
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">
<?php
                                        try
                                        {
                                            require_once('include/db_Conn.php');
                                            $strSql = "SELECT * ";
                                            $strSql .= "FROM MB51 ";
                                            $strSql .= "WHERE material = '" . trim($_POST['param_mat_code']) . "' "; 
                                            $strSql .= "AND [material document] = '" . trim($_POST['param_mat_doc_no']) . "' ";
                                            //echo $strSql . "<br>";
                                    
                                            $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                                            $statement->execute();  
                                            $nRecCount = $statement->rowCount();
                                            //echo $nRecCount . " records <br>";
                                            $nCurRec = 0;
                                             
                                            if ($nRecCount >0)
                                            {                                                
                                                while ($ds = $statement->fetch(PDO::FETCH_NAMED))
                                                {
                                                    $nCurRec +=1;
                                                    if($nCurRec == 1)
                                                    {

                                                    }
                                                    
?>
                                                    <div class="col-lg-1">
                                                        <label>No.:</label>
                                                        <p class="form-control" disabled><?php echo $ds["Material Doc#Item"];?></p>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label>Material Doc No.:</label>
                                                        <p class="form-control" disabled><?php echo $ds["Material Document"];?></p>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>Posting Date:</label>
                                                        <p align="center" class="form-control" disabled><?php echo date('d / M / Y', strtotime($ds["Posting Date"]));?></p>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>Document Date:</label>
                                                        <p align="center" class="form-control" disabled><?php echo date('d / M / Y', strtotime($ds["Document Date"]));?></p>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>Entry Date:</label>
                                                        <p align="center" class="form-control" disabled><?php echo date('d / M / Y', strtotime($ds["Entry Date"]));?></p>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>Entry Time:</label>
                                                        <p align="center" class="form-control" disabled><?php echo date('H:m', strtotime($ds["Time of Entry"]));?></p>
                                                    </div>
                                                    
                                                    <div class="col-lg-1">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label>Material Code:</label>
                                                        <p class="form-control" disabled><?php echo $ds["Material"];?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>Material Description:</label>
                                                        <p class="form-control" disabled><?php echo substr($ds["Material Description"],0,40);?></p>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>Batch:</label>
                                                        <p align="center" class="form-control" disabled><?php echo $ds["Batch"];?></p>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>QTY:</label>
                                                        <p align="right" class="form-control" disabled><?php echo number_format($ds["Quantity"],0,'.',',');?></p>
                                                    </div>

                                                    <div class="col-lg-1">
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <label>M.Type:</label>
                                                        <p class="form-control" disabled><?php echo $ds["Movement Type"];?></p>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label>Movement Description:</label>
                                                        <p class="form-control" disabled><?php echo $ds["Movement Type Text"];?></p>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>Loc.:</label>
                                                        <p align="center" class="form-control" disabled><?php echo $ds["Storage Location"];?></p>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <label>Order:</label>
                                                        <p class="form-control" disabled><?php echo $ds["Order"];?></p>
                                                    </div>

                                                    <div class="col-lg-1">
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>PO:</label>
                                                        <p class="form-control" disabled><?php echo $ds["Purchase Order"];?></p>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>Vendor Code:</label>
                                                        <p class="form-control" disabled><?php echo $ds["Vendor"];?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>Vendor Name:</label>
                                                        <p class="form-control" disabled><?php //echo $ds["Vendor"];?></p>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label>Reference:</label>
                                                        <p class="form-control" disabled><?php echo $ds["Reference"];?></p>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <hr />
                                                        <br>
                                                    </div>
<?php                                                        
                                                }
                                            }
                                            else
                                            {
                                                echo "No data";
                                            }                                                
                                        }
                                        catch(PDOException $e)
                                        {        
                                            echo $e->getMessage();
                                        }
?>
                                                    <div class="col-lg-12">
                                                        <button type="cancel" style="float: right; margin:2px;" class="btn btn-danger" 
                                                            onclick ="javascript:window.location.href='pQuery_03.php';return false;">
                                                            <span class="fa fa-close fa-lg"></span> Close
                                                        </button>
                                                    </div>
                                    </div> <!--class="form-group" -->                                   
                                </div> <!-- class="panel-body" -->
                            </div> <!-- class="panel panel-info" -->
                        </div> <!-- class="col-lg-10 col-lg-offset-1" -->
                    </div>  <!-- class="row" -->
                </div> <!-- class="container" -->             
            </body>
        </html>
<?php
    }
?>