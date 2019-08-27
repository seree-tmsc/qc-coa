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
                        $lPass = check_number_of_column(27);
                    }

                    if($lPass == true)
                    {
                        $lPass = check_name_of_column(array("bill.doc.", 
                        "item", 
                        "s", 
                        "created",
                        "billt", 
                        "net value", 
                        "curr.", 
                        "sorg."));
                    }

                    if($lPass == true)
                    {
                        $aVerifyField = array("invoice_no");
                        $aVerifyData = array(0);
                        $cTableName = "TRANS_History_Upload_COA_VF05";
                        $lPass = verify_data(1, $aVerifyField, $aVerifyData, $cTableName);
                    }                    

                    if($lPass == true)
                    {
                        $lPass = upload_COA_VF05_to_database();
                    }

                    /*
                    print_r($lPass[0]) . "<br>";
                    print_r($lPass[1]) . "<br>";
                    print_r($lPass[2]) . "<br>";
                    print_r($lPass[3]) . "<br>";
                    */
                    
                    if($lPass[0] == true)
                    {                        
                        $lPass = Insert_History_Upload_COA_VF05($lPass[1], $_POST['param_email'], "COA_QcDataDetail");
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