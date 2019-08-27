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
                                    <form method="post" action="pPrint_Coa_Ver2_Report.php" target="_blank">
                                        <!-------------------------->
                                        <!-- Dropdownlist Invoice -->
                                        <!-------------------------->
                                        <div class="form-group">
                                            <label for="title">Select Invoice No.:</label>
                                            <select name="invoice_no" class="form-control" style="width:500px" required>
                                                <option value="">--- Select Invoice No. ---</option>

                                                <?php                        
                                                    require_once('include/db_Conn.php');

                                                    $strSql = "select [Invoice No], [Delivery No], [Sold-to Party] ";
                                                    $strSql .= "from COA_SalesData ";
                                                    $strSql .= "group by [Invoice No], [Delivery No], [Sold-to Party] ";
                                                    $strSql .= "order by [Invoice No] DESC, [Delivery No], [Sold-to Party] ";
                                                    echo $strSql . "<br>";

                                                    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                                                    $statement->execute();  
                                                    $nRecCount = $statement->rowCount();
                                                    //echo $nRecCount . " records <br>";
                                                        
                                                    if ($nRecCount >0)
                                                    {
                                                        while($ds = $statement->fetch(PDO::FETCH_NAMED))
                                                        {
                                                            echo "<option value='" . $ds['Invoice No']. "/". $ds['Delivery No'] . "/". $ds['Sold-to Party'] . "'>"
                                                            . $ds['Invoice No'] . " - ". $ds['Delivery No'] . " - ". $ds['Sold-to Party']
                                                            . "</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>                                            
                                        </div>

                                        <!-------------------------->
                                        <!-- Dropdownlist Lot No. -->
                                        <!-------------------------->
                                        <div class="form-group">
                                            <label for="title">Select Material and Lot No.:</label>
                                            <select name="lot_no" class="form-control" style="width:500px">
                                            <option value="">--- Select Material and Lot No. ---</option>
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
                    $( "select[name='invoice_no']" ).click(function () 
                    {
                        var tmpString = $(this).val();                        
                        console.log(tmpString);
                        deliveryNO = tmpString.substring(tmpString.indexOf("/")+1, tmpString.indexOf("/")+11);
                        console.log(deliveryNO);

                        if(deliveryNO) 
                        {
                            $.ajax({
                                url: "ajaxBrowseLotFromSalesData.php",
                                dataType: 'Json',
                                data: {'id':deliveryNO},
                                success: function(data) 
                                {
                                    $('select[name="lot_no"]').empty();
                                    $.each(data, function(key, value) 
                                    {
                                        $('select[name="lot_no"]').append('<option value="'+ key +'">'+ value +'</option>');
                                    });
                                }
                            });
                        }
                        else
                        {
                            $('select[name="mlot_no"]').empty();
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