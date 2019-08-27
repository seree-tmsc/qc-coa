<h3 style="color:red">Status of upload inspection result :</h3>

<div class='table-responsive'>    
    <table class='table table-bordered table-hover' id='myTable' style='width:100%;' align="center">
        <thead> 
            <tr class='info'>
                <th class='text-center'>Data Date</th>
                <th class='text-center'>Upload Date</th>
                <th class='text-center'>Upload Time</th>
                <th class='text-center'>Upload By</th>
                <th class='text-center'>Upload Data</th>
                <th class='text-center'>Upload Status</th>                
            </tr>
        </thead>
        <tbody>

<?php
        /*---------------------*/
        /*--- Query User-ID ---*/
        /*---------------------*/
        include_once('include/db_Conn.php');
        //$strSql = "SELECT TOP 5 * " ;
        $strSql = "SELECT * " ;
        $strSql .= "FROM TRANS_History_Using " ;
        $strSql .= "ORDER BY data_date DESC, ent_date DESC";
        //echo $strSql . "<br>";

        $statement = $conn->prepare($strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));                    
        $statement->execute();
        //$result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $nRecCount = $statement->rowCount();

        if ($nRecCount > 0)
        {
            while ($ds = $statement->fetch(PDO::FETCH_NAMED))
            {
?>                        
                <tr>
                    <td class='text-center'><?php echo date("d/M/Y", strtotime($ds['data_date'])); ?></td>                                        
                    <td class='text-center'><?php echo date("d/M/Y", strtotime($ds['ent_date'])); ?></td>
                    <td class='text-center'><?php echo date("H:i:s", strtotime($ds['ent_date'])); ?></td>
                    <td><?php echo $ds['user_email']; ?></td>
                    <td><?php echo $ds['menu']; ?></td>
                    <td class='text-center'><?php echo $ds['status']; ?></td>                    
                </tr>
<?php                    
            }
        }
        else
        {
?>
            <tr>                
                <td class='text-center'>No data</td>
                <td class='text-center'>-</td>
                <td class='text-center'>-</td>
                <td class='text-center'>-</td>
                <td class='text-center'>-</td>
                <td class='text-center'>-</td>                
            </tr> 
<?php            
        }
        
?>
        </tbody>
    </table>
</div>