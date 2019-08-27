<h3 style="color:red">Status of upload Batch NO. [VF05] :</h3>

<div class='table-responsive'>    
    <table class='table table-bordered table-hover' id='myTable_COA_VF05' style='width:100%;' align="center">
        <thead> 
            <tr class='info'>
                <th class='text-center'>Invoice No.</th>
                <th class='text-center'>Upload Date</th>
                <th class='text-center'>Upload Time</th>
                <th class='text-center'>Upload By</th>
                <th class='text-center'>Table Name</th>
                <th class='text-center'>Status</th>           
            </tr>
        </thead>
        <tbody>

<?php
        /*---------------------*/
        /*--- Query User-ID ---*/
        /*---------------------*/
        include_once('include/db_Conn.php');        
        $strSql = "SELECT TOP 5 * " ;
        //$strSql = "SELECT * ";
        $strSql .= "FROM TRANS_History_Upload_COA_VF05 ";
        $strSql .= "ORDER BY invoice_no DESC";
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
                    <td><?php echo $ds['invoice_no']; ?></td>
                    <!--<td class='text-center'><?php //echo date("Y/m/d", strtotime($ds['upload_date'])); ?></td>-->
                    <td class='text-center'><?php echo date("d/M/Y", strtotime($ds['upload_date'])); ?></td>
                    <td class='text-center'><?php echo date("H:i:s", strtotime($ds['upload_date'])); ?></td>
                    <td><?php echo $ds['upload_by']; ?></td>
                    <td><?php echo $ds['upload_menu']; ?></td>
                    <td class='text-center'><?php echo $ds['upload_status']; ?></td>
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