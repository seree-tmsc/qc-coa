<div class='table-responsive'>
    <table class='table table-bordered table-hover' id='myTableMaterial'>
        <thead>
            <!--<tr class='info'>-->
            <tr class='info'>
                <th class='text-center'>Material Code</th>
                <th class='text-center'>Material Description</th>                
                <th class='text-center'>Mode</th>
            </tr>
        </thead>
        <tbody>
<?php
            try
            {
                include_once('include/db_Conn.php');
                $strSql = "SELECT * ";
                $strSql .= "FROM COA_MaterialData ";        
                $strSql .= "ORDER BY [material code] ";
                //echo $strSql . "<br>";

                $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                $statement->execute();  
                $nRecCount = $statement->rowCount();
                if ($nRecCount >0)
                {
                    while ($ds = $statement->fetch(PDO::FETCH_NAMED))
                    {
?>
                        <tr>
                            <td><?php echo $ds['Material Code']; ?></td>
                            <td><?php echo $ds['Material Name']; ?></td>
                            <!--<td class='text-right'><?php //echo number_format($ds['Pack size'],0,'.',','); ?></td>-->
                            <td class='text-center'>
                                <a href="#" class="view_data" mat_code="<?php echo $ds['Material Code'];?>">
                                    <span class='fa fa-sticky-note-o fa-lg'></span>
                                </a>

                                <a href="#" class="delete_data" mat_code="<?php echo $ds['Material Code'];?>">
                                    <span class='fa fa-trash-o fa-lg'></span>
                                </a>

                                <a href="#" class="edit_data" mat_code="<?php echo $ds['Material Code'];?>">
                                    <span class='fa fa-pencil-square-o fa-lg'></span>
                                </a>
                            </td>
                        </tr>

<?php
                    }
                }
                else
                {

                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
?>
        </tbody>
    </table>
</div>




  