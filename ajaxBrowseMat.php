<?php   
    require_once('include/db_Conn.php');
    
    $strSql = "SELECT * ";
    $strSql .= "FROM COA_SalesData ";
    $strSql .= "WHERE [Invoice No]='". $_GET['id'] . "' "; 
    $strSql .= "ORDER BY [Invoice Line Item No] ";
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
            $cValueTemp = $ds['Invoice Line Item No'] . " / " . $ds['Material'] . " / " . $ds['Material Description'];
            $cValueTemp .= " / " . number_format($ds['Quantity'],0,'.',',');

            $cKeyTemp = $ds['Invoice No'].'/'.$ds['Material'];
            //$cKeyTemp = $ds['Material'];            
            $json[$cKeyTemp] = $cValueTemp;
        }
        echo json_encode($json);
    }   
?>