<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" 
                class="navbar-toggle collapsed" 
                data-toggle="collapse" 
                data-target="#navbar" 
                aria-expanded="false" 
                aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<img src="images/tmsc-logo-128.png" width="96" class="img-responsive center-block">-->
            <img src="images/tmsc-logo-128.png" width="96">
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="pMain.php">
                        <span class="fa fa-home fa-lg" style="color:blue"></span>
                        Home
                    </a>                            
                </li>                
            </ul>

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="fa fa-cloud-upload fa-lg" style="color:blue"></span> 
                        Upload
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>                             
                            <a href="pUpload_Sales_Data.php" >
                                <span class="fa fa-square-o fa-lg" style="color:navy"></span> 
                                Upload Sales Data [ZPSD_R0001_SALESREPT]
                            </a>
                        </li>
                        <!--
                        <li>                             
                            <a href="pUpload_VF05.php" >
                                <span class="fa fa-square-o fa-lg" style="color:navy"></span> 
                                Upload Batch No. [VF05]
                            </a>
                        </li>
                        -->
                        <li>                             
                            <a href="pUpload_VL06O.php" >
                                <span class="fa fa-square-o fa-lg" style="color:navy"></span> 
                                Upload Batch No. [VL06O]
                            </a>
                        </li>
                        <li class="divider">
                        </li>                        
                        <li>                                
                            <a href="pUpload_QcHeader_Data.php" >
                                <span class="fa fa-square-o fa-lg" style="color:navy"></span> 
                                Upload QC Header [ZPQM_F0002_COAUPDATE]
                            </a>
                        </li>
                        <li>                                
                            <a href="pUpload_QcDetail_Data.php" >
                                <span class="fa fa-square-o fa-lg" style="color:navy"></span> 
                                Upload QC Detail [ZPQM_R0001_INSPERES]
                            </a>
                        </li>
                        <!--
                        <li>                                
                            <a href="#" >
                                <span class="fa fa-square-o fa-lg" style="color:navy"></span> 
                                Upload MIC RBQL Data
                            </a>
                        </li>
                        -->
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="fa fa-database fa-lg" style="color:blue"></span> 
                        Maintain
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="pMA_Material_Master.php">
                                <span class='fa fa-square-o fa-lg' style="color:navy"></span>
                                Material Master Data [For COA]
                            </a>
                        </li>
                        <li class="divider">
                        <!--
                        <li>
                            <a href="pMA_VF05.php">
                                <span class='fa fa-square-o fa-lg' style="color:navy"></span>
                                VF05 [Specific Quantity]
                            </a>
                        </li>
                        <li class="divider">
                        -->
                        <li>
                            <a href="pDelete_SalesData_Main.php">
                                <span class='fa fa-trash-o fa-lg' style="color:red"></span>
                                Delete Sales-Data
                            </a>
                        </li>
                        <li>
                            <a href="pDelete_InspectionData_Main.php">
                                <span class='fa fa-trash-o fa-lg' style="color:red"></span>
                                Delete Inspection-Data
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="fa fa-print fa-lg" style="color:blue"></span> 
                        Query
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!--
                        <li>                             
                            <a href="pQuery_COA_SalesData.php" >
                                <span class="fa fa-square-o fa-lg" style="color:navy"></span> 
                                Query Sales Data
                            </a>
                        </li>
                        -->
                        <li>                             
                            <a href="pQuery_COA_SalesData_ver2.php" >
                                <span class="fa fa-square-o fa-lg" style="color:navy"></span> 
                                Query Sales Data
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>                                
                            <a href="pQuery_COA_QcDataHeader.php" >
                                <span class="fa fa-square-o fa-lg" style="color:navy"></span> 
                                Query QC Header Data
                            </a>
                        </li>
                        <li>                                
                            <a href="pQuery_COA_QcDataDetail.php" >
                                <span class="fa fa-square-o fa-lg" style="color:navy"></span> 
                                Query QC Detail Data
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>                                
                            <a href="pQuery_COA_QcCodeGroup.php" >
                                <span class="fa fa-square-o fa-lg" style="color:navy"></span> 
                                Query Code Group Data
                            </a>
                        </li>
                        <!--
                        <li class="divider"></li>
                        <li>                                
                            <a href="#" >
                                <a href="pChart_QcResult.php" >
                                <span class="fa fa-area-chart" style="color:navy"></span> 
                                Chart of Inspection Result
                            </a>
                        </li>
                        -->
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="fa fa-print fa-lg" style="color:blue"></span> 
                        Print
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!--
                        <li>
                            <a href="pPrint_Coa.php">
                                <span class='fa fa-square-o fa-lg' style="color:navy"></span>
                                Print COA For Thai Kansai
                            </a>
                        </li>
                        <li class="divider"></li>
                        -->
                        <li>
                            <a href="pPrint_Coa_ver2.php">
                                <span class='fa fa-square-o fa-lg' style="color:navy"></span>
                                Print COA For Thai Kansai
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="fa fa-wrench fa-lg" style="color:blue"></span> 
                        Tools
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="pMA_User.php">
                                <span class='fa fa-address-card-o' style="color:blue"></span>
                                User Management
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class='fa fa-user-circle-o fa-lg' style="color:blue"></span> 
                        Login as ... 
                        <?php echo $_SESSION["ses_email"];?> 
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>                                
                            <a href="#" data-toggle="modal" data-target="#chgpasswordModal">
                                <span class='fa fa-pencil-square-o fa-lg'></span> 
                                Change Password
                            </a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>                                
                            <a href="#" data-toggle="modal" data-target="#logoutModal">
                                <span class="fa fa-sign-out fa-lg"></span> 
                                logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>