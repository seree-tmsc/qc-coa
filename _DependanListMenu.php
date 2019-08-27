<?php
	/*** By Weerachai Nukitram ***/
	/***  http://www.ThaiCreate.Com ***/

	$objConnect = mysql_connect("localhost","root","root") or die("Error Connect to Database");
	$objDB = mysql_select_db("thailand");
	@mysql_query("SET NAMES UTF8");
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>ThaiCreate.Com ListMenu</title>
        <script language = "JavaScript">
            //**** List Province (Start) ***//
            function ListProvince(SelectValue)
            {
                frmMain.ddlProvince.length = 0
                frmMain.ddlAmphur.length = 0
                
                //*** Insert null Default Value ***//
                var myOption = new Option('','')  
                frmMain.ddlProvince.options[frmMain.ddlProvince.length]= myOption
                
                <?php
                $intRows = 0;
                $strSQL = "SELECT * FROM province ORDER BY PROVINCE_ID ASC ";
                $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
                $intRows = 0;
                while($objResult = mysql_fetch_array($objQuery))
                {
                $intRows++;
                ?>			
                    x = <?php echo $intRows;?>;
                    mySubList = new Array();
                    
                    strGroup = <?php echo $objResult["GEO_ID"];?>;
                    strValue = "<?php echo $objResult["PROVINCE_ID"];?>";
                    strItem = "<?php echo $objResult["PROVINCE_NAME"];?>";
                    mySubList[x,0] = strItem;
                    mySubList[x,1] = strGroup;
                    mySubList[x,2] = strValue;
                    if (mySubList[x,1] == SelectValue){
                        var myOption = new Option(mySubList[x,0], mySubList[x,2])  
                        frmMain.ddlProvince.options[frmMain.ddlProvince.length]= myOption					
                    }
                <?
                }
                ?>																	
            }
            //**** List Province (End) ***//

            
            //**** List Amphur (Start) ***//
            function ListAmphur(SelectValue)
            {
                frmMain.ddlAmphur.length = 0

                //*** Insert null Default Value ***//
                var myOption = new Option('','')  
                frmMain.ddlAmphur.options[frmMain.ddlAmphur.length]= myOption
                
                <?php
                $intRows = 0;
                $strSQL = "SELECT * FROM amphur ORDER BY AMPHUR_ID ASC ";
                $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
                $intRows = 0;
                while($objResult = mysql_fetch_array($objQuery))
                {
                $intRows++;
                ?>
                    x = <?php echo $intRows;?>;
                    mySubList = new Array();
                    
                    strGroup = <?php echo $objResult["PROVINCE_ID"];?>;
                    strValue = "<?php echo $objResult["AMPHUR_ID"];?>";
                    strItem = "<?php echo $objResult["AMPHUR_NAME"];?>";
                    mySubList[x,0] = strItem;
                    mySubList[x,1] = strGroup;
                    mySubList[x,2] = strValue;
                                
                    if (mySubList[x,1] == SelectValue){
                        var myOption = new Option(mySubList[x,0], mySubList[x,2])  
                        frmMain.ddlAmphur.options[frmMain.ddlAmphur.length]= myOption					
                    }
                <?php
                }
                ?>																	
            }
            //**** List Amphur (End) ***//

        </script>
    </head>
    <body>
        <form name="frmMain" action="" method="post">
            Geography 
            <select id="ddlGeo" name="ddlGeo" onChange = "ListProvince(this.value)">
            <option selected value=""></option>
            
            <?php
            $strSQL = "SELECT * FROM geography ORDER BY GEO_ID ASC ";
            $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
            while($objResult = mysql_fetch_array($objQuery))
            {
            ?>
                    <option value="<?php echo $objResult["GEO_ID"];?>"><?php echo $objResult["GEO_NAME"];?></option>
            <?php
            }
            ?>
            
            </select>

            Province
            <select id="ddlProvince" name="ddlProvince" style="width:120px" onChange = "ListAmphur(this.value)"></select>

            Amphur
            <select id="ddlAmphur" name="ddlAmphur" style="width:200px"></select>
        </form>
    </body>
</html>

<?php
	mysql_close($objConnect);
?>