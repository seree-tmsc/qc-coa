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
                                    QC Data Detail
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">                                        
<?php
                                        try
                                        {                                         
                                            require_once('include/db_Conn.php');
                                            $strSql = "SELECT * ";
                                            $strSql .= "FROM COA_QcDataHeader H ";
                                            $strSql .= "JOIN COA_MaterialData M  ON M.[Material Code] = H.Material ";
                                            $strSql .= "WHERE H.Material = '" . $_POST['material-ddl'] . "' ";
                                            $strSql .= "AND H.Customer = '" . $_POST['customer-ddl'] . "' ";
                                            $strSql .= "ORDER BY H.[Master insp charac] ";
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
                                                            <label>Material-Code:</label>
                                                            <p class="form-control" disabled><?php echo $ds['Material'];?></p>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Material-Code:</label>
                                                            <p class="form-control" disabled><?php echo $ds['Material Name'];?></p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>Material-Name:</label>
                                                            <p class="form-control" disabled><?php echo $ds['Customer'];?></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label>Lot No.:</label>
                                                            <p class="form-control" disabled><?php echo $ds['Customer Name'];?></p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <!-- &nbsp -->
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover">
                                                                    <thead>
                                                                    <tr class="active">
                                                                        <th class='text-center'>MIC</th>
                                                                        <th class='text-center'>MIC-Description</th>
                                                                        <th class='text-center'>UOM</th>
                                                                        <th class='text-center'>L-Limit</th>
                                                                        <th class='text-center'>U-Limit</th>
                                                                        <th class='text-center'>Std.Spec.</th>
                                                                        <th class='text-center'>Method</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
<?php
                                                    }
?>                                                        
                                                    <tr>                                                    
                                                        <td><?php echo $ds["Master insp charac"];?></td>
                                                        <td><?php echo $ds["Short text"];?></td>
                                                        <td class='text-center'><?php echo $ds["Unit of measurement"];?></td>
                                                        <td class='text-center'><?php echo $ds["Lower Limit"];?></td>
                                                        <td class='text-center'><?php echo $ds["Upper Limit"];?></td>
                                                        <td class='text-center'><?php echo $ds["Qualitative MIC Specifications"];?></td>                                                        
                                                        <td class='text-center'><?php echo $ds["Method"];?></td>
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
                                                onclick ="javascript:window.location.href='pQuery_COA_QcDataHeader.php';return false;">
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