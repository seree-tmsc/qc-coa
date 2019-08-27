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
                                    VF05 Data
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">                                        
<?php
                                        try
                                        {
                                            //echo $_POST['matandlot'] . "<br>";
                                            /*
                                            $nPosition = strpos($_POST['billandmat'],'/',0);
                                            $cBill_Doc = substr($_POST['billandmat'], 0, $nPosition);
                                            $cMaterial = substr($_POST['billandmat'], $nPosition+1, strlen($_POST['billandmat']));
                                            */
                                         
                                            require_once('include/db_Conn.php');
                                            $strSql = "SELECT * ";
                                            $strSql .= "FROM COA_VF05 ";
                                            $strSql .= "WHERE [Bill Doc] = '" . $_POST['billdoc'] . "' ";
                                            $strSql .= "ORDER BY [Bill Doc], item ";
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
                                                        <div class="col-lg-2">
                                                            <label>Bill Doc.:</label>
                                                            <p class="form-control" disabled><?php echo $ds['Bill Doc'];?></p>
                                                        </div>                                                    
                                                        <div class="col-lg-10">
                                                            &nbsp
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="table-responsive">                                                                
                                                                <table class='table table-bordered table-hover' id='myTableMaterial'>
                                                                    <thead>
                                                                    <tr class="active">                                                                        
                                                                        <th class='text-center'>Item-No.</th>
                                                                        <th>Material</th>
                                                                        <th>Material Description</th>
                                                                        <th class='text-center'>Lot No.</th>
                                                                        <th class='text-right'>Quantity</th>
                                                                        <th class='text-center'>Mode</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
<?php
                                                    }
?>                                                        
                                                    <tr>
                                                        <td class='text-center'><?php echo $ds["Item"];?></td>
                                                        <td><?php echo $ds["Material"];?></td>
                                                        <td><?php echo $ds["Description"];?></td>
                                                        <td class='text-center'><?php echo $ds["Batch"];?></td>                                                        
                                                        <td class='text-right'><?php echo number_format($ds["Bill qty"], 0, '.', ',');?></td>
<?php
                                                        //if($ds["Bill qty"] == 0)
                                                        if($ds["Batch"] != '')
                                                        {
?>
                                                            <td class='text-center'>
                                                                <a href="#" class="edit_qty_data" inv_no = "<?php echo $ds['Bill Doc'];?>" mat_code = "<?php echo $ds['Material'];?>" lot_no = "<?php echo $ds['Batch'];?>">
                                                                    <span class='fa fa-pencil-square-o fa-lg'></span>
                                                                </a>
                                                            </td>                                                        
<?php
                                                        }
                                                        else
                                                        {
?>
                                                            <td>
                                                            </td>
<?php                                                                                                                        
                                                        }
?>
                                                        
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
                                                onclick ="javascript:window.location.href='pQuery_COA_VF05.php';return false;">
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

                <!-- Modal - Insert Record -->
                <?php include "pMA_VF05_Insert_Modal.php"; ?>

                <script type="text/javascript">
                    $(document).ready(function()
                    {
                        $('#myTableMaterial').on('click', '.edit_qty_data', function()
                        {   
                            var doc = $(this).attr("inv_no");                                                                                 
                            var code = $(this).attr("mat_code");
                            var lot = $(this).attr("lot_no");
                            //alert(code + '/' + lot);

                            $('#matCode').prop('disabled',true);
                            $('#matCode').prop('required',false);
                            
                            $('#matName').prop('disabled',true);
                            $('#matName').prop('required',false);                            
                            
                            $.ajax({
                                url: "pMA_VF05_Fetch.php",
                                method: "post",
                                data: {doc: doc, code: code, lot: lot},
                                dataType: "json",
                                success: function(data)
                                {                                        
                                    $('#editmatCode').val(data['Material']);

                                    $('#invNo').val(data['Bill Doc']);
                                    $('#matCode').val(data['Material']);
                                    $('#matName').val(data['Description']);
                                    $('#lotNo').val(data['Batch']);
                                    $('#qty').val(data['Bill qty']);

                                    $('#insert_modal').modal('show');
                                }
                            });                            
                        });

                        /* attach a submit handler to the form */ 
                        $("#insert-form").submit(function(event) 
                        {
                            /* stop form from submitting normally */
                            event.preventDefault();
                            //alert("Insert Mode");
                            
                            console.log( $( this ).serialize() );

                            $.ajax({
                                url: "pMA_VF05_Insert.php",
                                method: "post",
                                //data: $('#insert-form').serialize(),
                                data: new FormData( this ),
                                processData: false,
                                contentType: false,

                                beforeSend:function(){
                                    $('#insert').val('Insert...')
                                },
                                success: function(data){
                                    if (data == '') {
                                        $('#insert-form')[0].reset();
                                        $('#insert_modal').modal('hide');
                                        location.reload();
                                    }
                                    else
                                    {
                                        alert(data);
                                        location.reload();
                                    }
                                }
                            });                            
                        });
                    });
                </script>
            </body>
        </html>
<?php
    }
?>