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
                                    Inspection Lot Data.
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-lg-4">
                                            <label>Mat-Code:</label>
                                            <p class="form-control" disabled><?php echo $_POST['param_mat_code']?></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Mat-Name:</label>
                                            <p class="form-control" disabled><?php echo $_POST['param_mat_name']?></p>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Lot-No.:</label>
                                            <p align="center" class="form-control" disabled><?php echo $_POST['param_lot_no']?></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
<?php
                                        try
                                        {
                                            require_once('include/db_Conn.php');
                                            $strSql = "SELECT * ";
                                            $strSql .= "FROM TRANS_Inspection_Result ";
                                            $strSql .= "WHERE material = '" . trim($_POST['param_mat_code']) . "' "; 
                                            $strSql .= "AND batch = '" . trim($_POST['param_lot_no']) . "' ";
                                            $strSql .= "AND [inspection lot quantity] > 0 ";
                                            $strSql .= "ORDER BY [inspection lot]";
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
                                                        <div class="col-lg-12">
                                                            <br>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover">
                                                                    <thead>
                                                                    <tr class="active">
                                                                        <th >Inspection-Lot</th>
                                                                        <th >Created-On</th>
                                                                        <th >Mat.-Doc.</th>
                                                                        <th >Order</th>
                                                                        <th >Movement-Type</th>
                                                                        <th >Date-of-Manufacture</th>
                                                                        <th >SLED-BBD</th>
                                                                        <th >Quantity</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
<?php
                                                    }
?>                                                        
                                                                        <tr>
                                                                            <td><?php echo $ds["Inspection Lot"];?></td>
                                                                            <td><?php echo date('d/M/Y', strtotime($ds["Created on"]));?></td>
                                                                            <td class='text-center'><?php echo $ds["Material Document"];?></td>                                                                            
                                                                            <td><?php echo $ds["Order"];?></td>
                                                                            <td class='text-center'><?php echo $ds["Movement Type"];?></td>
                                                                            <td class='text-center'><?php echo date('d/M/Y', strtotime($ds["Date of Manufacture"]));?></td>
                                                                            <td class='text-center'><?php echo date('d/M/Y', strtotime($ds["SLED/BBD"]));?></td>
                                                                            <td class='text-right'><?php echo number_format($ds["Inspection Lot Quantity"],0,'.',',');?></td>
                                                                        </tr>
<?php                                                        
                                                }
?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
<?php
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
                                                                onclick ="javascript:window.location.href='pQuery_01.php';return false;">
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