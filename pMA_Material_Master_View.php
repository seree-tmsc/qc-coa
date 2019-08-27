<?php
    include('include/db_Conn.php');

    $strSql = "SELECT * ";
    $strSql .= "FROM COA_MaterialData ";
    $strSql .= "WHERE [Material Code] ='" . $_POST['id'] . "' ";
    //echo $strSql . "<br>";

    $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
    $statement->execute();  
    $nRecCount = $statement->rowCount();
    
    $cOutput = "<div class='table-responsive'>";
    $cOutput .= "<table class='table table-hover'>";

    if ($nRecCount == 1)
    {
        $ds = $statement->fetch(PDO::FETCH_NAMED);
        $cOutput .= "<tr>";
        $cOutput .= "<td class='success' style='width:30%;'><label style='color:navy;'>Material Code :</label></td> ";
        $cOutput .= "<td class='info'>" . $ds['Material Code'] . "</td> ";
        $cOutput .= "</tr>";

        $cOutput .= "<tr>";
        $cOutput .= "<td class='success'><label style='color:navy;'>Material Description :</label></td> ";
        $cOutput .= "<td class='info'>" . $ds['Material Name'] . "</td> ";
        $cOutput .= "</tr>";

        $cOutput .= "<tr>";
        $cOutput .= "<td class='success'><label style='color:navy;'>Shelf Life:</label></td> ";
        $cOutput .= "<td class='info'>" . number_format($ds['Shelf Life'], 0, '.', ',') . "</td> ";
        $cOutput .= "</tr>";

        $cOutput .= "<tr>";
        $cOutput .= "<td class='success'><label style='color:navy;'>Pack size (Kgs.):</label></td> ";
        $cOutput .= "<td class='info'>" . number_format($ds['Packing Size'], 0, '.', ',') . "</td> ";
        $cOutput .= "</tr>";

        $cOutput .= "<tr>";
        $cOutput .= "<td class='success'><label style='color:navy;'>Shipment Condition :</label></td> ";
        $cOutput .= "<td class='info'>" . $ds['Shipment Condition'] . "</td> ";
        $cOutput .= "</tr>";

        $cOutput .= "<tr>";
        $cOutput .= "<td class='success'><label style='color:navy;'>Storage Condition :</label></td> ";
        $cOutput .= "<td class='info'>" . $ds['Storage Condition'] . "</td> ";
        $cOutput .= "</tr>";

        $cOutput .= "<tr>";
        $cOutput .= "<td class='success'><label style='color:navy;'>Specification :</label></td> ";
        $cOutput .= "<td class='info'>" . $ds['Specification'] . "</td> ";
        $cOutput .= "</tr>";

        $cOutput .= "<tr>";
        $cOutput .= "<td class='success'><label style='color:navy;'>Photo of drum:</label></td> ";
        $cOutput .= "<td class='info'>" . $ds['Photo of drum1'] . "</td> ";
        $cOutput .= "</tr>";

        $cOutput .= "<tr>";
        $cOutput .= "<td class='success'><label style='color:navy;'>Photo of drum:</label></td> ";
        $cOutput .= "<td class='info'>" . $ds['Photo of drum2'] . "</td> ";
        $cOutput .= "</tr>";
        
        $cOutput .= "</table>";
        $cOutput .= "</div>";
    }
    echo $cOutput;
?>