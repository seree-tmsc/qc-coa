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
                        <div class="col-lg-12 col-lg-offset-0">                                                        
                            <div class="panel panel-primary" id="panel-header">
                                <div class="panel-heading">
                                    Criteria [ Print COA For Thai Kansai ]                                 
                                </div>

                                <div class="panel-body">
                                    
                                    <input type="hidden" name="param_email" value="<?php echo $_SESSION['ses_email'];?>">                                        

                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <!--<label>Please select sales data :</label>-->
                                            <?php //require_once("dtl_sales_data_list.php")?>                                                
                                        </div>

                                        <div class="col-lg-2">
                                            <label>Invoice No.:</label>
                                            <input readonly type="text" class="form-control" value="<?php echo $_POST['param_invoice_no'];?>">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>PO No.:</label>
                                            <input readonly type="text" class="form-control" value="<?php echo $_POST['param_po_no'];?>">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Customer Code:</label>
                                            <input readonly type="text" class="form-control" value="<?php echo $_POST['param_cust_code'];?>">                                             
                                        </div>
                                        <div class="col-lg-5">
                                            <label>Customer Name:</label>
                                            <!--<p id="var4" class="form-control" disabled></p>-->
                                            <input readonly type="text" class="form-control" value="<?php echo $_POST['param_cust_name'];?>">
                                        </div>

                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-1">
                                            <label>Item No.:</label>
                                            <!--<p id="var5" class="form-control" disabled></p>-->
                                            <input readonly type="text" class="form-control" value="<?php echo $_POST['param_item_no'];?>">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Material:</label>
                                            <!--<p id="var6" class="form-control" disabled></p>-->
                                            <input readonly type="text" class="form-control" value="<?php echo $_POST['param_material'];?>">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Material Description:</label>
                                            <!--<p id="var7" class="form-control" disabled></p>-->
                                            <input readonly type="text" class="form-control" value="<?php echo $_POST['param_material_desc'];?>">
                                            <br><br>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Quantity:</label>
                                            <!--<p id="var8" class="form-control" disabled></p>-->
                                            <input readonly type="text" class="form-control" value="<?php echo $_POST['param_qty'];?>">
                                            <br><br>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>&nbsp</label>
                                        </div>
                                    </div>
                                    
                                    <form method="post" action="pPrint_Label_03_Report.php" target="_blank">
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <label>Please select Lot No.:</label>
                                                <?php require_once("dtl_lot_no_list.php")?>                                                
                                            </div>
                                            <div class="col-lg-2">
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Material:</label>
                                                <p id="var1" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_mat_code" name="param_mat_code">
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Material Description:</label>
                                                <p id="var2" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_mat_code" name="param_mat_code">
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Lot No:</label>
                                                <p id="var3" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_mat_code" name="param_mat_code">
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Bill Date:</label>
                                                <p id="var2" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_mat_name" name="param_mat_name">
                                            </div>
                                            <div class="col-lg-12">
                                                <label>&nbsp</label>
                                            </div>
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
            </body>
        </html>
<?php
    }
?>