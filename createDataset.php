<?php
    /*
    echo $_POST['material-ddl'] ;
    echo $_POST['inspItem-ddl'] ;
    */
    
    require_once('include/db_Conn.php');
    $strSql = "SELECT Material, [Short text], [Upper Limit], [Lower Limit], [Qualitative MIC Specifications] ";
    $strSql .= "FROM COA_QcDataHeader ";
    //$strSql .= "WHERE Material='" . $_POST['material-ddl']. "' ";
    //$strSql .= "AND [Short text]='" . $_POST['inspItem-ddl']. "' ";
    $strSql .= "WHERE Material='ENR20SE65-DR000200' ";
    $strSql .= "AND [Short text]='Acid Value' ";
    $strSql .= "GROUP BY Material, [Short text], [Upper Limit], [Lower Limit], [Qualitative MIC Specifications] ";  
    $strSql .= "ORDER BY Material, [Short text], [Upper Limit], [Lower Limit], [Qualitative MIC Specifications] ";  
    echo $strSql . "<br>";
    
    
    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $statement->execute();  
    $nRecCount = $statement->rowCount();
    echo $nRecCount . " records <br>";    
        
    if ($nRecCount >0)
    {
        $ds = $statement->fetch(PDO::FETCH_NAMED);
        echo $ds['Upper Limit'] . "<br>";
        echo $ds['Lower Limit'] . "<br>";
        echo $ds['Qualitative MIC Specifications'] . "<br>";

        if($ds['Qualitative MIC Specifications'] == '')
        {
            $max = $ds['Upper Limit'];
            $min = $ds['Lower Limit'];
        }
        else
        {
            $max = 'N/A';
            $min = 'N/A';
        }
        
    }
    else
    {
        $max = 'N/A';
        $min = 'N/A';
    }
    

    $strSql = "SELECT * ";
    $strSql .= "FROM COA_QcDataDetail ";
    //$strSql .= "WHERE Material='" . $_POST['material-ddl']. "' ";
    //$strSql .= "AND [Short text for the characteristic]='" . $_POST['inspItem-ddl']. "' ";
    $strSql .= "WHERE Material='ENR20SE65-DR000200' ";
    $strSql .= "AND [Short text for the characteristic]='Acid Value' ";
    $strSql .= "ORDER BY SUBSTRING(Batch,3,1), SUBSTRING(Batch,2,1), SUBSTRING(Batch,4,3) ";  
    echo $strSql . "<br>";

    
    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
    $statement->execute();  
    $nRecCount = $statement->rowCount();
    echo $nRecCount . " records <br>";
        
    $nCurRec = 0;
    if ($nRecCount >0)
    {
        $aSeries1 = array();
        $aData1 = array();
        $aMax = array();
        $aMin = array();

        while ($ds = $statement->fetch(PDO::FETCH_NAMED))
        {
            $nCurRec +=1;
            echo $ds['Batch'] . "<br>";
            echo $ds['Original Value'] . "<br>";

            echo $min . "<br>";
            echo $max . "<br>";

            array_push($aSeries1, $ds['Batch']);
            array_push($aData1, $ds['Original Value']);
            array_push($aMax, $max);
            array_push($aMin, $min);
        }
    }

    echo json_encode($aMax);

?>