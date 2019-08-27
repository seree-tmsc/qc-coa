<?php
    /*
    echo $_POST['code'];
    echo $_POST['lot'];
    */

    try
    {
        include('include/db_Conn.php');

        $strSql = "DELETE FROM TRANS_History_Upload_COA_QcDataDetail ";
        $strSql .= "WHERE material='" . $_POST["code"] . "' ";
        $strSql .= "AND batch='" . $_POST["lot"] . "' ";
        //echo $strSql . "<br>";
        $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
        $statement->execute();
        $nRecCount = $statement->rowCount();
        //echo $nRecCount . "<br>";


        $strSql = "DELETE FROM COA_QcDataDetail ";
        $strSql .= "WHERE Material='" . $_POST["code"] . "' ";
        $strSql .= "AND Batch='" . $_POST["lot"] . "' ";
        //echo $strSql . "<br>";
        $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
        $statement->execute();
    }
    catch(PDOException $e)
    {        
        echo $e->getMessage();        
    }
?>