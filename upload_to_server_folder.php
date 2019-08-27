<?php    
    try
    {
        if($lPass)
        {
            date_default_timezone_set("Asia/Bangkok");
    
            echo "<label>Process 1. Upload to temps folder. </label><br>";
        
            move_uploaded_file($_FILES["param_fileCSV"]["tmp_name"], "temps/".$_FILES["param_fileCSV"]["name"]);
            echo "<label style='color:green'>Pass</label>" . "<br><br>";
            $lPass = true;
        }
        else
        {
            echo "Error Message:";
            break;            
        }
    }
    catch(Exception $e)
    {
        echo 'Error Message: ' .$e->getMessage();
        $lPass = false;
    }
?>