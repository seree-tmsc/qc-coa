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
                        <div class="col-lg-6 col-lg-offset-3">                                                        
                            <div class="panel panel-primary" id="panel-header">
                                <div class="panel-heading">
                                    Criteria [ Code Group ]                                 
                                </div>

                                <div class="panel-body">
                                    
                                    <!--<form method="post" action="">-->
                                    <form method="post" action="pQuery_COA_QcCodeGroup_View.php" target='_blank'>
                                        </iframe>                                        
                                        <div class="form-group">
                                            <label for="title">Select Data:</label>
                                            <select name="codegroup" class="form-control" style="width:500px" required>
                                                <option value="">--- Select Code Group ---</option>

                                                <?php                        
                                                    require_once('include/db_Conn.php');

                                                    $strSql = "select [Code group] ";
                                                    $strSql .= "from COA_QcCodeGroup ";
                                                    $strSql .= "group by [Code group] ";
                                                    $strSql .= "order by [Code group] ";
                                                    echo $strSql . "<br>";

                                                    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                                                    $statement->execute();  
                                                    $nRecCount = $statement->rowCount();
                                                    //echo $nRecCount . " records <br>";
                                                        
                                                    if ($nRecCount >0)
                                                    {
                                                        while($ds = $statement->fetch(PDO::FETCH_NAMED))
                                                        {
                                                            echo "<option value='" . $ds['Code group'] . "'>" 
                                                            . $ds['Code group']
                                                            . "</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">      
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <button type="submit" style="float: right; margin:2px;" class="btn btn-success">
                                                    <span class="fa fa-search fa-lg">&nbsp&nbsp&nbspQuery</span>
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