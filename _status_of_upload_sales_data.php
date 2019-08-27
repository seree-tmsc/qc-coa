<h3 style="color:red">Status of upload sales data :</h3>

<div class='table-responsive'>    
    <table class='table table-bordered table-hover' id='myTable' style='width:100%;' align="center">
        <thead> 
            <tr class='info'>
                <th class='text-center'>Tran.-ID</th>
                <th class='text-center'>Enter Date</th>
                <th class='text-center'>Enter Time</th>
                <th class='text-center'>User [email]</th>
                <th class='text-center'>Menu Name</th>
                <th class='text-center'>Status</th>
                <th class='text-center'>Error</th>
            </tr>
        </thead>
        <tbody>

<?php
        /*---------------------*/
        /*--- Query User-ID ---*/
        /*---------------------*/
        include_once('include/db_Conn.php');
        $strSql = "SELECT TOP 5 * " ;
        $strSql .= "FROM TRANS_History_Using " ;
        $strSql .= "WHERE menu = 'upload sales data' " ;
        $strSql .= "ORDER BY trans_id DESC";
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
                    <td class='text-center'><?php //echo $ds['trans_id']; ?></td>                                        
                    <td class='text-center'><?php echo date("d/M/Y", strtotime($ds['ent_date'])); ?></td>
                    <td class='text-center'><?php echo date("H:i:s", strtotime($ds['ent_date'])); ?></td>
                    <td><?php echo $ds['user_email']; ?></td>
                    <td><?php echo $ds['menu']; ?></td>
                    <td class='text-center'><?php echo $ds['status']; ?></td>
                    <td class='text-right'><?php echo $ds['error']; ?></td>
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
                <td class='text-center'>-</td>
            </tr> 
<?php            
        }
?>
        </tbody>
    </table>
</div>