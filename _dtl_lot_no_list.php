<?php
    try
    {
        echo "<p id='var1'></p>";
        require_once('include/db_Conn.php');
        $strSql = "SELECT * ";
        $strSql .= "FROM COA_VF05 ";
        $strSql .= "WHERE [Bill Doc]='" ;
        $strSql .= trim($_POST['param_invoice_no']) . "' ";
        $strSql .= "AND Material='" ;
        $strSql .= trim($_POST['param_material']) . "' ";
        $strSql .= "ORDER BY [Bill Doc], Item ";
        echo $strSql . "<br>";

        $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
        $statement->execute();  
        $nRecCount = $statement->rowCount();
        //echo $nRecCount . " records <br>";
            
        if ($nRecCount >0)
        {
            $html_tag = "<input id='dtl_sales_data_list' 
                            list='myBrowse' 
                            name='param_sales_data_list' 
                            class='form-control'  
                            onchange='Func_Display_Sales_Data_List()' 
                            required>
                        </input>";           
            $html_tag .= "<datalist id='myBrowse'>";

            while ($ds = $statement->fetch(PDO::FETCH_NAMED))            
            {                
                //echo $ds['Emp_Code'] . '<br>';
                $html_tag .= "<option value='" ;
                $html_tag .= $ds["Item"] . " / ";
                $html_tag .= $ds["Batch"] . " / ";
                $html_tag .= number_format($ds["Bill qty"], 0, '.', ',') . "'>";
                $html_tag .= "</option>";
            }
            $html_tag .= "</datalist>";            
        }
        else
        {
            echo "No data";
        }
        echo $html_tag;    
    }
    catch(PDOException $e)
    {        
        echo $e->getMessage();
    }
?>