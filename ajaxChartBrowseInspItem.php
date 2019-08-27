<?php   
    require_once('include/db_Conn.php');
    
    $strSql = "SELECT [Short text for the characteristic] ";
    $strSql .= "FROM COA_QcDataDetail ";
    $strSql .= "WHERE [Material]='" . $_GET['id1'] . "' ";
    $strSql .= "GROUP BY [Short text for the characteristic] ";
    $strSql .= "ORDER BY [Short text for the characteristic] ";
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
            $cValueTemp = $ds['Short text for the characteristic'] ;
            $cKeyTemp = $ds['Short text for the characteristic'];
            $json[$cKeyTemp] = $cValueTemp;
        }
        echo json_encode($json);
    }   
?>