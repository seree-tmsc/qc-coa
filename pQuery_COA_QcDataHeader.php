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
                                    Criteria [ Query QC Data Header ]                                 
                                </div>

                                <div class="panel-body">
                                    
                                    <!--<form method="post" action="">-->
                                    <form method="post" action="pQuery_COA_QcDataHeader_View.php" target='_blank'>
                                        </iframe>
                                        <!------------------------------->
                                        <!-- Dropdownlist Customer Code-->
                                        <!------------------------------->
                                        <div class="form-group">
                                            <label for="title">Select Customer:</label>
                                            <select name="customer-ddl" class="form-control" style="width:500px" required>
                                                <option value="">--- Select Customer ---</option>

                                                <?php                        
                                                    require_once('include/db_Conn.php');

                                                    $strSql = "SELECT DISTINCT Customer, [Customer Name] ";
                                                    $strSql .= "FROM COA_QcDataHeader ";                                                                                                    
                                                    $strSql .= "ORDER BY Customer ";
                                                    //echo $strSql . "<br>";
                                                    
                                                    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                                                    $statement->execute();  
                                                    $nRecCount = $statement->rowCount();
                                                    //echo $nRecCount . " records <br>";
                                                        
                                                    if ($nRecCount >0)
                                                    {
                                                        while($ds = $statement->fetch(PDO::FETCH_NAMED))
                                                        {
                                                            echo "<option value='" . $ds['Customer'] . "'>" . $ds['Customer Name'] . ' [ ' . $ds['Customer'] . " ] </option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <!--------------------------->
                                        <!-- Dropdownlist Material -->
                                        <!--------------------------->
                                        <div class="form-group">
                                            <label for="title">Select Lo No.:</label>
                                            <select name="material-ddl" class="form-control" style="width:500px">
                                            <option value="">--- Select Lot No. ---</option>
                                            </select>
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
                <script>
                    $( "select[name='customer-ddl']" ).click(function ()
                    {    
                        var customerCode = $(this).val();
                        console.log(customerCode);

                        if(customerCode)
                        {
                            $.ajax({
                                url: "ajaxBrowseMatFromQcDataHeader.php",
                                dataType: 'Json',
                                data: {'id1':customerCode},                            
                                success: function(data) 
                                {
                                    $('select[name="material-ddl"]').empty();
                                    $.each(data, function(key, value) 
                                    {
                                        $('select[name="material-ddl"]').append('<option value="'+ key +'">'+ value +'</option>');
                                    });
                                }
                            });
                        }
                        else
                        {
                            $('select[name="marterial-ddl"]').empty();
                        }
                    });                
                </script>
            </body>
        </html>
<?php
    }
?>