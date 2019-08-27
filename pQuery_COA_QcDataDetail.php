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
                                    Criteria [ Query QC Data Detail ]                                 
                                </div>

                                <div class="panel-body">
                                    
                                    <!--<form method="post" action="">-->
                                    <form method="post" action="pQuery_COA_QcDataDetail_View.php" target='_blank'>
                                        </iframe>
                                        <!------------------------------->
                                        <!-- Dropdownlist Material Code-->
                                        <!------------------------------->
                                        <div class="form-group">
                                            <label for="title">Select Data:</label>
                                            <select name="material-ddl" class="form-control" style="width:500px" required>
                                                <option value="">--- Select Material and Lot No. ---</option>

                                                <?php                        
                                                    require_once('include/db_Conn.php');

                                                    $strSql = "select distinct [Material Description], Material ";
                                                    $strSql .= "from COA_QcDataDetail ";
                                                    //$strSql .= "group by [Material Description], Material ";
                                                    $strSql .= "order by [Material Description], Material ";
                                                    echo $strSql . "<br>";

                                                    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                                                    $statement->execute();  
                                                    $nRecCount = $statement->rowCount();
                                                    //echo $nRecCount . " records <br>";
                                                        
                                                    if ($nRecCount >0)
                                                    {
                                                        while($ds = $statement->fetch(PDO::FETCH_NAMED))
                                                        {
                                                            echo "<option value='" . $ds['Material'] . "'> " . $ds['Material'] . ' - [ ' . $ds['Material Description'] . " ]" . "</option>";
                                                        }
                                                    }
                                                ?>
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
                                        <!--
                                        <div class="form-group">
                                            <label for="title">Select Material Code:</label>
                                            <select name="material" class="form-control" style="width:500px">
                                            <option value="">--- Select Invoice No. ---</option>
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
                    $( "select[name='material-ddl']" ).click(function ()
                    {    
                        var materialCode = $(this).val();
                        console.log(materialCode);

                        if(materialCode)
                        {
                            $.ajax({
                                url: "ajaxBrowseLotFromQcDataDetail.php",
                                dataType: 'Json',
                                data: {'id1':materialCode},                            
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
                    */
                </script>
            </body>
        </html>
<?php
    }
?>