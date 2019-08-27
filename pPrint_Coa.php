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
        if($user_user_type == "A" or $user_user_type == "P")
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
                                    Criteria [ Print COA For Thai Kansai ]                                 
                                </div>

                                <div class="panel-body">
                                    <form method="post" action="pPrint_Coa_Report.php" target="_blank">
                                        <!-------------------------->
                                        <!-- Dropdownlist Invoice -->
                                        <!-------------------------->
                                        <div class="form-group">
                                            <label for="title">Select Invoice No.:</label>
                                            <select name="invoice-ddl" class="form-control" style="width:500px">
                                                <option value="">--- Select Invoice No. ---</option>

                                                <?php                        
                                                    require_once('include/db_Conn.php');

                                                    $strSql = "SELECT [Invoice No], [Bill-to Party], [Bill-to Name] ";
                                                    $strSql .= "FROM COA_SalesData ";
                                                    $strSql .= "GROUP BY [Invoice No], [Bill-to Party], [Bill-to Name] ";
                                                    $strSql .= "ORDER BY [Invoice No] DESC, [Bill-to Party], [Bill-to Name] ";
                                                    //echo $strSql . "<br>";

                                                    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                                                    $statement->execute();  
                                                    $nRecCount = $statement->rowCount();
                                                    //echo $nRecCount . " records <br>";
                                                        
                                                    if ($nRecCount >0)
                                                    {
                                                        while($ds = $statement->fetch(PDO::FETCH_NAMED))
                                                        {
                                                            echo "<option value='".$ds['Invoice No'].'/'.$ds['Bill-to Party']."'>".
                                                                $ds['Invoice No'].' / '.$ds['Bill-to Party'].' / '.$ds['Bill-to Name'].
                                                                "</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        
                                        <!-------------------------------->
                                        <!-- Dropdownlist Material Code -->
                                        <!-------------------------------->
                                        <div class="form-group">
                                            <label for="title">Select Material Code:</label>
                                            <select name="material-ddl" class="form-control" style="width:500px">
                                            <option value="">--- Select Material Code ---</option>
                                            </select>
                                        </div>

                                        <!------------------------->
                                        <!-- Dropdownlist Lot No -->
                                        <!------------------------->
                                        <div class="form-group">
                                            <label for="title">Select Lot No.:</label>
                                            <select name="lot-ddl" class="form-control" style="width:500px">
                                            <option value="">--- Select Lot No. ---</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <button type="submit" style="float: right; margin:2px;" class="btn btn-success">
                                                    <span class="fa fa-print fa-lg">&nbsp&nbsp&nbspPrint</span>
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
                $( "select[name='invoice-ddl']" ).click(function () 
                {
                    var tmpID = $(this).val();
                    var n = tmpID.search("/")
                    var invoiceID = tmpID.substring(0,n)
                    //var invoiceID = $(this).val();

                    if(invoiceID) 
                    {
                        $.ajax({
                            url: "ajaxBrowseMat.php",
                            dataType: 'Json',
                            data: {'id':invoiceID},
                            success: function(data) 
                            {
                                $('select[name="lot-ddl"]').empty();
                                $('select[name="material-ddl"]').empty();
                                $.each(data, function(key, value) 
                                {
                                    $('select[name="material-ddl"]').append('<option value="'+ key +'">'+ value +'</option>');
                                    //$('select[name="material"]').append('<option value="'+ key +'">'+ key +'</option>');
                                });
                            }
                        });
                    }
                    else
                    {
                        $('select[name="material-ddl"]').empty();
                        $('select[name="lot-ddl"]').empty();
                    }
                });

                $( "select[name='material-ddl']" ).click(function ()
                {    
                    var tmpID = $(this).val();
                    var n = tmpID.search("/")
                    var invoiceID = tmpID.substring(0,n)
                    var materialID = tmpID.substring(n+1,tmpID.length)
                    console.log(n);
                    console.log(invoiceID);
                    console.log(materialID);
                    
                    //var invoiceID = $(this).val();

                    if(invoiceID)
                    {
                        $.ajax({
                            url: "ajaxBrowseLot.php",
                            dataType: 'Json',
                            data: {'id1':invoiceID, 'id2':materialID},
                            //data: {'id1': invoiceID},
                            success: function(data) 
                            {
                                $('select[name="lot-ddl"]').empty();
                                $.each(data, function(key, value) 
                                {
                                    $('select[name="lot-ddl"]').append('<option value="'+ key +'">'+ value +'</option>');                    
                                });
                            }
                        });
                    }
                    else
                    {
                        $('select[name="lot-ddl"]').empty();
                    }
                });
                </script>
            </body>
        </html>
<?php
        }
        else
        {
            echo "<script> alert('You are not authorization for this menu ... Please contact your administrator'); window.location.href='pMain.php'; </script>";
        }
    }
?>