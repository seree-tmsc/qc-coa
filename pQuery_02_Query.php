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
                                    Inspection Result Data
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">
                                        <!--
                                        <div class="col-lg-3">
                                            <label>Material-Code:</label>
                                            <p class="form-control" disabled><?php //echo $_POST['param_mat_code']?></p>
                                        </div>
                                        <div class="col-lg-5">
                                            <label>Material-Name:</label>
                                            <p class="form-control" disabled><?php //echo $_POST['param_mat_name']?></p>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Lot-No.:</label>
                                            <p align="center" class="form-control" disabled><?php //echo $_POST['param_lot_no']?></p>
                                        </div>
                                        -->

                                        <div class="col-lg-6">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Inspection-Lot:</label>
                                            <p style ="color:red" class="form-control" disabled><?php echo $_POST['param_insp_lot']?></p>
                                        </div>
<?php
                                        try
                                        {
                                            require_once('include/db_Conn.php');
                                            $strSql = "SELECT * ";
                                            $strSql .= "FROM TRANS_Inspection_Result ";
                                            $strSql .= "WHERE [inspection lot] = '" . trim($_POST['param_insp_lot']) . "' ";
                                            $strSql .= "ORDER BY material, [material description], batch, [inspection lot quantity] DESC, [short text] ";
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
                                                        <div class="col-lg-3">
                                                            <label>Material Doc.</label>
                                                            <p style ="color:red" class="form-control" disabled><?php echo $ds['Material Document'];?></p>
                                                        </div>

                                                        <div class="col-lg-2">
                                                            <label>QC-Date:</label>
                                                            <p align="center" class="form-control" disabled><?php echo date('d / M / Y',strtotime($ds['Created on']));?></p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>Rece. / MFG Date:</label>
                                                            <p align="center" class="form-control" disabled><?php echo date('d / M / Y',strtotime($ds['Date of Manufacture']));?></p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>Expired-Date:</label>
                                                            <p align="center" class="form-control" disabled><?php echo date('d / M / Y',strtotime($ds['SLED/BBD']));?></p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>Shelf life (Cal.):</label>
                                                            <p align="center" class="form-control" disabled>
                                                                <?php
                                                                    $begin = date_create($ds['Date of Manufacture']);
                                                                    $end = date_create($ds['SLED/BBD']);
                                                                    $diff = date_diff($begin, $end);
                                                                    echo $diff->days . "<br>";
                                                                ?>                                                            
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>QC-Status:</label>
                                                            <p align="center" class="form-control" disabled><?php echo $ds['UD code'];?></p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>Inspection-QTY:</label>
                                                            <p align="right" class="form-control" disabled><?php echo number_format($ds['Inspection Lot Quantity'], 0, '.', ',');?></p>
                                                        </div>
                                                    
                                                        <div class="col-lg-12">
                                                            <br>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover">
                                                                    <thead>
                                                                    <tr class="active">
                                                                        <th style='width:20%'>Inspection Item</th>
                                                                        <th style='width:15%' class='text-right'>Lower-Limit</th>
                                                                        <th style='width:15%' class='text-right'>Upper-Limit</th>
                                                                        <th style='width:15%' class='text-center'>UOM</th>
                                                                        <th style='width:10%' class='text-right'>Result</th>
                                                                        <th style='width:25%' class='text-center'>Method</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
<?php
                                                    }
?>                                                        
                                                    <tr>
                                                        <td><?php echo $ds["Short text"];?></td>
                                                        <td class='text-right'><?php echo $ds["Lower limit"];?></td>
                                                        <td class='text-right'><?php echo $ds["Upper limit"];?></td>
                                                        <td class='text-center'><?php echo $ds["Uom"];?></td>
                                                        <td class='text-right'><?php echo $ds["Original Value"];?></td>
                                                        <td class='text-center'><?php echo $ds["InfoField2"];?></td>
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
                                        <div class="col-lg-12">
                                            <button type="cancel" style="float: right; margin:2px;" class="btn btn-danger" 
                                                onclick ="javascript:window.location.href='pQuery_02.php';return false;">
                                                <span class="fa fa-close fa-lg"></span> Close
                                            </button>
                                        </div>
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