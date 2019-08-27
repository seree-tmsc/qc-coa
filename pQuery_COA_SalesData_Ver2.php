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
                                    Criteria [ Query Sales Data ]                                 
                                </div>

                                <div class="panel-body">
                                    
                                    <!--<form method="post" action="">-->
                                    <form method="post" action="pQuery_COA_SalesData_Ver2_View.php" target='_blank'>
                                        </iframe>
                                        <!------------------------------>
                                        <!-- Dropdownlist Invoice No. -->
                                        <!------------------------------>
                                        <div class="form-group">
                                            <label for="title">Select Invoice No.:</label>
                                            <select name="delivery_no" class="form-control" style="width:500px" required>
                                                <option value="">--- Select Invoice No. ---</option>

                                                <?php                        
                                                    require_once('include/db_Conn.php');

                                                    $strSql = "select [Invoice No], [Delivery No] ";
                                                    $strSql .= "from COA_SalesData ";
                                                    $strSql .= "group by [Invoice No], [Delivery No] ";
                                                    $strSql .= "order by [Invoice No] DESC, [Delivery No] ";
                                                    //echo $strSql . "<br>";

                                                    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                                                    $statement->execute();  
                                                    $nRecCount = $statement->rowCount();
                                                    //echo $nRecCount . " records <br>";
                                                        
                                                    if ($nRecCount >0)
                                                    {
                                                        while($ds = $statement->fetch(PDO::FETCH_NAMED))
                                                        {
                                                            echo "<option value='" . $ds['Delivery No']. "'>" 
                                                            . $ds['Invoice No'] . " - ". $ds['Delivery No']
                                                            . "</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <!-------------------------->
                                        <!-- Dropdownlist Lot No. -->
                                        <!-------------------------->
                                        <!--
                                        <div class="form-group">
                                            <label for="title">Select Lot No.:</label>
                                            <select name="lot_no" class="form-control" style="width:500px">
                                            <option value="">--- Select Material and Lot No. ---</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Select Lot No.:</label>
                                            <select name="lot" class="form-control" style="width:500px">
                                            <option value="">--- Select Lot No. ---</option>
                                            </select>
                                        </div>
                                        -->
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
                $( "select[name='invoice_no']" ).click(function () 
                {
                    var deliveryNO = $(this).val();
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

                /*
                $( "select[name='material']" ).click(function ()
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
                            url: "ajaxpro2.php",
                            dataType: 'Json',
                            data: {'id1':invoiceID, 'id2':materialID},
                            //data: {'id1': invoiceID},
                            success: function(data) 
                            {
                                $('select[name="lot"]').empty();
                                $.each(data, function(key, value) 
                                {
                                    $('select[name="lot"]').append('<option value="'+ key +'">'+ value +'</option>');                    
                                });
                            }
                        });
                    }
                    else
                    {
                        $('select[name="lot"]').empty();
                    }
                });
                */
                </script>
            </body>
        </html>
<?php
    }
?>