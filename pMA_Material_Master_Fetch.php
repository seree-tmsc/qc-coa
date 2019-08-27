<?php    
    //echo $_POST['id'] . "<br>";
    
    include('include/db_Conn.php');

    $strSql = "SELECT * ";
    $strSql .= "FROM COA_MaterialData ";                
    $strSql .= "WHERE [material code] ='" . $_POST['id'] . "' ";
    //echo $strSql . "<br>";

    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
    $statement->execute();  
    $nRecCount = $statement->rowCount();

    if ($nRecCount == 1)
    {
        $ds = $statement->fetch(PDO::FETCH_NAMED);
        echo json_encode($ds);
    }
?>