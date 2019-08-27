<h3 style="color:red">Status of upload Table COA_QcDataDetail :</h3>

<div class='table-responsive'>    
    <table class='table table-bordered table-hover' id='myTable_COA_QcDataDetail' style='width:100%;'>    
        <thead> 
            <tr class='info'>
                <th class='text-center'>Created On</th>
                <th class='text-center'>Material Code</th>
                <th class='text-center'>Material Name</th>
                <th class='text-center'>Lot No.</th>                
                <th class='text-center'>Upload Date</th>
                <th class='text-center'>Upload Time</th>                
                <?php
                    if($param_inspectionDataMode == 'delete')
                    {
                        echo "<th class='text-center'>Delete</th>";
                    }
                    else
                    {
                        echo "<th class='text-center'>Upload By</th>";
                        echo "<th class='text-center'>Table Name</th>";
                        echo "<th class='text-center'>Status</th>";
                    }
                ?>
            </tr>
        </thead>
        <tbody>

<?php
        /*---------------------*/
        /*--- Query User-ID ---*/
        /*---------------------*/
        include_once('include/db_Conn.php');
        if($param_inspectionDataMode == 'delete')
        {
            $strSql = "SELECT Q.[Created on],T.material, M.[Material Name], T.batch, T.upload_date, T.upload_by, T.upload_menu, T.upload_status ";
        }
        else
        {
            $strSql = "SELECT TOP 5 Q.[Created on],T.material, M.[Material Name], T.batch, T.upload_date, T.upload_by, T.upload_menu, T.upload_status " ;
        }
        $strSql .= "FROM TRANS_History_Upload_COA_QcDataDetail T ";
        $strSql .= "JOIN COA_QcDataDetail Q ON Q.Material = T.material AND Q.Batch = T.batch ";
        $strSql .= "JOIN COA_MaterialData M ON Q.Material = M.[Material Code] ";
        $strSql .= "GROUP BY Q.[Created on], T.material, M.[Material Name], T.batch, T.upload_date, T.upload_by, T.upload_menu, T.upload_status ";
        $strSql .= "ORDER BY Q.[Created on] DESC, T.material, T.batch ";
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
                    <td><?php echo date('d/M/Y', strtotime($ds['Created on'])); ?></td>
                    <td><?php echo $ds['material']; ?></td>
                    <td><?php echo $ds['Material Name']; ?></td>
                    <td class='text-center'><?php echo $ds['batch']; ?></td>                    
                    <!--<td class='text-center'><?php //echo date("Y/m/d", strtotime($ds['upload_date'])); ?></td>-->
                    <td class='text-center'><?php echo date("d/M/Y", strtotime($ds['upload_date'])); ?></td>
                    <td class='text-center'><?php echo date("H:i:s", strtotime($ds['upload_date'])); ?></td>
                    <?php
                        if($param_inspectionDataMode == 'delete')
                        {
                            echo "<td class='text-center'>";
                            echo "<a href='#' class='delete-data' mat_code='" . $ds['material'] . "' mat_lot='" . trim($ds['batch']) . "'>";
                            echo "<span class='fa fa-trash-o fa-lg' style='color:red'></span>";
                            echo "</a>";
                            echo "</td>";
                        }
                        else
                        {
                            echo "<td>" . $ds['upload_by'] . "</td>";
                            echo "<td>" . $ds['upload_menu'] . "</td>";
                            echo "<td class='text-center'>" . $ds['upload_status'] . "</td>";
                        }
                    ?>
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
        <script>
            $(document).ready(function(){
                //alert('Run script!');

                $("#myTable_COA_QcDataDetail").on("click", ".delete-data", function(){
                    alert('click delete btn');

                    var code = $(this).attr("mat_code");
                    var lot = $(this).attr("mat_lot");
                    alert(code);
                    alert(lot);                    
                    
                    var lConfirm = confirm("Do you want to delete this record?");
                    if(lConfirm)
                    {
                        var lCode = prompt("Please input delete code...!");
                        if (lCode == 'ThaiMitsui')
                        {
                            $.ajax({
                                url: "pDelete_InspectionData.php",
                                method: "post",
                                data: {code: code, lot: lot},
                                success: function(data){
                                    location.reload();
                                }
                            });
                        }
                        else
                        {
                            alert('Can not delete this record...!');
                        }
                    }                    
                });
            });
        </script>

        </tbody>
    </table>
</div>