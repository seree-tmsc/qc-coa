<?php   
    require_once('include/db_Conn.php');
    
    $strSql = "SELECT * ";
    $strSql .= "FROM COA_VL06O V ";
    $strSql .= "JOIN COA_MaterialData M ON M.[Material Code] = V.Material ";
    $strSql .= "WHERE Delivery='" . $_GET['id'] . "' ";
    $strSql .= "AND [Delivery quantity] > 0 ";
    //$strSql .= "ORDER BY SUBSTRING(Batch,3,1), SUBSTRING(Batch,2,1), SUBSTRING(Batch,4,3)";
    $strSql .= "ORDER BY Material, item ";
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
            $cValueTemp = $ds['Material Name'] . " - " . $ds['Material'] . " - " . $ds['Batch'] . " - " .$ds['Delivery quantity'];
            $cKeyTemp = $ds['Material'] . "/" .$ds['Batch'] . "/" .(int)$ds['Delivery quantity'];
            $json[$cKeyTemp] = $cValueTemp;
        }
        echo json_encode($json);
    }   
?>