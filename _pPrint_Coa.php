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
                                    <form method="post" action="pPrint_Coa2.php">
                                        <input type="hidden" name="param_email" value="<?php echo $_SESSION['ses_email'];?>">                                        

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <label>Please select sales data :</label>
                                                <?php require_once("dtl_sales_data_list.php")?>                                                
                                            </div>

                                            <div class="col-lg-2">
                                                <label>Invoice No.:</label>
                                                <p id="var1" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_invoice_no" name="param_invoice_no">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>PO No.:</label>
                                                <p id="var2" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_po_no" name="param_po_no">                                               
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Customer Code:</label>
                                                <p id="var3" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_cust_code" name="param_cust_code">        
                                            </div>
                                            <div class="col-lg-5">
                                                <label>Customer Name:</label>
                                                <p id="var4" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_cust_nname" name="param_cust_name">        
                                            </div>

                                            <div class="col-lg-2">
                                            </div>
                                            <div class="col-lg-1">
                                                <label>Item No.:</label>
                                                <p id="var5" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_item_no" name="param_item_no">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Material:</label>
                                                <p id="var6" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_material" name="param_material">                                           
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Material Description:</label>
                                                <p id="var7" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_material_desc" name="param_material_desc">             
                                                <br><br>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Quantity:</label>
                                                <p id="var8" class="form-control" disabled></p>
                                                <input type="hidden" class="form-control" id="arg_qty" name="param_qty">
                                                <br><br>
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