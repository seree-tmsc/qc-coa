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
                                            //echo $_POST['matandlot'] . "<br>";
                                            /*
                                            $nPosition = strpos($_POST['matandlot'],'/',0);
                                            $cMaterial = substr($_POST['matandlot'], 0, $nPosition);
                                            $cLot = substr($_POST['matandlot'], $nPosition+1, strlen($_POST['matandlot']));
                                            */
                                         
                                            require_once('include/db_Conn.php');
                                            $strSql = "SELECT * ";
                                            $strSql .= "FROM COA_QcDataDetail ";                                            
                                            $strSql .= "WHERE Material = '" . $_POST['material-ddl'] . "' ";
                                            $strSql .= "AND [Batch] = '" . $_POST['lot-ddl'] . "' ";
                                            $strSql .= "ORDER BY [Short text for the characteristic] ";
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
                                                        <div class="col-lg-5">
                                                            <label>Material-Name:</label>
                                                            <p class="form-control" disabled><?php echo $ds['Material Description'];?></p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>Lot No.:</label>
                                                            <p class="form-control" align="center" disabled><?php echo $ds['Batch'];?></p>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>UD Status:</label>
                                                            <p class="form-control" align="center" disabled><?php echo $ds['UD code'];?></p>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Inspection Date:</label>
                                                            <p class="form-control" align="center" disabled><?php echo date('d / F / Y', strtotime($ds['Created on']));?></p>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Manuf. Date: / Rec. Date:</label>
                                                            <p class="form-control" align="center" disabled><?php echo date('d / F / Y', strtotime($ds['Date of Manufacture']));?></p>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Expired Date:</label>
                                                            <p class="form-control" align="center" disabled><?php echo date('d/ F / Y', strtotime($ds['SLED/BBD']));?></p>                                                            
                                                        </div>
                                                        <div class="col-lg-12">
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover">
                                                                    <thead>
                                                                    <tr class="active">
                                                                        <th style='width:30%' class='text-center'>Short Text</th>
                                                                        <th style='width:10%' class='text-center'>L-Limit</th>
                                                                        <th style='width:10%' class='text-center'>U-Limit</th>
                                                                        <th style='width:10%' class='text-center'>Result</th>                                                                        
                                                                        <th style='width:25%' class='text-center'>InfoField2</th>
                                                                        <th style='width:15%' class='text-center'>Inspection Lot</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
<?php
                                                    }
?>                                                        
                                                    <tr>
                                                        <td><?php echo $ds["Short text for the characteristic"];?></td>
                                                        <td class='text-center'><?php echo $ds["Lower tolerance limit"];?></td>
                                                        <td class='text-center'><?php echo $ds["Upper tol  limit"];?></td>
                                                        <td class='text-center'><?php echo $ds["Original Value"];?></td>                                                        
                                                        <td><?php echo $ds["InfoField2"];?></td>
                                                        <td class='text-center'><?php echo $ds["Inspection Lot"];?></td>
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
                                                onclick ="javascript:window.location.href='pQuery_COA_QcDataDetail.php';return false;">
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