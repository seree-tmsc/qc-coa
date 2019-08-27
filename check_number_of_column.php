<?php
    try
    {
        if($lPass == true)
        {
            echo "<label>Process 2. Check Number of Column. </label><br>";
            $objCSV = fopen("temps/" . $_FILES["param_fileCSV"]["name"], "r");
    
            if (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE)
            {                   
                if (sizeof($objArr) == 22)
                {                
                    $lPass = true;
                }
                else
                {                
                    $lPass = false;
                }
            }
            fclose($objCSV);
        }
        else
        {
            echo "Error Message:";
            break;
        }
    }
    catch (Exception $e)
    {
        echo 'Error Message: ' .$e->getMessage();
        $lPass = false;
    }    
?>