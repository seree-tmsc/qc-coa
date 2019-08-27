<?php
    try
    {
        require_once('include/db_Conn.php');
        $strSql = "SELECT material, [material description], batch ";
        $strSql .= "FROM TRANS_Inspection_Result ";
        $strSql .= "GROUP BY material, [material description], batch ";
        $strSql .= "ORDER BY material, [material description], batch ";

        $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
        $statement->execute();  
        $nRecCount = $statement->rowCount();
        //echo $nRecCount . " records <br>";
            
        if ($nRecCount >0)
        {
            $html_tag = "<input id='dtl_inspection_list_all' list='myBrowse' name='param_inspection_list_all' 
                            class='form-control'  onchange='Func_Display_Inspection_List_All()' required>
                        </input>";           
            $html_tag .= "<datalist id='myBrowse'>";

            while ($ds = $statement->fetch(PDO::FETCH_NAMED))            
            {                
                //echo $ds['Emp_Code'] . '<br>';
                $html_tag .= "<option value='" ;
                $html_tag .= $ds["material"] . " / ";
                $html_tag .= $ds["material description"] . " / ";
                $html_tag .= trim($ds["batch"]) . "'>";
                $html_tag .= "Code / Name / Lot" . "</option>";
                //$html_tag .= "</option>";
                 
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