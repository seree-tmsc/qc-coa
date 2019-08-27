<?php
    try
    {
        require_once('include/db_Conn.php');
        $strSql = "SELECT * ";
        $strSql .= "FROM COA_SalesData ";
        $strSql .= "ORDER BY [Invoice No], [Invoice Line Item No] ";
        //echo $strSql . "<br>";

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
                $html_tag .= $ds["Invoice No"] . " / ";
                $html_tag .= $ds["Customer purchase order number"] . " / ";
                $html_tag .= $ds["Bill-to Party"] . " / ";
                $html_tag .= $ds["Bill-to Name"] . " / ";
                $html_tag .= $ds["Invoice Line Item No"] . " / ";
                $html_tag .= $ds["Material"] . " / ";
                $html_tag .= $ds["Material Description"] . " / ";
                $html_tag .= number_format($ds["Quantity"], 0, '.', ',') . "'>";
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