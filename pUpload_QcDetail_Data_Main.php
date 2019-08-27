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
                <?php echo $_POST['param_email'];?> 
            </div>

            <div class="panel-body">
                <?php
                    /*-----------------------------------------------------*/
                    /* --- Process 1. upload csv file to server folder --- */
                    /*-----------------------------------------------------*/
                    $lPass = upload_to_server_folder();
                    

                    /*-------------------------------------------*/                    
                    /* --- Process 2. check number of column --- */
                    /*-------------------------------------------*/
                    if($lPass == true)
                    {
                        $lPass = check_number_of_column(14);
                    }


                    /*------------------------------------------*/
                    /* --- Process 3. check name of columnn --- */
                    /*------------------------------------------*/
                    if($lPass == true)
                    {
                        $lPass = check_name_of_column(array("material", 
                        "material description", 
                        "plant", 
                        "ud code",
                        "batch", 
                        "date of manufacture", 
                        "sled/bbd", 
                        "created on"));
                    }


                    /*---------------------------------*/
                    /* --- Process 4. Vefiray data --- */
                    /*---------------------------------*/
                    if($lPass == true)
                    {
                        /*-- array 2 element / check field name 'material' and field name 'batch' in DB --*/
                        $aVerifyField = array("material", "batch");
                        /*-- array 2 element / check column 0 and column 4 in CSV file --*/
                        $aVerifyData = array(0,4);
                        $cTableName = "TRANS_History_Upload_COA_QcDataDetail";
                        $lPass = verify_data(count($aVerifyField), $aVerifyField, $aVerifyData, $cTableName);
                    }


                    /*--------------------------------*/
                    /* --- Process 5. Upload data --- */
                    /*--------------------------------*/
                    if($lPass == true)
                    {
                        $lPass = upload_COA_QcDataDetail_to_database();
                    }
                    
                    if($lPass[0] == false)
                    {
                        if(sizeof($lPass[1]) > 0)
                        {
                            /*
                            echo sizeof($lPass[1]) . "<br>";
                            foreach($lPass[1] as $key => $value)
                            {
                                echo "ARRAY[" . $key . "] " . "MEMBER -1 =" . $value[0] . " / MEMBER -2 = ". $value[1] ."<br>";                                
                            }
                            */
                            $lPass = Insert_History_Upload_COA_QcDataDetail($lPass[1], $_POST['param_email'], "COA_QcDataDetail");
                        }
                    }
                    else
                    {
                        $lPass = Insert_History_Upload_COA_QcDataDetail($lPass[1], $_POST['param_email'], "COA_QcDataDetail");
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