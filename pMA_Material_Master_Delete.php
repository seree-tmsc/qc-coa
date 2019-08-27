<?php
    //echo $_POST["id"] . "<br>";

    try
    {
        include('include/db_Conn.php');
        $strSql = "DELETE FROM COA_MaterialData ";
        $strSql .= "WHERE [Material Code]='" . $_POST["id"] . "' ";
        echo $strSql . "<br>";
    
        $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
        $statement->execute();

        $nRecCount = $statement->rowCount();
        //echo $nRecCount . "<br>";
    }
    catch(PDOException $e)
    {        
        echo $e->getMessage();        
    }
?>