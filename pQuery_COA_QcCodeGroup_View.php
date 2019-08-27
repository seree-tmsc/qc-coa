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
                        <div class="col-lg-6 col-lg-offset-3">
                            <div class="panel panel-info" id="panel-header">
                                <div class="panel-heading" align="center" style="color:navy">
                                    Code Group
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">                                        
<?php
                                        try
                                        {
                                            require_once('include/db_Conn.php');
                                            $strSql = "SELECT * ";
                                            $strSql .= "FROM COA_QcCodeGroup ";
                                            $strSql .= "WHERE [Code group] = '" . $_POST['codegroup'] . "' ";
                                            $strSql .= "ORDER BY Code ";
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
                                                        <div class="col-lg-8">
                                                            &nbsp
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label>Code Groupo:</label>
                                                            <p class="form-control" disabled><?php echo $ds['Code group'];?></p>
                                                        </div>                                                    
                                                        
                                                        <div class="col-lg-12">
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover" id="myTableQcCodeGroup">
                                                                    <thead>
                                                                    <tr class="active">                                                                        
                                                                        <th class='text-center'>Code</th>
                                                                        <th class='text-center'>Shot Text</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
<?php
                                                    }
?>                                                        
                                                    <tr>
                                                        <td class='text-center'><?php echo $ds["Code"];?></td>
                                                        <td><?php echo $ds["Short text for code"];?></td>                                                      
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
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>

                <script type="text/javascript">
                    $(document).ready(function(){
                        //alert("Initial Jquery");
                        $("#myTableQcCodeGroup").dataTable();
                    });
                </script>
            </body>
        </html>
<?php
    }
?>