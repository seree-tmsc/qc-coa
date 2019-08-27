<?php    
    /*
    echo $_POST['doc'] . "<br>";
    echo $_POST['code'] . "<br>";
    echo $_POST['lot'] . "<br>";
    */
    
    include('include/db_Conn.php');

    $strSql = "SELECT * ";
    $strSql .= "FROM COA_VF05 ";                
    $strSql .= "WHERE [Bill Doc] = '" . $_POST['doc'] . "' ";
    $strSql .= "AND Material ='" . $_POST['code'] . "' ";
    $strSql .= "AND Batch ='" . $_POST['lot'] . "' ";
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