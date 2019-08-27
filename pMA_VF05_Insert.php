<?php
    /*
    echo $_POST['invNo'] . "<br>";
    echo $_POST['editmatCode'] . "<br>";    
    echo $_POST["lotNo"] . "<br>";
    echo $_POST["qty"] . "<br>";
    */
    
    try
    {        
        include('include/db_Conn.php');

        if($_POST["editmatCode"] != '')
        {            
            $strSql = "UPDATE COA_VF05 SET ";
            $strSql .= "[Bill qty]= " . $_POST["qty"] . " ";            
            $strSql .= "WHERE [Bill Doc] = '" . $_POST["invNo"] . "' ";
            $strSql .= "AND Material = '" . $_POST['editmatCode'] . "' ";
            $strSql .= "AND Batch = '" . $_POST['lotNo'] . "' ";
            //echo $strSql . "<br>";
    
            $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $statement->execute();  
            $nRecCount = $statement->rowCount();
            //echo $nRecCount . "<br>";
            if ($nRecCount == 1)
            {
                /*
                echo "<script> 
                        alert('Add data complete!'); 
                        window.location.href='pMA_User.php'; 
                    </script>";
                */
            }
            else
            {
                /*
                echo "<script> 
                        alert('Warning! Cannot add data!'); 
                        window.location.href='pMA_User.php'; 
                    </script>";
                */
            }
        }
        else
        {
            /*
            $strSql = "INSERT INTO COA_VF05 ";
            $strSql .= "VALUES(";
            $strSql .= "'" . $_POST["empCode"] . "',";
            $strSql .= "'" . $_POST["eMail"] . "',";
            $strSql .= "cast('" . strtolower($_POST["empCode"]) . "@1234' as binary)" . ",";
            $strSql .= "'" . $_POST["userType"] . "',";
            $strSql .= "'" . $_POST["createdDate"] . "', '') ";
            //echo $strSql . "<br>";
    
            $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $statement->execute();  
            $nRecCount = $statement->rowCount();
            //echo $nRecCount . "<br>";
            if ($nRecCount == 1)
            {                
                echo "<script> 
                        alert('Add data complete!'); 
                        window.location.href='pMA_User.php'; 
                    </script>";
            }
            else
            {       
                echo "<script> 
                        alert('Warning! Cannot add data!'); 
                        window.location.href='pMA_User.php'; 
                    </script>";
            }
            */
        }
    }
    catch(PDOException $e)
    {
        /*
        echo "<script> 
                alert('Error!" . substr($e->getMessage(),0,105) . " '); 
                window.location.href='pMA_User.php'; 
            </script>";
        */
        echo substr($e->getMessage(),0,105) ;
    }
?>