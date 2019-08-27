<?php
    /*
    echo $_POST["inv_no"] . "<br>";
    echo $_POST["del_no"] . "<br>";
    */

    try
    {
        include('include/db_Conn.php');

        $strSql = "DELETE FROM TRANS_History_Upload_COA_SalesData ";
        $strSql .= "WHERE invoice_no='" . $_POST["inv_no"] . "' ";
        $strSql .= "AND delivery_no='" . $_POST["del_no"] . "' ";
        //echo $strSql . "<br>";
        $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
        $statement->execute();
        $nRecCount = $statement->rowCount();
        //echo $nRecCount . "<br>";


        $strSql = "DELETE FROM COA_SalesData ";
        $strSql .= "WHERE [Invoice No]='" . $_POST["inv_no"] . "' ";
        $strSql .= "AND [Delivery No]='" . $_POST["del_no"] . "' ";
        //echo $strSql . "<br>";
        $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
        $statement->execute();


        $strSql = "DELETE FROM TRANS_History_Upload_COA_VL06O ";
        $strSql .= "WHERE delivery_no='" . $_POST["del_no"] . "' ";
        //echo $strSql . "<br>";
        $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
        $statement->execute();
        

        $strSql = "DELETE FROM COA_VL06O ";
        $strSql .= "WHERE Delivery='" . $_POST["del_no"] . "' ";
        //echo $strSql . "<br>";
        $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
        $statement->execute();
    }
    catch(PDOException $e)
    {        
        echo $e->getMessage();        
    }
?>