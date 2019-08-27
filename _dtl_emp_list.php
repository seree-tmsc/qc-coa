<?php
    try
    {
        require_once('include/db_Conn.php');
        $strSql = "SELECT * ";
        $strSql .= "FROM Emp_Main ";
        $strSql .= "WHERE (emp_code like 'zq%' ";
        $strSql .= "OR emp_code like '%w%') ";
        $strSql .= "ORDER BY emp_code ";

        $statement = $conn2->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
        $statement->execute();  
        $nRecCount = $statement->rowCount();
        //echo $nRecCount . " records <br>";
            
        if ($nRecCount >0)
        {
            $html_tag = "<input id='dtl_emp_list' list='myBrowse' name='param_emp_list' 
                            class='form-control'  onchange='Func_Display_Emp_List()' required>
                        </input>";           
            $html_tag .= "<datalist id='myBrowse'>";
            while ($ds = $statement->fetch(PDO::FETCH_NAMED))            
            {                
                //echo $ds['Emp_Code'] . '<br>';
                $html_tag .= "<option value=" . $ds["emp_code"] . "/" . $ds["emp_tfname"] . "/" . $ds["emp_tlname"] . ">" . "Code-FName-LName" . "</option>";
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