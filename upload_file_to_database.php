<?php
    try
    {
        if($lPass)
        {
            /* ---------------------------------------------------- */
            echo "<label>Process 4. Upload data.</label><br>";
            $nCurRec_No = 0;
            $nUpload_Error = 0;                                    
            while (($objArr = fgetcsv($objCSV, 10000, ",")) !== FALSE)
            {
                $nCurRec_No +=1;
                echo $nCurRec_No . "<br>";
                if ($nCurRec_No == 1)
                {
                    foreach ($objArr as $key => $value)
                    {
                        if($key == 1)
                        {
                            $dData_Date = substr($value,6,2) . substr($value,3,2) . substr($value,0,2);

                            include('include/db_Conn.php');
                            $strSql = "SELECT * ";
                            $strSql .= "FROM TRANS_History_Using ";
                            $strSql .= "WHERE data_date='" . $dData_Date . "' " ;
                            $strSql .= "AND status ='C'" ;
                            //echo $strSql . "<br>";
                        
                            $statement = $conn->prepare($strSql,array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                            $statement->execute();                                            
                            $nRecCount = $statement->rowCount();            
                            
                            if ($nRecCount !== 0)
                            {
                                fclose($objCSV);
                                echo "<label style='color:red'>Error Porcess #4 ...". $value . " You have ever uploaded this data / You can't upload this data" . "</label><br>";
                                //exit;
                            }
                        }                                                
                    }
                }
                /* ----------------------------------- */
                /* ------ insert into database ------- */
                /* ----------------------------------- */
                //echo $objArr[1] . "<br>";


                $strSql = "INSERT INTO COA_Sales_Data ";
                $strSql .= "([Sales office Description], [Invoice No], [Invoice Line Item No],";
                $strSql .= "Material, Quantity, UOM, [Sales Order No], [Sales Order Item No], [Sales Order Type], [Customer purchase order number]," ;
                $strSql .= "[Payment Terms], [Sold-to Party], [Sold-to Name], [Ship-to Party], [Ship-to Name], ";
                $strSql .= "[Bill-to Party], [Bill-to Name], [Payer], [Payer Name], [Sales Rep], [Sales Rep Name], [Material Description]) ";
                $strSql .= "VALUES (";
                $strSql .= "'".$objArr[0]."',";
                $strSql .= "'20".substr($objArr[1],6,2)."/".substr($objArr[1],3,2)."/".substr($objArr[1],0,2). "',";
                $strSql .= "'".$objArr[2]."',";
                $strSql .= "'".$objArr[3]."',";
                $strSql .= "'".$objArr[4]."',";
                $strSql .= "'".$objArr[5]."',";
                $strSql .= "'20".substr($objArr[6],6,2)."/".substr($objArr[6],3,2)."/".substr($objArr[6],0,2). "',";
                $strSql .= "'".$objArr[7]."',";
                $strSql .= "".str_replace(',','',$objArr[8]).",";
                $strSql .= "'".$objArr[9]."',";
                $strSql .= "'".$objArr[10]."',";
                $strSql .= "'20".substr($objArr[11],6,2)."/".substr($objArr[11],3,2)."/".substr($objArr[11],0,2). "',";
                $strSql .= "'".$objArr[12]."',";
                $strSql .= "'".$objArr[13]."',";                                
                $strSql .= "'".$objArr[14]."',";
                $strSql .= "'".$objArr[15]."',";
                $strSql .= "'".$objArr[16]."',";
                $strSql .= "".$objArr[17].",";
                $strSql .= "".$objArr[18].",";
                $strSql .= "'".$objArr[19]."',";
                $strSql .= "".$objArr[20].",";
                $strSql .= "'".$objArr[21]."')";
                //echo $strSql . "<br>";
                
                $statement = $conn->prepare($strSql);
                $statement->execute();
                $nRecCount = $statement->rowCount();
                //echo $nRecCount . "<br>";

                if ($nRecCount == 0)
                {
                    $nUpload_Error += 1;
                    echo "<label style='color:red'>&nbsp Row number " . $nCurRec_No ." not corect </label><br>";
                }
            }
            Insert_History_Using($dData_Date, date("Y/m/d h:i:sa"), $_POST['param_email'], "UPLOAD INSPECTION RESULT", "C");
        }
        else
        {
            echo 'Error Message: ';
            $lPass = false;
        }
    }
    catch (Exception $e)
    {
        echo 'Error Message: ' .$e->getMessage();
        $lPass = false;
    }
?>