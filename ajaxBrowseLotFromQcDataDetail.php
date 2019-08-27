<?php   
    require_once('include/db_Conn.php');
    
    $strSql = "SELECT * ";
    $strSql .= "FROM COA_QcDataDetail ";
    $strSql .= "WHERE Material='" . $_GET['id1'] . "' ";    
    $strSql .= "ORDER BY SUBSTRING(Batch,3,1), SUBSTRING(Batch,2,1), SUBSTRING(Batch,4,3)";
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
            $cValueTemp = $ds['Batch'];
            $cKeyTemp = $ds['Batch'];
            $json[$cKeyTemp] = $cValueTemp;
        }
        echo json_encode($json);
    }   
?>