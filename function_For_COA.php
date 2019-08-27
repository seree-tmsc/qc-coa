<?php
    function upload_to_server_folder()
    {
        try
        {   
            echo "<label>Process 1. Upload to temps folder. </label><br>";

            date_default_timezone_set("Asia/Bangkok"); 
            move_uploaded_file($_FILES["param_fileCSV"]["tmp_name"], "temps/".$_FILES["param_fileCSV"]["name"]);

            echo "Folder location is ../temps/".$_FILES["param_fileCSV"]["name"] . "<br>";

            $lPass = true;
        }
        catch(Exception $e)
        {
            echo "<label style='color:red'>... Error ...". $e->getMessage() ."</label>" . "<br><br>";
            $lPass = false;
        }
        
        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....</label>" . "<br><br>";
        }
        else
        {
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }
        return $lPass;
    }

    function check_number_of_column($nColumn)
    {
        try
        {
            echo $nColumn . "<br>";

            $lPass = true;
            echo "<label>Process 2. Check Number of Column. [" . $nColumn . " Columns.]</label><br>";
            //echo "Folder location is ../temps/".$_FILES["param_fileCSV"]["name"] . "<br>";

            $objCSV = fopen("temps/" . $_FILES["param_fileCSV"]["name"], "r");
    
            if (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE)
            {
                echo "Number of Columns = " . sizeof($objArr) . " columns <br>";
                
                for($i = 0; $i < sizeof($objArr); $i++)
                {
                    echo ($i+1) . " " . $objArr[$i] . "<br>";
                }

                if (sizeof($objArr) <> $nColumn)
                {
                    $lPass = false;
                }
            }
            else
            {
                $lPass = false;
            }
            fclose($objCSV);
        }
        catch (Exception $e)
        {
            echo "<label style='color:red'>... Error ...". $e->getMessage() ."</label>" . "<br><br>";
            $lPass = false;
        }

        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....</label>" . "<br><br>";
        }
        else
        {
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }
        return $lPass;
    }

    function check_name_of_column($aColumnName)
    {
        try
        {
            //setlocale ( LC_ALL, 'en_US.UTF-8' );
            //setlocale(LC_ALL, 'th_TH');
            //setlocale(LC_ALL, 'th_TH.utf-8');
            //setlocale ( LC_ALL, 'Thai' );

            $lPass = true;
            echo "<label>Process 3. Check Name of Column. </label><br>";
            //echo "Folder location is ../temps/".$_FILES["param_fileCSV"]["name"] . "<br>";
            $objCSV = fopen("temps/" . $_FILES["param_fileCSV"]["name"], "r");
    
            if (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE)
            {
                //echo "Number of Columns = " . sizeof($objArr) . " columns <br>";

                foreach ($objArr as $key => $value)
                {
                    echo "Column " . ($key+1) . " / " . "Column Name is '" . strtolower($value) . "' <br>";
                    switch ($key) 
                    {
                        case 0:
                            echo strlen($value) . "<br>";
                            echo substr($value, 0, 1) . "<br>";
                            echo substr($value, 1, 1) . "<br>";
                            echo substr($value, 2, 1) . "<br>";
                            echo substr($value, 3, 1) . "<br>";

                            echo substr($value, 0, strlen($value)) . "<br>";
                            echo strtolower(substr($value, 0, strlen($value))) . "<br>";

                            echo substr($value,3,strlen($value)) . "<br>";
                            echo strtolower(substr($value,3,strlen($value))) . "<br>";
                            /*
                            if(  strtolower(substr($value,3,strlen($value))) != $aColumnName[0])
                            {
                                echo strlen($value) . "<br>";
                                echo substr($value,3,strlen($value)) . "<br>";
                                echo strtolower(substr($value,3,strlen($value))) . "<br>";
                                echo "<label style='color:red'>... Error - Column " .  ($key+1) . "</label>" . "<br><br>";
                                $lPass = false;
                            }
                            */
                            break;
                        case 1:
                            if( strtolower($value) != $aColumnName[1])
                            {
                                echo "<label style='color:red'>... Error - Column " .  ($key+1) . "</label>" . "<br><br>";
                                $lPass = false;
                            }
                            break;
                        case 2:
                            if( strtolower($value) != $aColumnName[2])
                            {
                                echo "<label style='color:red'>... Error - Column " .  ($key+1) . "</label>" . "<br><br>";
                                $lPass = false;
                            }
                            break;
                        case 3:
                            if( strtolower($value) != $aColumnName[3])
                            {
                                echo "<label style='color:red'>... Error - Column " .  ($key+1) . "</label>" . "<br><br>";
                                $lPass = false;
                            }
                            break;
                        case 4:
                            if( strtolower($value) != $aColumnName[4])
                            {
                                echo "<label style='color:red'>... Error - Column " .  ($key+1) . "</label>" . "<br><br>";
                                $lPass = false;
                            }
                            break;
                        case 5:
                            if( strtolower($value) != $aColumnName[5])
                            {
                                echo "<label style='color:red'>... Error - Column " .  ($key+1) . "</label>" . "<br><br>";
                                $lPass = false;
                            }
                            break;
                        case 6:
                            if( strtolower($value) != $aColumnName[6])
                            {
                                echo "<label style='color:red'>... Error - Column " .  ($key+1) . "</label>" . "<br><br>";
                                $lPass = false;
                            }
                            break;
                        case 7:
                            if( strtolower($value) != $aColumnName[7])
                            {
                                echo "<label style='color:red'>... Error - Column " .  ($key+1) . "</label>" . "<br><br>";
                                $lPass = false;
                            }
                            break;
                    }
                }
            }
            else
            {
                $lPass = false;
            }
            fclose($objCSV);
        }
        catch (Exception $e)
        {
            echo "<label style='color:red'>... Error ...". $e->getMessage() ."</label>" . "<br><br>";
            $lPass = false;
        }

        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....</label>" . "<br><br>";
        }
        else
        {
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }
        return $lPass;
    }

    function verify_data($nNumberOfKey, $aVerifyField, $aVerifyData, $cTableName)
    {
        try
        {
            $lPass = true;
            $nCurRow = 0;
            echo "<label>Process 4. Verify data in Hisstory Table</label><br>";
            //echo "Folder location is ../temps/".$_FILES["param_fileCSV"]["name"] . "<br>";

            $objCSV = fopen("temps/" . $_FILES["param_fileCSV"]["name"], "r");

            while (($objArr = fgetcsv($objCSV, 10000, ",")) !== FALSE)
            {
                $lPass = true;
                $nCurRow += 1;
                //echo "Verify Record No. " . $nCurRow . " " . "<br>";

                if($nCurRow > 1)
                {                    
                    include('include/db_Conn.php');
                    $strSql = "SELECT * ";
                    $strSql .= "FROM " . $cTableName . " ";
                    $strSql .= "WHERE " . $aVerifyField[0] . "='" . $objArr[$aVerifyData[0]] . "' " ;
                    if($nNumberOfKey == 2)
                    {
                        $strSql .= "AND " . $aVerifyField[1] . "='" . $objArr[$aVerifyData[1]] . "' " ;
                    }
                    echo $nCurRow-1 . " " . $strSql . "<br>";
                
                    $statement = $conn->prepare($strSql,array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                    $statement->execute();
                    $nRecCount = $statement->rowCount();
                    
                    if ($nRecCount == 1)
                    {                            
                        echo "<label style='color:red'>... Error Porcess #4 ...Data key = ". $objArr[$aVerifyData[0]] . " --- [This data was uploaded to the system already!]" . "</label><br>";
                        $lPass = false;
                        break;
                    }                                  
                }
                else
                {
                    $lPass = false;
                }
            }
            if ($lPass == true)
            {
                echo "End Of File ..." . "<br>";
            }
            fclose($objCSV);
        }
        catch (Exception $e)
        {
            echo $strSql . "<br>";
            echo "<label style='color:red'>... Error ...". $e->getMessage() ."</label>" . "<br><br>";
            $lPass = false;
        }
        
        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....</label>" . "<br><br>";
        }
        else
        {
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }
        
        return $lPass;
    }
    
    function upload_COA_SalesData_to_database()
    {
        try
        {
            $lPass = true;
            $nCurRec = 0;
            $aInvoiceNo = array();
            $currentInv = '';
            $aDeliveryNo = array();

            echo "<label>Process 5. Upload CSV file from server folder to Database Server</label><br>";
            //echo "Folder location is ../temps/".$_FILES["param_fileCSV"]["name"] . "<br>";

            $objCSV = fopen("temps/" . $_FILES["param_fileCSV"]["name"], "r");
            while (($objArr = fgetcsv($objCSV, 10000, ",")) !== FALSE)
            {
                $nCurRec +=1;
                //echo $nCurRec . "<br>";
                //echo $objArr[1] . "<br>";

                if($nCurRec > 1)
                {
                    if ($currentInv != $objArr[1])
                    {
                        if ((! in_array($objArr[1], $aInvoiceNo)) and (! in_array($objArr[23], $aDeliveryNo)))
                        {
                            $aTmpArray = array();
                            array_push($aTmpArray, $objArr[1]);
                            array_push($aTmpArray, $objArr[23]);
                            array_push($aTmpArray, $objArr[3]);

                            array_push($aInvoiceNo, $aTmpArray);
                            $currentInv = $objArr[1];
                        }
                    }
                
                    include('include/db_Conn.php');
                    $strSql = "INSERT INTO COA_SalesData ";
                    $strSql .= "VALUES (";
                    $strSql .= "'".$objArr[0]."',";
                    $strSql .= "'".$objArr[1]."',";
                    $strSql .= "'".$objArr[2]."',";
                    $strSql .= "'20".substr($objArr[3],6,2)."/".substr($objArr[3],3,2)."/".substr($objArr[3],0,2). "',";
                    $strSql .= "'".$objArr[4]."',";
                    $strSql .= "'".$objArr[5]."',";
                    $strSql .= "".str_replace(',','',$objArr[6]).",";
                    $strSql .= "'".$objArr[7]."',";
                    $strSql .= "'".$objArr[8]."',";
                    $strSql .= "'".$objArr[9]."',";
                    $strSql .= "'".$objArr[10]."',";
                    $strSql .= "'". str_replace("'", "", $objArr[11]) . "',";
                    $strSql .= "'".$objArr[12]."',";
                    $strSql .= "'".$objArr[13]."',";                                
                    $strSql .= "'".$objArr[14]."',";
                    $strSql .= "'".$objArr[15]."',";
                    $strSql .= "'" . str_replace("'","",$objArr[16]) ."',";
                    $strSql .= "'".$objArr[17]."',";
                    $strSql .= "'".$objArr[18]."',";
                    $strSql .= "'".$objArr[19]."',";
                    $strSql .= "'".$objArr[20]."',";
                    $strSql .= "'".$objArr[21]."',";
                    $strSql .= "'".$objArr[22]."',";
                    $strSql .= "'".$objArr[23]."',";
                    $strSql .= "'".$objArr[24]."')";
                    //echo $strSql . "<br>";
                    
                    $statement = $conn->prepare($strSql);
                    $statement->execute();
                }
            }
            fclose($objCSV);
        }        
        catch (Exception $e)
        {
            echo $strSql . "<br>";            
            echo "<label style='color:red'>... Error ...". $e->getMessage() ."</label>" . "<br><br>";
            $lPass = false;
        }        

        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....Upload data = ". $nCurRec . " Records </label>" . "<br><br>";
            /*
            sort($aInv_Date);
            print_r(array_values($aInv_Date));
            */
        }
        else
        {
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }
        
        $returnResult[0] =$lPass;
        $returnResult[1] =$aInvoiceNo;
        $returnResult[2] =$aDeliveryNo;

        return $returnResult;
    }

    function upload_COA_QcDataHeader_to_database()
    {
        try
        {
            $lPass = true;
            $nCurRec = 0;
            $aCustomerMaterial = array();
            $currentCustMat = '';            

            echo "<label>Process 5. Upload CSV file from server folder to Database Server</label><br>";            

            $objCSV = fopen("temps/" . $_FILES["param_fileCSV"]["name"], "r");
            while (($objArr = fgetcsv($objCSV, 10000, ",")) !== FALSE)
            {
                $nCurRec +=1;
                //echo $nCurRec . "<br>";                

                if($nCurRec > 1)
                {                                        
                    if ($currentCustMat != $objArr[1].$objArr[2])
                    {
                        if (! in_array($objArr[1].$objArr[2], $aCustomerMaterial)) 
                        {
                            $aTmpArray = array();
                            array_push($aTmpArray, $objArr[1]);
                            array_push($aTmpArray, $objArr[2]);

                            array_push($aCustomerMaterial, $aTmpArray);
                            $currentCustMat = $objArr[1].$objArr[2];
                        }
                    }

                    include('include/db_Conn.php');
                    $strSql = "INSERT INTO COA_QcDataHeader ";
                    $strSql .= "VALUES (";
                    $strSql .= "'".$objArr[0]."',";
                    $strSql .= "'".$objArr[1]."',";
                    $strSql .= "'".$objArr[2]."',";
                    $strSql .= "".$objArr[3].",";
                    $strSql .= "'".$objArr[4]."',";
                    $strSql .= "'".$objArr[5]."',";
                    $strSql .= "'".$objArr[6]."',";
                    $strSql .= "'".$objArr[7]."',";
                    $strSql .= "'".$objArr[8]."',";
                    $strSql .= "'".$objArr[9]."',";
                    $strSql .= "". intval($objArr[10]) .",";
                    $strSql .= "". intval($objArr[11]) .",";
                    $strSql .= "'".$objArr[12]."',";
                    $strSql .= "'".$objArr[13]."',";
                    $strSql .= "'".$objArr[14]."',";
                    $strSql .= "'".$objArr[15]."',";
                    $strSql .= "'20".substr($objArr[16],6,2)."/".substr($objArr[16],3,2)."/".substr($objArr[16],0,2). "',";
                    $strSql .= "'".$objArr[17]."',";
                    $strSql .= "'".$objArr[18]."',";
                    if($objArr[19] == '')
                    {
                        $strSql .= "'" . $objArr[19] . "',";
                    }
                    else
                    {
                        $strSql .= "'20".substr($objArr[19],6,2)."/".substr($objArr[19],3,2)."/".substr($objArr[19],0,2). "',";
                    }                    
                    $strSql .= "'".$objArr[20]."',";
                    $strSql .= "'".$objArr[21]."',";
                    $strSql .= "'".$objArr[22]."',";
                    $strSql .= "'".$objArr[23]."',";
                    $strSql .= "'".$objArr[24]."',";
                    $strSql .= "'".$objArr[25]."',";
                    $strSql .= "'".$objArr[26]."')";
                    //echo $strSql . "<br>";
                    
                    $statement = $conn->prepare($strSql);
                    $statement->execute();
                }
            }
            fclose($objCSV);
        }        
        catch (Exception $e)
        {
            echo $strSql . "<br>";            
            echo "<label style='color:red'>... Error ...". $e->getMessage() ."</label>" . "<br><br>";
            $lPass = false;
        }        

        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....Upload data = ". $nCurRec . " Records </label>" . "<br><br>";
        }
        else
        {
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }
        
        $returnResult[0] =$lPass;
        $returnResult[1] =$aCustomerMaterial;        

        return $returnResult;        
    }

    function upload_COA_QcDataDetail_to_database()
    {
        try
        {
            $lPass = true;
            $nCurRec = 0;
            $aMaterialLotno = array();
            $currentMatLot = '';

            echo "<label>Process 5. Upload CSV file from server folder to Database Server</label><br>";

            $objCSV = fopen("temps/" . $_FILES["param_fileCSV"]["name"], "r");
            while (($objArr = fgetcsv($objCSV, 10000, ",")) !== FALSE)
            {
                $nCurRec +=1;
                //echo "Upload Record No. " . $nCurRec . "<br>";
                //echo $objArr[1] . "<br>";

                if($nCurRec > 1)
                {
                    if ($currentMatLot != $objArr[0].$objArr[4])
                    {
                        if (! in_array(array($objArr[0],$objArr[4]), $aMaterialLotno))
                        {
                            $aTmpArray = array();
                            array_push($aTmpArray, $objArr[0]);
                            array_push($aTmpArray, $objArr[4]);
                            /*
                            print_r($aTmpArray);
                            echo "<br>";
                            print_r($aMaterialLotno);
                            echo "<br>";
                            */

                            array_push($aMaterialLotno, $aTmpArray);
                            $currentMatLot = $objArr[0].$objArr[4];
                        }
                    }

                    include('include/db_Conn.php');
                    $strSql = "INSERT INTO COA_QcDataDetail ";
                    $strSql .= "VALUES (";
                    $strSql .= "'".$objArr[0]."',";
                    $strSql .= "'".$objArr[1]."',";
                    $strSql .= "'".$objArr[2]."',";
                    $strSql .= "'".$objArr[3]."',";
                    $strSql .= "'".$objArr[4]."',";
                    $strSql .= "'20".substr($objArr[5],6,2)."/".substr($objArr[5],3,2)."/".substr($objArr[5],0,2). "',";
                    $strSql .= "'20".substr($objArr[6],6,2)."/".substr($objArr[6],3,2)."/".substr($objArr[6],0,2). "',";
                    $strSql .= "'20".substr($objArr[7],6,2)."/".substr($objArr[7],3,2)."/".substr($objArr[7],0,2). "',";                    
                    $strSql .= "'".$objArr[8]."',";
                    $strSql .= "'".$objArr[9]."',";
                    $strSql .= "'".$objArr[10]."',";
                    $strSql .= "". intval($objArr[11]) .",";
                    $strSql .= "". intval($objArr[12]) .",";                    
                    $strSql .= "'".$objArr[13]."')";
                    //echo $strSql . "<br>";
                    
                    $statement = $conn->prepare($strSql);
                    $statement->execute();
                }
            }
            echo "End Of File ..." . "<br>";
            fclose($objCSV);
        }        
        catch (Exception $e)
        {
            echo $strSql . "<br>";            
            echo "<label style='color:red'>... Error ... Record No. = ". $nCurRec . "  Error Message = " . $e->getMessage() ."</label>" . "<br><br>";
            $lPass = false;
        }        

        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....Upload data = ". $nCurRec . " Records </label>" . "<br><br>";
        }
        else
        {
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }
        
        $returnResult[0] =$lPass;        
        $returnResult[1] =$aMaterialLotno;

        return $returnResult;        
    }

    function upload_COA_VF05_to_database()
    {
        try
        {
            $lPass = true;
            $nCurRec = 0;            
            $aBillDoc = array();            
            $currentBill = '';

            echo "<label>Process 5. Upload CSV file from server folder to Database Server</label><br>";            

            $objCSV = fopen("temps/" . $_FILES["param_fileCSV"]["name"], "r");
            while (($objArr = fgetcsv($objCSV, 10000, ",")) !== FALSE)
            {
                $nCurRec +=1;                
                //echo $objArr[1] . "<br>";

                if($nCurRec > 1)
                {                                        
                    if ($currentBill != $objArr[0])
                    {
                        if (! in_array($objArr[0], $aBillDoc)) 
                        {
                            array_push($aBillDoc, $objArr[0]);
                            $currentBill = $objArr[0];                            
                        }
                    }

                    include('include/db_Conn.php');
                    $strSql = "INSERT INTO COA_VF05 ";
                    $strSql .= "VALUES (";
                    $strSql .= "'".$objArr[0]."',";
                    $strSql .= "'".$objArr[1]."',";
                    $strSql .= "'".$objArr[2]."',";
                    $strSql .= "'".$objArr[3]."',";
                    $strSql .= "'".$objArr[4]."',";
                    $strSql .= "". intval($objArr[5]) .",";
                    $strSql .= "'".$objArr[6]."',";
                    $strSql .= "'".$objArr[7]."',";
                    $strSql .= "". intval($objArr[8]) .",";
                    $strSql .= "'".$objArr[9]."',";
                    $strSql .= "'".$objArr[10]."',";
                    $strSql .= "'".$objArr[11]."',";
                    $strSql .= "'".$objArr[12]."',";
                    $strSql .= "'".$objArr[13]."',";
                    $strSql .= "". intval($objArr[14]) .",";
                    $strSql .= "'".$objArr[15]."',";
                    $strSql .= "'".$objArr[16]."',";
                    $strSql .= "'".$objArr[17]."',";
                    $strSql .= "'".$objArr[18]."',";
                    $strSql .= "'".$objArr[19]."',";
                    $strSql .= "". intval(str_replace(',','',$objArr[20])) .",";
                    $strSql .= "'".$objArr[21]."',";
                    $strSql .= "'".$objArr[22]."',";
                    $strSql .= "'".$objArr[23]."',";
                    $strSql .= "'".$objArr[24]."',";
                    $strSql .= "'20".substr($objArr[25],6,2)."/".substr($objArr[25],3,2)."/".substr($objArr[25],0,2). "',";
                    $strSql .= "'".$objArr[26]."')";
                    //echo $strSql . "<br>";
                    
                    $statement = $conn->prepare($strSql);
                    $statement->execute();
                }
            }
            fclose($objCSV);
        }        
        catch (Exception $e)
        {
            echo $strSql . "<br>";            
            echo "<label style='color:red'>... Error ...". $e->getMessage() ."</label>" . "<br><br>";
            $lPass = false;
        }        

        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....Upload data = ". $nCurRec . " Records </label>" . "<br><br>";
        }
        else
        {
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }
        
        $returnResult[0] =$lPass;        
        $returnResult[1] =$aBillDoc;        

        return $returnResult;        
    }

    function upload_COA_VL06O_to_database()
    {
        try
        {
            $lPass = true;
            $nCurRec = 0;            
            $aBillDoc = array();            
            $currentBill = '';

            echo "<label>Process 5. Upload CSV file from server folder to Database Server</label><br>";            

            $objCSV = fopen("temps/" . $_FILES["param_fileCSV"]["name"], "r");
            while (($objArr = fgetcsv($objCSV, 10000, ",")) !== FALSE)
            {
                $nCurRec +=1;                
                //echo $objArr[1] . "<br>";

                if($nCurRec > 1)
                {                                        
                    if ($currentBill != $objArr[0])
                    {
                        if (! in_array($objArr[0], $aBillDoc)) 
                        {
                            array_push($aBillDoc, $objArr[0]);
                            $currentBill = $objArr[0];                            
                        }
                    }

                    include('include/db_Conn.php');
                    $strSql = "INSERT INTO COA_VL06O ";
                    $strSql .= "VALUES (";
                    $strSql .= "'".$objArr[0]."',";
                    $strSql .= "'".$objArr[1]."',";
                    $strSql .= "'".$objArr[2]."',";
                    $strSql .= "'".$objArr[3]."',";
                    $strSql .= "". intval(str_replace(',','',$objArr[4])) .",";
                    $strSql .= "'".$objArr[5]."',";                    
                    $strSql .= "'20".substr($objArr[6],6,2)."/".substr($objArr[6],3,2)."/".substr($objArr[6],0,2). "',";                    
                    $strSql .= "'".$objArr[7]."',";
                    $strSql .= "'".$objArr[8]."')";
                    //echo $strSql . "<br>";
                    
                    $statement = $conn->prepare($strSql);
                    $statement->execute();
                }
            }
            fclose($objCSV);
        }        
        catch (Exception $e)
        {
            echo $strSql . "<br>";            
            echo "<label style='color:red'>... Error ...". $e->getMessage() ."</label>" . "<br><br>";
            $lPass = false;
        }        

        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....Upload data = ". ($nCurRec-1) . " Records </label>" . "<br><br>";
        }
        else
        {
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }
        
        $returnResult[0] =$lPass;        
        $returnResult[1] =$aBillDoc;        

        return $returnResult;        
    }

    function Insert_History_Upload_COA_SalesData($aInvoiceNo, $user_email, $table_Name) 
    {
        try
        {
            $lPass = true;
            $nCurRec = 0;
            echo "<label>Process 6. Insert data into history report</label><br>";

            sort($aInvoiceNo);
            /*
            echo count($aInvoiceNo) . "<br>";
            print_r(array_values($aInvoiceNo));
            echo "<br>";
            */
            //echo $user_email;
            
            foreach ($aInvoiceNo as $keyInv => $valueInv)
            {
                $nCurRec += 1;
                /*                
                echo $keyInv . "<br>";
                echo $aInvoiceNo[$keyInv][0] . "<br>";
                echo $aInvoiceNo[$keyInv][1] . "<br>";
                */

                include('include/db_Conn.php');
            
                $strSql = "INSERT INTO TRANS_History_Upload_COA_SalesData ";
                $strSql .= "VALUES(";
                $strSql .= "'" .  $aInvoiceNo[$keyInv][0] . "',";
                $strSql .= "'" .  $aInvoiceNo[$keyInv][1] . "',";
                $strSql .= "'" . "20" . substr($aInvoiceNo[$keyInv][2],6,2) . "/" . substr($aInvoiceNo[$keyInv][2],3,2) . "/" . substr($aInvoiceNo[$keyInv][2],0,2) . "'," ;
                $strSql .= "'" . date('Y/m/d H:i:s') . "',";
                $strSql .= "'" . $user_email . "',";
                $strSql .= "'" . $table_Name . "',";
                $strSql .= "'Complete')";
                echo $strSql . "<br>";

                $statement = $conn->prepare($strSql,array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $statement->execute();                                
                //$nRecCount = $statement->rowCount();
            }
        }
        catch(PDOException $e)
        {
            $lPass = false;
            echo $strSql . "<br>";
            echo $e->getMessage() . "<br>";          
        }

        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....Upload data = ". $nCurRec ." invoices  </label>" . "<br><br>";
        }
        else
        {            
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }

        return $lPass;
    }

    function Insert_History_Upload_COA_QcDataHeader($aCustomerMaterial, $user_email, $table_Name) 
    {
        try
        {
            $lPass = true;
            $nCurRec = 0;
            echo "<label>Process 6. Insert data into history report</label><br>";

            sort($aCustomerMaterial);            
            //print_r(array_values($aCustomerMaterial));
            //echo $user_email;
            
            foreach ($aCustomerMaterial as $keyCustMat => $valueCustMat)
            {
                $nCurRec += 1;
                //echo $nCurRec . "<br>";
                //echo $value ;
                
                include('include/db_Conn.php');
    
                $strSql = "INSERT INTO TRANS_History_Upload_COA_QcDataHeader ";
                $strSql .= "VALUES(";
                $strSql .= "'" . $aCustomerMaterial[$keyCustMat][0] . "',";
                $strSql .= "'" . $aCustomerMaterial[$keyCustMat][1] . "',";
                $strSql .= "'" . date('Y/m/d H:i:s') . "',";
                $strSql .= "'" . $user_email . "',";
                $strSql .= "'" . $table_Name . "',";
                $strSql .= "'Complete')";
                //echo $strSql . "<br>";
            
                $statement = $conn->prepare($strSql,array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $statement->execute();
                //$nRecCount = $statement->rowCount();                    
            }
        }
        catch(PDOException $e)
        {
            $lPass = false;
            echo $strSql . "<br>";
            echo $e->getMessage() . "<br>";          
        }

        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....Upload data = ". $nCurRec ." Records </label>" . "<br><br>";
        }
        else
        {            
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }

        return $lPass;
    }

    function Insert_History_Upload_COA_QcDataDetail($aMaterialLotno, $user_email, $table_Name) 
    {
        try
        {
            $lPass = true;
            $nCurRec = 0;
            echo "<label>Process 6. Insert data into history report</label><br>";

            sort($aMaterialLotno);
            //print_r(array_values($aMaterialLotno));
            //echo $user_email;
            
            foreach ($aMaterialLotno as $keyMatLot =>$valueMatLot)
            {
                $nCurRec += 1;
                //echo $nCurRec . "<br>" ;
                //echo $value ;

                include('include/db_Conn.php');
    
                $strSql = "INSERT INTO TRANS_History_Upload_COA_QcDataDetail ";
                $strSql .= "VALUES(";
                $strSql .= "'" . $aMaterialLotno[$keyMatLot][0] . "',";
                $strSql .= "'" . $aMaterialLotno[$keyMatLot][1] . "',";                
                $strSql .= "'" . date('Y/m/d H:i:s') . "',";
                $strSql .= "'" . $user_email . "',";
                $strSql .= "'" . $table_Name . "',";
                $strSql .= "'Complete')";
                //echo $strSql . "<br>";
            
                $statement = $conn->prepare($strSql,array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $statement->execute();
                //$nRecCount = $statement->rowCount();
            }
        }
        catch(PDOException $e)
        {
            $lPass = false;
            echo $strSql . "<br>";
            echo $e->getMessage() . "<br>";          
        }

        if ($lPass == true)
        {
            //echo "<label style='color:green'>... Pass ....Upload data = ". $nCurRec ." Items [Material + Batch] </label>" . "<br><br>";
        }
        else
        {            
            //echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }

        return $lPass;
    }

    function Insert_History_Upload_COA_VF05($aBillDoc, $user_email, $table_Name)
    {
        try
        {
            $lPass = true;
            $nCurRec = 0;
            echo "<label>Process 6. Insert data into history report</label><br>";

            sort($aBillDoc);
            //print_r(array_values($aBillDoc));
            //echo $user_email;
            
            foreach ($aBillDoc as $valueBill)
            {
                $nCurRec += 1;
                //echo $value ;
               
                include('include/db_Conn.php');
    
                $strSql = "INSERT INTO TRANS_History_Upload_COA_VF05 ";
                $strSql .= "VALUES(";
                $strSql .= "'" . $valueBill . "',";
                $strSql .= "'" . date('Y/m/d H:i:s') . "',";
                $strSql .= "'" . $user_email . "',";
                $strSql .= "'" . $table_Name . "',";
                $strSql .= "'Complete')";
                //echo $strSql . "<br>";
            
                $statement = $conn->prepare($strSql,array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $statement->execute();
                //$nRecCount = $statement->rowCount();               
            }
        }
        catch(PDOException $e)
        {
            $lPass = false;
            echo $strSql . "<br>";
            echo $e->getMessage() . "<br>";          
        }

        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....Upload data = ". $nCurRec ." Inspection Lot. </label>" . "<br><br>";
        }
        else
        {            
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }

        return $lPass;
    }

    function Insert_History_Upload_COA_VL06O($aDeliveryNo, $user_email, $table_Name)
    {
        try
        {
            $lPass = true;
            $nCurRec = 0;
            echo "<label>Process 6. Insert data into history report</label><br>";

            sort($aDeliveryNo);
            //print_r(array_values($aBillDoc));
            //echo $user_email;
            
            foreach ($aDeliveryNo as $valueDelNo)
            {
                $nCurRec += 1;
                //echo $value ;
               
                include('include/db_Conn.php');
    
                $strSql = "INSERT INTO TRANS_History_Upload_COA_VL06O ";
                $strSql .= "VALUES(";
                $strSql .= "'" . $valueDelNo . "',";
                $strSql .= "'" . date('Y/m/d H:i:s') . "',";
                $strSql .= "'" . $user_email . "',";
                $strSql .= "'" . $table_Name . "',";
                $strSql .= "'Complete')";
                //echo $strSql . "<br>";
            
                $statement = $conn->prepare($strSql,array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $statement->execute();
                //$nRecCount = $statement->rowCount();               
            }
        }
        catch(PDOException $e)
        {
            $lPass = false;
            echo $strSql . "<br>";
            echo $e->getMessage() . "<br>";          
        }

        if ($lPass == true)
        {
            echo "<label style='color:green'>... Pass ....Upload data = ". $nCurRec ." Delivery No. </label>" . "<br><br>";
        }
        else
        {            
            echo "<label style='color:red'>... Error ...</label>" . "<br><br>";
        }

        return $lPass;
    }
?>