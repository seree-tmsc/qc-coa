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
                                    Sales Data
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">                                        
<?php
                                        try
                                        {                                         
                                            require_once('include/db_Conn.php');
                                            $strSql = "SELECT * ";
                                            $strSql .= "FROM COA_SalesData ";
                                            $strSql .= "WHERE [Invoice No] = '" . $_POST['invoice_no'] . "' ";                                            
                                            $strSql .= "ORDER BY [Invoice Line Item No] ";
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
?>                                                                                                                
                                                        <div class="col-lg-2">
                                                            <label>Invoice No.:</label>
                                                            <p class="form-control" disabled><?php echo $ds['Invoice No'];?></p>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Customer PO No.:</label>
                                                            <p class="form-control" disabled><?php echo $ds['Customer purchase order number'];?></p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>Customer Code:</label>
                                                            <p class="form-control" disabled><?php echo $ds['Bill-to Party'];?></p>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <label>Customer Name:</label>
                                                            <p class="form-control" disabled><?php echo $ds['Bill-to Name'];?></p>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover">
                                                                    <thead>
                                                                    <tr class="active">                                                                        
                                                                        <th class='text-center'>Item No.</th>
                                                                        <th class='text-center'>Material</th>
                                                                        <th class='text-center'>Material Description</th>
                                                                        <th class='text-right'>Quantity</th>                                                                        
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
<?php
                                                    }
?>                                                        
                                                    <tr>                                                        
                                                        <td class='text-center'><?php echo $ds["Invoice Line Item No"];?></td>
                                                        <td><?php echo $ds["Material"];?></td>
                                                        <td><?php echo $ds["Material Description"];?></td>                                                        
                                                        <td class='text-right'><?php echo number_format($ds["Quantity"], 0, '.', ',');?></td>                                                        
                                                    </tr>
<?php                                                        
                                                }
                                                echo "</tbody>";
                                                echo "</table>";
                                                echo "</div>";
                                                echo "</div>";
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
                                        <!--
                                        <div class="col-lg-12">
                                            <button type="cancel" style="float: right; margin:2px;" class="btn btn-danger" 
                                                onclick ="javascript:window.location.href='pQuery_COA_SalesData.php';return false;">
                                                <span class="fa fa-close fa-lg"></span> Close
                                            </button>
                                        </div>
                                        -->
                                    </div>                                    
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