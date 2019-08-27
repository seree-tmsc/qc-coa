<?php
    try
    {
        if($lPass)
        {
            echo "<label>Process 3. Check Name of each column. </label><br>";
            $objCSV = fopen("temps/" . $_FILES["param_fileCSV"]["name"], "r");
    
            if (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE)
            {       
                $nColumn_Name_Error = 0;
                foreach ($objArr as $key => $value)
                {
                    echo "Column " . ($key+1) . " / " . "Column Name is '" . $value . "' <br>";
                    switch($key+1)
                    {                                        
                        case 1:                                            
                            if(ltrim(strtolower($value)) !== 'plant')
                            {
                                $nColumn_Name_Error += 1;
                                echo "<label style='color:red'>&nbsp  Column number " . ($key+1) . " not correct </label><br>";                                                
                            }
                            break;
                        case 2:                                            
                            if(strtolower($value) !== 'created on')
                            {                                                
                                $nColumn_Name_Error += 1;
                                echo "<label style='color:red'>&nbsp  Column number " . ($key+1) . " not correct </label><br>";                                                
                            }
                            break;
                        case 3:                                            
                            if(strtolower($value) !== 'inspection lot')
                            {                                                
                                $nColumn_Name_Error += 1;
                                echo "<label style='color:red'>&nbsp  Column number " . ($key+1) . " not correct </label><br>";                                                
                            }                                            
                            break;
                        case 4:                                            
                            if(strtolower($value) !== 'material')
                            {                                                
                                $nColumn_Name_Error += 1;
                                echo "<label style='color:red'>&nbsp  Column number " . ($key+1) . " not correct </label><br>";
                            }
                            break;
                        case 5:                                            
                            if(strtolower($value) !== 'material description')
                            {                                                
                                $nColumn_Name_Error += 1;
                                echo "<label style='color:red'>&nbsp  Column number " . ($key+1) . " not corect </label><br>";
                            }                                            
                            break;
                        case 6:                                            
                            if(strtolower($value) !== 'batch')
                            {                                                
                                $nColumn_Name_Error += 1;
                                echo "<label style='color:red'>&nbsp  Column number " . ($key+1) . " not correct </label><br>";
                            }
                            break;
                    }
                }
                fclose($objCSV);
            }
            else
            {
                echo 'Error Message: ';
                $lPass = false;
                break;
            }
        }
        else
        {
            echo "Error Message:";
            $lPass = false;
            break;
        }
    }
    catch (Exception $e)
    {
        echo 'Error Message: ' .$e->getMessage();
        $lPass = false;
    }    
?>