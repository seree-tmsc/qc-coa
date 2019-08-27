<?php
    try
    {
        require_once('include/db_Conn.php');
        $strSql = "SELECT * ";
        $strSql .= "FROM MM60 ";
        $strSql .= "ORDER BY material, [material description] ";

        $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
        $statement->execute();  
        $nRecCount = $statement->rowCount();
        //echo $nRecCount . " records <br>";
            
        if ($nRecCount >0)
        {
            $html_tag = "<input id='dtl_material_list' list='myBrowse' name='param_material_list' 
                            class='form-control'  onchange='Func_Display_Material_List()' required>
                        </input>";           
            $html_tag .= "<datalist id='myBrowse'>";

            while ($ds = $statement->fetch(PDO::FETCH_NAMED))            
            {                
                //echo $ds['Emp_Code'] . '<br>';
                $html_tag .= "<option value='" ;
                $html_tag .= $ds["Material"] . " / ";
                $html_tag .= $ds["Material Description"] . "'>";
                $html_tag .= "Code0 - Name" . "</option>";
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