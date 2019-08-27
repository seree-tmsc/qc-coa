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
                    <?php require_once("include/submenu_navbar.php"); ?>

                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">                                                        
                            <div class="panel panel-primary" id="panel-header">
                                <div class="panel-heading">
                                    Criteria [ VF05 Data ]                                 
                                </div>

                                <div class="panel-body">
                                    
                                    <!--<form method="post" action="">-->
                                    <form method="post" action="pQuery_COA_VF05_View.php" target='_blank'>
                                        </iframe>                                        
                                        <div class="form-group">
                                            <label for="title">Select Data:</label>
                                            <select name="billdoc" class="form-control" style="width:500px" required>
                                                <!--<option value="">--- Select Bill Doc and Material ---</option>-->

                                                <?php                        
                                                    require_once('include/db_Conn.php');

                                                    $strSql = "select [Bill Doc] ";
                                                    $strSql .= "from COA_VF05 ";
                                                    $strSql .= "group by [Bill Doc] ";
                                                    $strSql .= "order by [Bill Doc] DESC ";
                                                    echo $strSql . "<br>";

                                                    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                                                    $statement->execute();  
                                                    $nRecCount = $statement->rowCount();
                                                    //echo $nRecCount . " records <br>";
                                                        
                                                    if ($nRecCount >0)
                                                    {                                                        
                                                        while($ds = $statement->fetch(PDO::FETCH_NAMED))
                                                        {                                                            
                                                            echo "<option value='" . $ds['Bill Doc'] . "'>" 
                                                            . $ds['Bill Doc']
                                                            . "</option>";
                                                        }                                                        
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                                    
                                        </div>
                                        <!--
                                        <div class="form-group">
                                            <label for="title">Select Material Code:</label>
                                            <select name="material" class="form-control" style="width:500px">
                                            <option value="">--- Select Invoice No. ---</option>
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
                /*
                $( "select[name='invoice']" ).click(function () 
                {
                    var tmpID = $(this).val();
                    var n = tmpID.search("/")
                    var invoiceID = tmpID.substring(0,n)
                    //var invoiceID = $(this).val();

                    if(invoiceID) 
                    {
                        $.ajax({
                            url: "ajaxpro.php",
                            dataType: 'Json',
                            data: {'id':invoiceID},
                            success: function(data) 
                            {
                                $('select[name="lot"]').empty();
                                $('select[name="material"]').empty();
                                $.each(data, function(key, value) 
                                {
                                    $('select[name="material"]').append('<option value="'+ key +'">'+ value +'</option>');
                                    //$('select[name="material"]').append('<option value="'+ key +'">'+ key +'</option>');
                                });
                            }
                        });
                    }
                    else
                    {
                        $('select[name="material"]').empty();
                        $('select[name="lot"]').empty();
                    }
                });

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