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
                                    Criteria [ Print COA For Thai Kansai ]                                 
                                </div>

                                <div class="panel-body">
                                    <form method="post" action="pChart_QcResult_View.php" target="_blank">
                                        <!-------------------------------->
                                        <!-- Dropdownlist Material Code -->
                                        <!-------------------------------->
                                        <div class="form-group">
                                            <label for="title">Select Material Code:</label>
                                            <select name="material-ddl" class="form-control">
                                            <option value="">--- Select Material Code ---</option>

                                                <?php                                                
                                                    require_once('include/db_Conn.php');

                                                    $strSql = "SELECT Material, [Material Description] ";
                                                    $strSql .= "FROM COA_QcDataDetail ";
                                                    $strSql .= "GROUP BY Material, [Material Description] ";
                                                    $strSql .= "ORDER BY [Material Description], Material ";
                                                    echo $strSql . "<br>";

                                                    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                                                    $statement->execute();  
                                                    $nRecCount = $statement->rowCount();
                                                    //echo $nRecCount . " records <br>";
                                                        
                                                    if ($nRecCount >0)
                                                    {
                                                        while($ds = $statement->fetch(PDO::FETCH_NAMED))
                                                        {
                                                            echo "<option value='" . $ds['Material'] . "'>".
                                                                $ds['Material Description'].' / '.$ds['Material'].
                                                                "</option>";
                                                        }
                                                    }                                                
                                                ?>

                                            </select>
                                        </div>

                                        <!---------------------------------->
                                        <!-- Dropdownlist Inspection Item -->
                                        <!---------------------------------->
                                        <div class="form-group">
                                            <label for="title">Select Inspection Item:</label>
                                            <select name="inspItem-ddl" class="form-control" >
                                            <option value="">--- Select Inspection Item ---</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <!--<div class="col-lg-12">-->
                                                <button type="submit" style="float: right; margin:2px;" class="btn btn-success">
                                                    <span class="fa fa-area-chart fa-lg">&nbsp&nbsp&nbspView</span>
                                                </button>
                                            <!--</div>-->
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
                    //alert('Click material-ddl');
                    var tmpID = $(this).val();
                    //var n = tmpID.search("/")
                    var n = tmpID.length;
                    var materialID = tmpID.substring(0,n)
                    //var materialID = tmpID.substring(n+1,tmpID.length)
                    console.log(tmpID);
                    //console.log(n);
                    console.log(materialID);
                    //console.log(invoiceID);                    
                    //var invoiceID = $(this).val();

                    if(tmpID)
                    {
                        $.ajax({
                            url: "ajaxChartBrowseInspItem.php",
                            dataType: 'Json',
                            //data: {'id1':invoiceID, 'id2':materialID},
                            data: {'id1': materialID},
                            success: function(data) 
                            {
                                $('select[name="inspItem-ddl"]').empty();
                                $.each(data, function(key, value) 
                                {
                                    $('select[name="inspItem-ddl"]').append('<option value="'+ key +'">'+ value +'</option>');                    
                                });
                            }
                        });
                    }
                    else
                    {
                        $('select[name="inspItem-ddl"]').empty();
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