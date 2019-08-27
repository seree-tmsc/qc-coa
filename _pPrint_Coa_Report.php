<?php
    try
    {
        include_once('include/chk_Session.php');
        if($user_email == "")
        {
            echo "<script> 
                    alert('Warning! Please Login!'); 
                    window.location.href='login.php'; 
                </script>";
        }
        else
        {            
            //echo $_POST['invoice-ddl'] . "<br>";
            $nPosition = strpos($_POST['invoice-ddl'],'/',0);
            $cInvoice = substr($_POST['invoice-ddl'], 0, $nPosition);
            $cCustomer = substr($_POST['invoice-ddl'], $nPosition+1, strlen($_POST['invoice-ddl']));

            //echo $_POST['material-ddl'] . "<br>";            
            $nPosition = strpos($_POST['material-ddl'],'/',0);
            $cMaterial = substr($_POST['material-ddl'], $nPosition+1, strlen($_POST['material-ddl']));
            
            //echo $_POST['lot-ddl'] . "<br>";
            $nPosition = strpos($_POST['lot-ddl'],'/C',0);
            $cLot = substr($_POST['lot-ddl'], $nPosition+1, strlen($_POST['lot-ddl']));
            $nQuantity = substr($_POST['lot-ddl'], $nPosition+1, strlen($_POST['lot-ddl']));
            
            
            
            require_once('include/db_Conn.php');
            /* ------------------------------------------------------------------------ */
            /* --- ตรวจสอบข้อมูลจาก COA_SalesData เช่น เลขที่ PO / ปริมาณการสั่งซื้อ / เป็นต้น --- */
            /* ------------------------------------------------------------------------ */
            $strSql = "SELECT [Invoice No], [Material], [Material Description], [Bill-to Party], [Bill-to Name], [Customer purchase order number], sum(Quantity) as Quantity ";
            $strSql .= "FROM COA_SalesData ";            
            $strSql .= "WHERE [Invoice No]='" . $cInvoice . "' ";
            $strSql .= "AND [Material]='" . $cMaterial . "' ";
            $strSql .= "GROUP BY [Invoice No], [Material], [Material Description], [Bill-to Party], [Bill-to Name], [Customer purchase order number] ";
            $strSql .= "ORDER BY [Invoice No], [Material], [Material Description], [Bill-to Party], [Bill-to Name], [Customer purchase order number] ";            
            //echo $strSql . "<br>";

            $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
            $statement->execute();  
            $nRecCount = $statement->rowCount();
            //echo $nRecCount . " records <br>";

            if ($nRecCount == 1)
            {   
                /*--- หาเลขที่ PO + ชื่อสินค้า ---*/
                $ds = $statement->fetch(PDO::FETCH_NAMED);
                $cPO = $ds['Customer purchase order number'];
                $cMaterial_Description = $ds['Material Description'];
            
                /*--- หาปริมาณการขายที่ถูกต้อง ---*/
                $strSqlTmp = "SELECT * FROM COA_VF05 ";
                $strSqlTmp .= "WHERE [Bill Doc] = '" . $cInvoice . "' ";
                $strSqlTmp .= "AND Material = '" . $cMaterial . "' ";
                $strSqlTmp .= "AND Batch = '" . $cLot . "' ";
                //echo $strSqlTmp . "<br>";

                $statementTmp = $conn->prepare($strSqlTmp, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                $statementTmp->execute();  
                $nRecCountTmp = $statementTmp->rowCount();
                //echo $nRecCountTmp . " records <br>";

                if($nRecCountTmp == 1)
                {
                    $dsTmp = $statementTmp->fetch(PDO::FETCH_NAMED);
                    $nOrd_Qty = $dsTmp['Bill qty'];
                }                
            }
            else
            {
                echo "<script> alert('Error! ... No Data of COA_SalesData ! ...'); window.close(); </script>";
            }

            /* ------------------------------------------------------------------------------------------------- */
            /* --- ตรวจสอบข้อมูลจาก COA_MasterData เช่น shipment Codition, storage condition, pack size, tc... --- */
            /* ------------------------------------------------------------------------------------------------- */
            $strSql = "Select * ";
            $strSql .= "from COA_MaterialData ";
            $strSql .= "where [Material Code]='" . $cMaterial . "' ";            
            //echo $strSql . "<br>";

            $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
            $statement->execute();  
            $nRecCount = $statement->rowCount();
            //echo $nRecCount . " records <br>";

            if ($nRecCount == 1)
            {
                $ds = $statement->fetch(PDO::FETCH_NAMED);
                $nShelf_life = number_format($ds['Shelf Life'], 0, '.', ',');
                $cShip_Con = $ds['Shipment Condition'] ;
                $cStorage_Con = $ds['Storage Condition'];
                //$cStorage_Con = '°';
                //$cStorage_Con = '℃';
                $cSpecification = $ds['Specification'];
                $cPictureLoc1 = $ds['Photo of drum1'];
                $cPictureLoc2 = $ds['Photo of drum2'];
                $cPackSize = $ds['Packing Size'];
            }
            else
            {
                echo "<script> alert('Error! ... No Data of COA_MasterData ! ...'); window.close(); </script>";
            }
            
            /* ------------------------- */
            /* --- เริ่มต้นสร้าง PDF File --- */
            /* ------------------------- */
            if ($nRecCount == 1)
            {
                // import library
                require("../vendors/fpdf16/fpdf.php");

                class PDF extends FPDF
                {
                    // Page header
                    function Header()
                    {
                        // Logo                        
                        //$this->Image('images/tmsc-new-logo-long1.gif',114, 5, 100);
                        /*
                        // Arial bold 15
                        $this->SetFont('Arial','B',15);
                        // Move to the right
                        $this->Cell(80);
                        // Title
                        $this->Cell(30,10,'Title',1,0,'C');
                        // Line break
                        $this->Ln(20);
                        */
                    }

                    // Page footer
                    function Footer()
                    {
                        /*
                        // Position at 1.5 cm from bottom
                        $this->SetY(-15);
                        // Arial italic 8
                        $this->SetFont('Arial','I',8);
                        // Page number
                        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
                        */
                    }
                }
                
                // creat instant                
                $pdf=new PDF('P', 'mm', 'A4');

                //add page
                $pdf->AddPage();

                // set margin
                $pdf->SetMargins(5,0);
                $pdf->SetAutoPageBreak(true, 0.2);

                $ds = $statement->fetch(PDO::FETCH_NAMED);
                
                /* --- Before Header ---*/
                //assign font
                //$pdf->SetFont('Arial','B',10);
                $pdf->SetFont('Arial','',10);
                $pdf -> SetY(42);
                $pdf -> SetX(30);
                //cell(width, height, text, border, in, align, fill, link)
                $pdf->Cell( 75, 10, 'ATTN TO : THAI KANSAI PAINT Co.,Ltd.', 0, 0, 'C');

                //$pdf->SetFont('Arial','B',10);
                $pdf->SetFont('Arial','',8);
                $pdf -> SetY(42);
                $pdf -> SetX(95);
                $pdf->Cell( 70, 5, 'Issued by : ', 0, 0, 'R');
                $pdf->Cell( 25, 5, 'Quality Control', '0B', 1, 'R');
                $pdf -> SetX(95);
                $pdf->Cell( 70, 5, 'Issued on : ', 0, 0, 'R');
                $pdf->SetTextColor(128,0,0);
                $pdf->Cell( 25, 5, date('d - M - y') , '0B', 1, 'R');
                $pdf->SetTextColor(0,0,0);
                //คำสั่งสำหรับขึ้นบรรทัดใหม่
                $pdf->Ln();

                /* --- Header ---*/                
                //$pdf->SetFont('Arial','B',10);
                $pdf->SetFont('Arial','',8);
                $pdf-> SetX(30);
                $pdf->Cell( 79, 10, 'THAI MITSUI SPECIALTY CHEMICALS CO.,LTD.', 1, 0, 'C');
                //$pdf->SetFont('Arial','B',12);
                $pdf->SetFont('Arial','',10);
                $pdf -> SetX(110);
                $pdf->Cell( 80, 10, 'KANSAI PAINT CO.,LTD.', 1, 1, 'C');
                
                /* --- Row 01 ---*/
                //$pdf->SetFont('Arial','B',8);
                $pdf->SetFont('Arial','',7);
                $pdf-> SetX(30);
                $pdf->Cell( 79 , 6, '1.CUSTOMER PO No. (TKP)', '0LR');
                $pdf -> SetX(110);
                $pdf->SetTextColor(128,0,0);
                $pdf->Cell( 80, 6, $cPO, '0LRT', 1, 'C');                
                $pdf->SetTextColor(0,0,0);

                /* --- Row 02 ---*/
                $pdf-> SetX(30);
                $pdf->Cell( 79 , 6, '2.MANUFACTURING CODE No.', '0LR');
                $pdf -> SetX(110);
                $pdf->SetTextColor(128,0,0);
                $pdf->Cell( 80, 6, $cMaterial, '0LR', 1, 'C');
                $pdf->SetTextColor(0,0,0);
                
                /* --- Row 03 ---*/
                $pdf-> SetX(30);
                $pdf->Cell( 79 , 6, '3.PRODUCTION NAME', '0LR');
                $pdf -> SetX(110);
                $pdf->SetTextColor(128,0,0);
                $pdf->Cell( 80, 6, $cMaterial_Description, '0LR', 1, 'C');
                $pdf->SetTextColor(0,0,0);
                
                /* --- Row 04 ---*/
                $pdf-> SetX(30);
                $pdf->Cell( 79 , 6, '4.LOT No.', '0LR', 1);
                
                /* --- Row 05 ---*/
                $pdf-> SetX(30);
                $pdf->Cell( 79 , 6, '5.ORDER QUANTITY (KGS.)', '0LRB');
                $pdf -> SetX(110);
                $pdf->SetTextColor(128,0,0);

                $strPackSize = '(' . $cPackSize . ' x ' . ($nOrd_Qty / $cPackSize) . ')';
                $pdf->Cell( 80, 6, number_format($nOrd_Qty,0,'.',',') . ' Kgs. ' . $strPackSize, '0LRB', 1, 'C');
                $pdf->SetTextColor(0,0,0);
                
                /* --- Row 06 ---*/   
                $pdf-> SetX(30);             
                $pdf->Cell( 79 , 6, '6.MANUFACTURING DATE', '0LRT', 1);
                
                /* --- Row 07 ---*/
                $pdf-> SetX(30);
                $pdf->Cell( 79 , 6, '7.EXPIRE DATE from MANUFACTURING DATE', '0LR', 1);            
                
                /* --- Row 08 ---*/
                $pdf-> SetX(30);
                $pdf->Cell( 79 , 6, '8.SHELF LIFE (MONTH)', '0LRB');
                $pdf -> SetX(110);
                $pdf->SetTextColor(128,0,0);
                $pdf->Cell( 80, 6, $nShelf_life . ' Day', '0LRB', 1, 'C');
                $pdf->SetTextColor(0,0,0);
                
                /* --- Row 09 ---*/
                $pdf-> SetX(30);
                $pdf->Cell( 79 , 6, '9.SHIPMENT CONDITION', '0LR');
                $pdf -> SetX(110);
                $pdf->SetTextColor(128,0,0);
                $pdf->Cell( 80, 6, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $cShip_Con), '0LR', 1, 'C');                
                $pdf->SetTextColor(0,0,0);

                /* --- Row 10 ---*/
                $pdf-> SetX(30);
                $pdf->Cell( 79 , 6, '10.STORAGE CONDITION', '0LR');
                $pdf -> SetX(110);
                $pdf->SetTextColor(128,0,0);
                $pdf->Cell( 80, 6, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $cStorage_Con), '0LR', 1, 'C');
                $pdf->SetTextColor(0,0,0);
                
                /* --- Row 11 ---*/
                $pdf-> SetX(30);
                $pdf->Cell( 79 , 6, '11.TKP ARRAIVAL DATE', '0LRT');
                $pdf -> SetX(110);
                $pdf->Cell( 80, 6, '', '0LRT', 1, 'C');

                /* --- Row 12 ---*/
                $pdf-> SetX(30);
                $pdf->Cell( 79 , 6, '12 SPECIFICATION (STANDARD)', 1);
                $pdf -> SetX(110);
                $pdf->SetTextColor(128,0,0);
                $pdf->Cell( 80, 6, $cSpecification, 1, 1, 'C');
                $pdf->SetTextColor(0,0,0);
                                
                /*------------------*/
                /*-- RESULT TABLE --*/
                /*------------------*/                
                /* ------------------------------ */
                /* --- Header of Result Table --- */ 
                /* ------------------------------ */                
                $pdf -> SetY(140);

                $pdf -> SetX(75);
                $pdf->Cell( 50, 6, 'ITEM', '0LRT', 0, 'C');
                $pdf->Cell( 35, 6, 'SPECIFICATION', '0T', 0, 'C');
                $pdf->Cell( 30, 6, 'RESULT', '0LRT', 1, 'C');
    
                $pdf -> SetX(30);
                $pdf->Cell( 44 , 6, 'CERTIFICATION RESULT (COA)', 0);
                $pdf -> SetX(75);
                $pdf->Cell( 50, 6, '', '0LRB', 0, 'C');
                $pdf->Cell( 35, 6, '(STANDARD)', '0B', 0, 'C');
                $pdf->Cell( 30, 6, '', '0LRB', 1, 'C');

                /* ------------------------------ */
                /* --- ROW 01 of Result Table --- */ 
                /* ------------------------------ */
                $pdf -> SetX(30);
                $pdf->Cell( 44 , 6, 'CERTIFICATION DATE', '0LRT', 1);

                /* ------------------------------ */
                /* --- ROW 02 of Result Table --- */ 
                /* ------------------------------ */
                $pdf -> SetX(30);
                $pdf->Cell( 44 , 6, '', '0LR', 1, 'C');

                /* ------------------------------ */
                /* --- ROW 03 of Result Table --- */ 
                /* ------------------------------ */
                $pdf -> SetX(30);
                $pdf->Cell( 44, 6, 'DEPARTMENT NAME', '0LRT', 1);

                /* ------------------------------ */
                /* --- ROW 04 of Result Table --- */ 
                /* ------------------------------ */
                $pdf -> SetX(30);
                $pdf->Cell( 44 , 6, 'SHE & Q', '0LR', 1, 'C');
                
                /* ------------------------------ */
                /* --- ROW 05 of Result Table --- */ 
                /* ------------------------------ */
                $pdf -> SetX(30);
                $pdf->Cell( 44 , 6, 'NAME OF INCHARGE', '0LRT', 1);

                /* ------------------------------ */
                /* --- ROW 06 of Result Table --- */ 
                /* ------------------------------ */
                $pdf -> SetX(30);
                $pdf->Cell( 44 , 6, '', '0LRB', 1, 'C');


                /*-------------------*/
                /*-- ADDRESS TABLE --*/
                /*-------------------*/
                $pdf -> SetY(214);
                $pdf->SetX(30);
                $pdf->Cell( 40 , 6, '', '0LRT', 0, 'C');
                $pdf->Cell( 35 , 6, '', '0RT', 0, 'R');
                //$pdf->Cell( 105 , 6, '12 th Fl. Sathorn Thani Bldg. 2, No. 92 / 28-29', '0RT', 1, 'C');
                $pdf->Cell( 85 , 6, 'Wellgrow Industrial Estate', '0RT', 1, 'C');

                $pdf->SetX(30);
                $pdf->Cell( 40 , 6, 'MAKER ADDRESS', '0LR', 0, 'C');
                $pdf->Cell( 35 , 6, 'ADDRESS', '0R', 0, 'C');
                //$pdf->Cell( 105 , 6, 'North Sathorn Rd., Silom, Bangrak, Bangkok 10500', '0R', 1, 'C');
                $pdf->Cell( 85 , 6, '89 Moo 5, Bangna-Trad Rd., Km.36,', '0R', 1, 'C');

                $pdf->SetX(30);
                $pdf->Cell( 40 , 6, '& TELEPHONE NO.', '0LR', 0, 'C');
                $pdf->Cell( 35 , 6, '', '0R', 0);                
                $pdf->Cell( 85 , 6, 'Bangpakong Chachoengsao 24180', '0R', 1, 'C');

                $pdf->SetX(30);
                $pdf->Cell( 40 , 6, '& E-MAIL ADDRESS', '0LR', 0, 'C');
                $pdf->Cell( 35 , 6, 'TELEPHONE NO.', '0RBT', 0, 'C');
                //$pdf->Cell( 105 , 6, '(662)236-8898', '0RBT', 1, 'C');
                $pdf->Cell( 85 , 6, '(66-38)570-120-4', '0RBT', 1, 'C');

                $pdf->SetX(30);
                $pdf->Cell( 40 , 6, '', '0LRB', 0, 'C');
                $pdf->Cell( 35 , 6, 'E-MAIL ADDRESS', '0RB', 0, 'C');
                $pdf->Cell( 85 , 6, 'thepsak@tmsc.co.th', '0RB', 1, 'C');
                
                $pdf->SetX(30);
                $pdf->Cell( 160 , 10, 'Product photo (1. Overall photo, 2. Label photo)', '0LR', 1);

                /*-- Footer ---*/
                $pdf->SetX(30);
                $pdf->Cell( 160 , 40, '', '0LRB', 1);                
                // Insert a logo in the top-left corner at 300 dpi                
                //$pdf->Image('images/ALMATEX-787-pic1.jpg', 70, 230, 28);
                //$pdf->Image('images/ALMATEX-787-pic2.jpg', 103, 230, 47);     
                
                $pdf->Image($cPictureLoc1, 90, 246, 28);
                $pdf->Image($cPictureLoc2, 130, 246, 42);
                
                /* --------------------------------------------------------------------------- */
                /* --- ตรวจสอบว่ามี COA_QcDataHeader หรือไม่ ถ้าไม่มี ให้แสดง item result ทุกรายการ --- */
                /* --------------------------------------------------------------------------- */
                $strSql = "Select * ";
                $strSql .= "from COA_QcDataHeader ";
                $strSql .= "where Customer='" . $cCustomer . "' and Material='" . $cMaterial. "' ";
                //echo $strSql . "<br>";

                $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                $statement->execute();  
                $nRecCount = $statement->rowCount();
                //echo $nRecCount . " records <br>";

                if($nRecCount == 0)
                {
                    echo "<script> alert('Error! ... No Data of COA_QcDataHeader ! ...'); window.close(); </script>";
                }

                $strSql = "Select * ";
                $strSql .= "from COA_QcDataHeader H ";
                $strSql .= "join COA_QcDataDetail D on D.Material=H.Material and D.[Short text for the characteristic]= H.[Short text] ";
                $strSql .= "left join COA_QcCodeGroup G on G.[Code group]=H.[Master insp charac] and G.Code = D.[Original Value] ";
                $strSql .= "where H.Customer='" . $cCustomer . "' and H.Material='" . $cMaterial. "' and D.Batch='" .$cLot ."' ";
                $strSql .= "order by H.Material, H.Counter ";
                //echo $strSql . "<br>";

                $statement = $conn->prepare( $strSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));  
                $statement->execute();  
                $nRecCount = $statement->rowCount();
                //echo $nRecCount . " records <br>";
                
                if ($nRecCount >0)
                {
                    $nCurLine = 0;                    
                    while($ds = $statement->fetch(PDO::FETCH_NAMED))
                    {
                        //print_r($ds);

                        $nCurLine += 1;
                        if($nCurLine == 1)
                        {
                            $dManufac_Date = date('d-m-y', strtotime($ds['Date of Manufacture']));
                            $dExpired_Date = date('d-m-y', strtotime($ds['SLED/BBD']));
                            $dCertification_Date = date('d-M-y', strtotime($ds['Created on'][1]));
                            $cLot = $ds['Batch'];
        
                            /*--- ROW 04 ---*/
                            $nRow = 85;
                            $pdf -> SetY($nRow);
                            $pdf -> SetX(110);
                            $pdf->SetTextColor(128,0,0);
                            $pdf->Cell( 80, 6, $cLot, '0LR', 1, 'C');
                            $pdf->SetTextColor(0,0,0);

                            /*--- ROW 06 ---*/
                            $nRow = $nRow + 12;
                            $pdf -> SetY($nRow);
                            $pdf -> SetX(110);
                            $pdf->SetTextColor(128,0,0);
                            $pdf->Cell( 80, 6, $dManufac_Date, '0LR', 1, 'C');
                            $pdf->SetTextColor(0,0,0);

                            /*--- ROW 07 ---*/
                            $pdf -> SetX(110);
                            $pdf->SetTextColor(128,0,0);
                            $pdf->Cell( 80, 6, $dExpired_Date, '0LR', 1, 'C');
                            $pdf->SetTextColor(0,0,0);

                            $pdf -> SetY(158);
                            $pdf -> SetX(30);
                            $pdf->SetTextColor(128,0,0);
                            $pdf->Cell( 44 , 6, $dCertification_Date, '0', 1, 'C');                            

                            $pdf -> SetY(152);                            
                        }                                                

                        if($cUom = $ds['Unit of measurement'] == '')
                        {
                            $cItem = $ds['Short text'];
                        }
                        else 
                        {
                            $cItem = $ds['Short text'] . " ( " . $ds['Unit of measurement'] . " )";
                        }

                        if (substr($ds['Qualitative MIC Specifications'], 0, 4) <> NULL)
                        {
                            $cStd_Range = $ds['Qualitative MIC Specifications'];
                            if (is_numeric($ds['Original Value']))
                            {
                                $cResult = $ds['Original Value'];                                
                            }
                            else
                            {
                                $cResult = $ds['Short text for code'];                                
                            }                            
                        }                        
                        else
                        {
                            $cStd_Range = $ds['Lower Limit'] . " - ". $ds['Upper Limit'];
                            $cResult = $ds['Original Value'];
                        }
                                                
                        $pdf -> SetX(75);
                        $pdf->Cell( 50, 6, $cItem, '0LR', 0, 'L');
                        $pdf->Cell( 35, 6, $cStd_Range, 0, 0, 'C');
                        $pdf->Cell( 30, 6, $cResult, '0LR', 1, 'C');                                                                                                
                    }

                    for ($nX=$nCurLine; $nX<=8; $nX++)
                    {
                        $pdf -> SetX(75);
                        $pdf->Cell( 50, 6, '', '0LR', 0, 'C');
                        $pdf->Cell( 35, 6, '', '0', 0, 'C');
                        $pdf->Cell( 30, 6, '', '0LR', 1, 'C');
                    }
                    $pdf -> SetX(75);
                    $pdf->Cell( 50, 6, 'JUDGEMENT', 'TLRB', 0, 'C');
                    $pdf->Cell( 35, 6, '', 'TB', 0, 'C');
                    //$pdf->SetTextColor(0,200,0);
                    $pdf->Cell( 30, 6, 'PASS', 'TLRB', 1, 'C');
                }
                else
                {
                    exit;
                }

                //print to output
                $pdf->Output();
            }
            else
            {
                echo "No data";
            }
        }
    }
    catch(PDOException $e)
    {        
        echo $e->getMessage();
    }
?>