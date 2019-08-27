<?php   
    require_once('include/db_Conn.php');
    
    $strSql = "SELECT * ";
    $strSql .= "FROM COA_QcDataHeader Q ";
    $strSql .= "JOIN COA_MaterialData M ON M.[Material Code] = Q.Material ";
    $strSql .= "WHERE Customer='" . $_GET['id1'] . "' ";
    $strSql .= "ORDER BY Q.Material";
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
            $cValueTemp = $ds['Material Name'] . "/" . $ds['Material'];
            $cKeyTemp = $ds['Material'];
            $json[$cKeyTemp] = $cValueTemp;
        }
        echo json_encode($json);
    }   
?>