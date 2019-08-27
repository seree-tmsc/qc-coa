<?php   
    require_once('include/db_Conn.php');
    
    $strSql = "SELECT * ";
    $strSql .= "FROM COA_VF05 ";
    $strSql .= "WHERE [Bill Doc]='" . $_GET['id1'] . "' "; 
    $strSql .= "AND [Material]='". $_GET['id2'] . "' ";
    //echo $strSql . "<br>";

    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
    $statement->execute();  
    $nRecCount = $statement->rowCount();
    //echo $nRecCount . " records <br>";
        
    if ($nRecCount >0)
    {
        $json = [];
        while($ds = $statement->fetch(PDO::FETCH_NAMED))
        {            
            $cValueTemp = $ds['Item'] . ' / ' .$ds['Material'] . ' / ' . $ds['Description'] . ' / ' . $ds['Batch'] . ' / ' . $ds['Bill qty'];
            $cKeyTemp = $ds['Bill Doc'] . '/' .$ds['Item'] . '/'. $ds['Material'] . '/' . $ds['Batch'];
            $json[$cKeyTemp] = $cValueTemp;
        }
        echo json_encode($json);
    }   
?>