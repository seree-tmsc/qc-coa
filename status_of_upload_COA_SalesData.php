<h3 style="color:red">Status of upload SalesData [ZPSD_R0001_SALESREPT] :</h3>
<!--<marquee behavior="scroll" direction="left">Status of upload Table COA_SalesData!</marquee>-->

<div class='table-responsive'>    
    <table class='table table-bordered table-hover' id='myTable' style='width:100%;' align="center">
        <thead> 
            <tr class='info'>
                <th class='text-center'>Invoice No.</th>
                <th class='text-center'>Delivery No.</th>
                <th class='text-center'>Invoice Date</th>
                <th class='text-center'>Upload Date</th>
                <th class='text-center'>Upload Time</th>
                <th class='text-center'>Upload By</th>
                <th class='text-center'>Table Name</th>
                <th class='text-center'>Status</th>
                <?php
                    if($param_salesDataMode == 'delete')
                    {
                        echo "<th class='text-center'>Delete</th>";
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
        if($param_salesDataMode == 'delete')
        {
            $strSql = "SELECT * " ;
        }
        else
        {
            $strSql = "SELECT TOP 10 * " ;
        }
        $strSql .= "FROM TRANS_History_Upload_COA_SalesData " ;        
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
                    <td><?php echo $ds['delivery_no']; ?></td>
                    <td class='text-center'><?php echo date("d/M/Y", strtotime($ds['invoice_date'])); ?></td>
                    <td class='text-center'><?php echo date("d/M/Y", strtotime($ds['upload_date'])); ?></td>
                    <td class='text-center'><?php echo date("H:i:s", strtotime($ds['upload_date'])); ?></td>
                    <td><?php echo $ds['upload_by']; ?></td>
                    <td><?php echo $ds['upload_menu']; ?></td>
                    <td class='text-center'><?php echo $ds['upload_status']; ?></td>
                    <?php
                        if($param_salesDataMode == 'delete')
                        {
                            echo "<td class='text-center'>";
                            echo "<a href='#' class='delete-data' invoice_no='" . $ds['invoice_no'] . "' delivery_no='" . $ds['delivery_no'] . "'>";
                            echo "<span class='fa fa-trash-o fa-lg' style='color:red'></span>";
                            echo "</a>";
                            echo "</td>";
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

                $("#myTable").on("click", ".delete-data", function(){
                    //alert('class delete_data');
                    var inv_no = $(this).attr("invoice_no");
                    var del_no = $(this).attr("delivery_no");
                    //alert(inv_no);
                    
                    var lConfirm = confirm("Do you want to delete this record?");
                    if(lConfirm)
                    {
                        var lCode = prompt("Please input delete code...!");

                        if (lCode == 'ThaiMitsui')
                        {
                            //alert(lConfirm);
                            $.ajax({
                                url: "pDelete_SalesData.php",
                                method: "post",
                                data: {inv_no: inv_no, del_no: del_no,},
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