<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php require_once("include/library.php"); ?>    
</head>

<?php
    include_once "function_For_COA.php";
?>

<body>
    <div class="container">
        <br>                    
        <div class="panel panel-info">
            <div class="panel-heading">
                <?php echo "File name is " . $_FILES["param_fileCSV"]["name"]; ?>
                <?php //echo $_POST['param_email'];?> 
            </div>

            <div class="panel-body">
                <?php
                    $lPass = upload_to_server_folder();

                    if($lPass == true)
                    {
                        $lPass = check_number_of_column(25);
                    }

                    if($lPass == true)
                    {
                        $lPass = check_name_of_column(array("sales office's description", 
                        "invoice no.", 
                        "invoice line item no.", 
                        "invoice date", 
                        "material", 
                        "material description", 
                        "quantity", 
                        "uom"));
                    }

                    if($lPass == true)
                    {
                        //$lPass = verify_invoice_date();
                        $aVerifyField = array("invoice_no", "[delivery no]");
                        $aVerifyData = array(1,23);
                        $cTableName = "TRANS_History_Upload_COA_SalesData";
                        $lPass = verify_data(1, $aVerifyField, $aVerifyData, $cTableName);
                    }
                    
                    if($lPass == true)
                    {
                        $lPass = upload_COA_SalesData_to_database();
                    }
                    
                    /*
                    print_r($lPass[1]);
                    echo "<br>";
                    print_r($lPass[1][0]);
                    echo "<br>";
                    print_r($lPass[1][1]);
                    echo "<br>";
                    */

                    if($lPass[0] == true)
                    {
                        $lPass = Insert_History_Upload_COA_SalesData($lPass[1], $_POST['param_email'], "COA_SalesData");
                    }                    
                ?>
            </div>
        </div>

        <button type="submit" style="float: right; margin:2px;" class="btn btn-success" 
            onclick ="javascript:window.location.href='pMain.php';return false;">
            Main Page
        </button>    
    </div>
</body>
</html>