<?php
    /*
    echo $_POST['spec'] . "<br>";    
    echo $_POST["editmatCode"] . "<br>";
    echo $_FILES["photoLoc"]["name"] . "<br>";
    */
    
    try
    {
        include('include/db_Conn.php');

        if($_POST["editmatCode"] != '')
        {
            $strSql = "UPDATE COA_MaterialData SET ";
            $strSql .= "[Material Name]='" . $_POST["matName"] . "',  ";
            $strSql .= "[Shelf Life]=" . $_POST["shelfLife"] . ",  ";
            $strSql .= "[Shipment Condition]=N'" . $_POST["shipmentCond"] . "',  ";
            $strSql .= "[Storage Condition]=N'" . $_POST["storageCond"] . "',  ";
            $strSql .= "[Specification]='" . $_POST["spec"] . "',  ";
            $strSql .= "[Packing Size]=" . $_POST["packSize"] . "  ";
            if($_FILES["photoLoc1"]["name"] != '')
            {
                move_uploaded_file($_FILES["photoLoc1"]["tmp_name"], "images/".$_FILES["photoLoc1"]["name"]);
                $strSql .= ", [Photo of drum1]='images/" . $_FILES["photoLoc1"]["name"] . "' ";
            }
            if($_FILES["photoLoc2"]["name"] != '')
            {
                move_uploaded_file($_FILES["photoLoc2"]["tmp_name"], "images/".$_FILES["photoLoc2"]["name"]);
                $strSql .= ", [Photo of drum2]='images/" . $_FILES["photoLoc2"]["name"] . "' ";
            }            
            $strSql .= "WHERE [Material Code]='" . $_POST["editmatCode"] . "' ";
            echo $strSql;
    
            $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $statement->execute();  
            $nRecCount = $statement->rowCount();
            //echo $nRecCount . "<br>";
        }
        else
        {            
            //$_FILES["phptoLoc"]["name"] = "pic_" . $_POST["matCode"] . ".jpg";
            //echo $_FILES["phptoLoc"]["name"] . "<br>";
            // Copy/Upload CSV
            move_uploaded_file($_FILES["photoLoc1"]["tmp_name"], "images/".$_FILES["photoLoc1"]["name"]);
            move_uploaded_file($_FILES["photoLoc2"]["tmp_name"], "images/".$_FILES["photoLoc2"]["name"]);

            $strSql = "INSERT INTO COA_MaterialData ";
            $strSql .= "VALUES(";
            $strSql .= "'" . $_POST["matCode"] . "',";
            $strSql .= "'" . $_POST["matName"] . "',";
            $strSql .= "'" . $_POST["shelfLife"] . "',";
            $strSql .= "N'" . $_POST["shipmentCond"] . "',";
            $strSql .= "N'" . $_POST["storageCond"] . "',";
            $strSql .= "'" . $_POST["spec"] . "',";
            $strSql .= "" . $_POST["packSize"] . ", ";
            $strSql .= "'" . "images/" .$_FILES["photoLoc1"]["name"] . "', ";
            $strSql .= "'" . "images/" . $_FILES["photoLoc2"]["name"] . "') ";
            echo $strSql;
    
            $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $statement->execute();  
            //$nRecCount = $statement->rowCount();
            //echo $nRecCount . "<br>";
        }
    }
    catch(PDOException $e)
    {
        echo substr($e->getMessage(),0,105) ;
    }
?>