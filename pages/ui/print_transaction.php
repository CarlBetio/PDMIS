<?php
require 'session.php';
require 'queries/patientprofile_query.php';
  ini_set('display_errors', 0);
   $pageid = $_GET[id];
   list($H_id ,$ydate) = explode(" | ", $pageid);
$conn = new mysqli("localhost", "root", "", "PDMIS") or die(mysqli_error());
 $q2 = $conn->query("SELECT * FROM `treatment` WHERE `Hospital_Id` = '$H_id' && `treatment_date` = '$ydate'") or die(mysqli_error());
    $fetch2 = $q2 ->fetch_array();
    $tquery = $conn->query("SELECT * FROM `nephronotesorder` WHERE `Hospital_Id` = '$H_id' && `notes_order_date` = '$ydate'") or die(mysqli_error());
     $tfetch = $tquery ->fetch_array();
       $nid = $tfetch['nephrologistid'];
       $conn = new mysqli("localhost", "root", "", "PDMIS") or die(mysqli_error());
       $tquery1 = $conn->query("SELECT * FROM `nephrologist` WHERE `nephrologistid` = '$nid'") or die(mysqli_error());
            $tfetch1 = $tquery1 ->fetch_array();
            $n_fname = $tfetch1['n_fname'];
            $n_mname = $tfetch1['n_mname'];
            $n_lname = $tfetch1['n_lname'];
    
$q3 = $conn->query("SELECT * FROM `hemo_order` WHERE `Hospital_Id` = '$H_id' ORDER BY `order_id` DESC") or die(mysqli_error());
  $fetch3 = $q3 ->fetch_array();

  $q1 = $conn->query("SELECT * FROM `patientprofile` where `Hospital_Id` = '$H_id' ") or die(mysqli_error());
  $fetch1 = $q1 ->fetch_array();

?>


    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>PDMIS</title>
        <!-- Favicon-->
        <link rel="icon" href="../../favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
        <!-- Waves Effect Css -->
        <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />
        <!-- JQuery DataTable Css -->
        <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

        <!-- Morris Chart Css-->
        <link href="../../plugins/morrisjs/morris.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="../../css/style4.css" rel="stylesheet">

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="../../css/themes/theme-indigo.css" rel="stylesheet" />
    </head>

    <body class="theme-indigo">

        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-indigo">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->
        <!-- Search Bar -->

        <!-- #END# Search Bar -->
        <!-- Top Bar -->
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <center>
                        <a class="navbar-brand" href="index.html">
                            <div class="title"></div>
                        </a>
                    </center>

                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <!-- Call Search -->

                        <!-- #END# Call Search -->
                        <!-- Notifications -->

                        <!-- #END# Notifications -->
                        <!-- Tasks -->

                        <!-- #END# Tasks -->
                        <!--  <li class="pull-right"><a class="navbar-brand" href="index.html">Sign-Out</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- #Top Bar -->
        <section>
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar">
                <!-- User Info -->
                <div class="user-info">
                    <div class="image">
                        <img src="../../images/nurse.png" width="48" height="48" alt="User" />
                    </div>
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $name; ?>
                        </div>
                        <div class="email">
                            <?php echo $position; ?>
                        </div>
                        <div class="btn-group user-helper-dropdown">


                        </div>
                    </div>
                </div>
                <!-- #User Info -->
                <!-- Menu -->
                <div class="menu">
                    <ul class="list">

                        <li class="header">MAIN NAVIGATION</li>

                        <li id="transaction">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">folder</i>
                                <span>Transaction</span>
                            </a>
                            <ul class="ml-menu">
                                <li id="transaction" >
                                    <a href="transaction.php">HemoTreatment</a>
                                </li>
                            </ul>

                        </li>
                        <li id="profile" class="active">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">people</i>
                                <span>Profile</span>
                            </a>
                            <ul class="ml-menu">
                                <li id="patientprofile" class="active">
                                    <a href="PatientProfile.php">Patient Profile</a>
                                </li>
                                <li id="employeeprofile">
                                    <a href="EmployeeProfile.php">Employee Profile</a>
                                </li>
                                <li id="labtest">
                                    <a href="LT.php">Lab Tests</a>
                                </li>
                                <li id="nephrologist">
                                    <a href="P.php">Nephrologist</a>
                                </li>
                                <li id="descriptors">
                                    <a href="D.php">Descriptors</a>
                                </li>
                            </ul>
                        </li>
                        <li id="maintenance">

                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">settings</i>
                                <span>Maintenance</span>
                            </a>
                            <ul class="ml-menu">
                                <li id="userprofile">
                                    <a href="UserProfile.php">User Profile</a>
                                </li>
                                <li id="systemmaintenance">
                                    <a href="maintenance.php">System Maintenance</a>
                                </li>
                            </ul>
                        </li>
                        <li id="reports">
                            <a href="R.php">
                                <i class="material-icons">assignment</i>
                                <span>Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="material-icons">input</i>
                                <span>Exit</span>
                            </a>
                        </li>


                    </ul>
                </div>
                <!-- #Menu -->
                <!-- Footer -->
                <div class="legal">
                    <div class="copyright">
                        &copy; 2016 - 2017 <a href="javascript:void(0);">Dynamic Explorers</a>.
                    </div>

                </div>
                <!-- #Footer -->
            </aside>
            <!-- #END# Left Sidebar -->
            <!-- Right Sidebar -->
            <aside id="rightsidebar" class="right-sidebar">
                <a> <i class="material-icons">input</i></a>

                <!-- tab content (header right)-->
                <!-- tab content -->
            </aside>
            <!-- #END# Right Sidebar -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row clearfix">
                 
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                               <div id="printableArea">
                            <div class="body">
                           
                                    <div class="row clearfix">
                                         <div class="col-lg-12 col-md-12 center">
                                        <center>
                                        <h4>TERESITA L. JALANDONI PROVINCIAL HOSPITAL</h4>
                                        <h5>Rizal St, Silay City, Neg. Occ.</h5>
                                        <h5>Tel. No. 495-1704 / 495-1705 / 495-0096</h5>
                                        <h4>HEMODIALYSIS TREATMENT SHEET</h4>

                                        </center>
                                        </div>
                                </div>
                                               <div class="row clearfix">
                                <div class="col-xs-5">
                                        <strong>Name : <u><?php echo $fetch1['P_Fname'].' '.$fetch1['P_Mname'].' '.$fetch1['P_Lname']?></u>
                                         <br> Sex: <u><?php echo $fetch1['P_Sex']?></u>
                                        <br>Dry Wt.:<u><?php echo $fetch3['targetwt']?></u>
                                        <br>Weight Gain :<u> <?php echo $fetch2['preweight']-$fetch3['targetwt']?></u>
                                        <br>Pre Dialysis WT. :<u> <?php echo $fetch2['preweight']?></u>
                                        <br>Post-Dialysis WT. :<u> <?php echo $fetch2['postweight']?></u>
                                        </strong>
                                </div>
                                <div class="col-xs-3">
                               
                                        <br>
                                        <strong>   Age : <u> <?php echo $fetch1['P_Age'] ?></u>
                                        <br>Duration :<u> <?php echo $fetch3['duration'] ?></u>
                                        <br>Bfr :<u> <?php echo $fetch2['BFR'] ?></u>
                                        <br>Access :<u> <?php echo $fetch2['access'] ?></u>
                                        <br>Heparin :<u> <?php echo $fetch2['heparin'] ?></u>
                                        </strong>
                                 
                                </div>
                                <div class="col-xs-3">
                                   
                                       
                                    <strong>  Hospital ID : <u><?php echo $fetch1['Hospital_Id'] ?></u> 
                                          <br>Civil Status: <u> <?php echo $fetch1['P_CivilStatus'] ?></u>     
                                        <br>Date :<u> <?php echo $fetch2['treatment_date'] ?></u>
                                        <br>Dialyzer :<u> <?php echo $fetch3['dialyzer'] ?></u>
                                        <br>Dialyzer Use :<u> <?php echo $fetch2['dialyzer_user'] ?></u>
                                        <br>Machine #:<u> <?php echo $fetch2['machine_num'] ?></u>
                                        </strong>
                                    
                                </div>    
                                </div>


                                
                                

                                        <div class="row">

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                <?php
                                              $date = $ydate;                
                                              $query = $conn->query("SELECT * FROM `nephronotesorder` WHERE `Hospital_Id` = '$H_id' && `notes_order_date` = '$date'") or die(mysqli_error());
                                              $fetch = $query ->fetch_array();
                                    
                                                ?>
                                                    <table id="mainTable" class="table table-bordered" style="margin-bottom: 0px; table-layout: fixed;">

                                                        <thead>
                                                            <tr>
                                                                <th>Physician's Notes</th>
                                                                <th>Physician's Order</th>
                                                            </tr>

                                                        </thead>
                                                        <?php 
                                                               $nid = $fetch['nephrologistid'];
                                                               $conn = new mysqli("localhost", "root", "", "PDMIS") or die(mysqli_error());
                                                               $query = $conn->query("SELECT * FROM `nephrologist` WHERE `nephrologistid` = '$nid'") or die(mysqli_error());
                                                               $fetch = $query ->fetch_array();
                                                               $n_fname = $fetch['n_fname'];
                                                               $n_mname = $fetch['n_mname'];
                                                               $n_lname = $fetch['n_lname'];
                                                ?>
                                                        <tbody>
                                                            <?php   
                                                            $date = $ydate;
                                                            $conn = new mysqli("localhost", "root", "", "PDMIS") or die(mysqli_error());
                                                           $query = $conn->query("SELECT * FROM `nephronotesorder` WHERE `Hospital_Id` = '$H_id' && `notes_order_date` = '$date' ORDER BY `notes_order_id`") or die(mysqli_error());
                                                           $id = $fetch['Hospital_Id'];
                                                           
                                                           while($fetch = $query ->fetch_array()){
                                                        ?>
                                                            <tr>
                                                                <td style="white-space: normal">
                                                                    <p style="word-wrap: break-word;">
                                                                       
                                                                            <?php echo $fetch['nephro_notes']?>
                                                                     

                                                                        <a class="pull-right" style="color:black;"><?php echo " -".$n_fname." ".$n_mname." ".$n_lname?></a>
                                                                    </p>
                                                                </td>
                                                                <td style="white-space: normal">
                                                                    <p style="word-wrap: break-word;">
                                                                        <a href="#editPhysician_notes" data-toggle="modal" data-target="#editPhysician_notes" style="color: black;">
                                                                            <?php echo $fetch['nephro_order']?>
                                                                        </a>
                                                                    </p>
                                                                </td>

                                                            </tr>
                                                            <?php
                                                           }

                                                        ?>

                                                        </tbody>

                                                    </table>

                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                <small>Initial Test Result</small>


                                                <table id="mainTable" class="table table-bordered" style="margin-bottom: 0px;">
                                                    <thead>
                                                        <tr>
                                                            <th>Time</th>
                                                            <th>BP</th>
                                                            <th>CR</th>
                                                            <th>RR</th>
                                                            <th>T</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                              $date = $ydate;  
                                                            $conn = new mysqli("localhost", "root", "", "PDMIS") or die(mysqli_error());
                                                           $query = $conn->query("SELECT * FROM `initialtestresult` WHERE `Hospital_Id` = '$H_id' && `initialtest_date` = '$date' ORDER BY `initialtestresult_id`") or die(mysqli_error());
                                                           $id = $fetch['Hospital_Id'];
                                                           
                                                           while($fetch = $query ->fetch_array()){
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                   
                                                                        <?php echo $fetch['initialtest_time']?>
                                                              
                                                                </td>
                                                                <td>
                                                                    
                                                                        <?php echo $fetch['bloodpressure']?>
                                                          
                                                                </td>
                                                                <td>
                                                                   
                                                                        <?php echo $fetch['cardiacrate']?>
                                                                    
                                                                </td>
                                                                <td>
                                                                   
                                                                        <?php echo $fetch['repulsiverate']?>
                                                               
                                                                </td>
                                                                <td>
                                                                   
                                                                        <?php echo $fetch['initialtemperature']?>
                                                                
                                                                </td>

                                                            </tr>
                                                            <?php
                                                           }

                                                        ?>

                                                    </tbody>

                                                </table>

                                            </div>

                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 pull-right">


                                                <small>&nbsp;</small>

                                                <table id="mainTable" class="table table-bordered" style="margin-bottom: 0px; table-layout: fixed;">
                                                    <thead>
                                                        <tr>
                                                            <th>Nurse's Notes</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                             $date = $ydate;  
                                                            $conn = new mysqli("localhost", "root", "", "PDMIS") or die(mysqli_error());
                                                           $query = $conn->query("SELECT * FROM `nursenotes` WHERE `Hospital_Id` = '$H_id' && `nurse_notes_date` = '$date' ORDER BY `nurse_notes_id`") or die(mysqli_error());
                                                           $id = $fetch['Hospital_Id'];
                                                           
                                                           while($fetch = $query ->fetch_array()){
                                                        ?>
                                                            <tr>
                                                                <td style="white-space: normal">
                                                                   
                                                                        <p style="word-wrap: break-word;"> (F) :
                                                                            <?php echo $fetch['focus']?><br> (D) :
                                                                            <?php echo $fetch['data']?><br> (A) :
                                                                            <?php echo $fetch['action']?><br> (R) :
                                                                            <?php echo $fetch['resolution']?>
                                                                        </p>
                                                                
                                                                </td>


                                                            </tr>
                                                            <?php
                                                           }

                                                        ?>
                                                    </tbody>

                                                </table>

                                            </div>


                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                <small>Test Results</small>

                                                <table id="mainTable" class="table table-bordered" style="margin-bottom: 0px;">
                                                    <thead>
                                                        <tr>
                                                            <th>Time</th>
                                                            <th>BP</th>
                                                            <th>CR</th>
                                                            <th>BFR</th>
                                                            <th>TMP</th>
                                                            <th>VP</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                           
                                                             $date = $ydate;  
                                                            $conn = new mysqli("localhost", "root", "", "PDMIS") or die(mysqli_error());
                                                           $query = $conn->query("SELECT * FROM `machineresult` WHERE `Hospital_Id` = '$H_id' && `m_date` = '$date' ORDER BY `machineresult_id`") or die(mysqli_error());
                                                           $id = $fetch['Hospital_Id'];
                                                           
                                                           while($fetch = $query ->fetch_array()){
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                   
                                                                        <?php echo $fetch['m_time']?>
                                                            
                                                                </td>
                                                                <td>
                                                                    
                                                                        <?php echo $fetch['m_bloodpressure']?>
                                                              
                                                                </td>
                                                                <td>
                                                                   
                                                                        <?php echo $fetch['m_cardiacrate']?>
                                                              
                                                                </td>
                                                                <td>
                                                                  
                                                                        <?php echo $fetch['m_bloodflowrate']?>
                                                                   
                                                                </td>
                                                                <td>
                                                                   
                                                                        <?php echo $fetch['m_transmempressure']?>
                                                           
                                                                </td>
                                                                <td>
                                                                    
                                                                        <?php echo $fetch['m_venpressure']?>
                                                                 
                                                                </td>

                                                            </tr>
                                                            <?php
                                                           }

                                                        ?>

                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-xs-6">
                                    
                                        <strong>
                                            <?php
                                            $id = $fetch2['employeeid'];
                                            $conn = new mysqli("localhost", "root", "", "PDMIS") or die(mysqli_error());
                                            $q6 = $conn->query("SELECT * FROM `employeeprofile` where `employeeid` = '$id' ") or die(mysqli_error());
                                            $fetch6 = $q6 ->fetch_array();
                                            $id = $fetch2['technicianid'];
                                            $q7 = $conn->query("SELECT * FROM `employeeprofile` where `employeeid` = '$id' ") or die(mysqli_error());
                                            $fetch7 = $q7 ->fetch_array();
                                            ?>
                                            
                                          Dialysis Technician : <u> <?php echo $fetch6['firstname']." ".$fetch6['middlename']." ".$fetch6['lastname'] ?></u>     
                                        <br>Dialysis Nurse :<u> <?php echo $fetch7['firstname']." ".$fetch7['middlename']." ".$fetch7['lastname'] ?></u>
                                        </strong>
                                    
                                </div>    
                                </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-offset-9 col-xs-offset-9">
                                               <div class="row hidden-print mt-20">
                                                 
                                                   <a class="btn btn-primary btn-xs" onclick="printDiv('printableArea')" target="_blank"><i class="material-icons">print</i> Print</a>
                                                   <button class="btn btn-primary btn-sm" onclick="location.href='patientprofile.php?id=<?php echo $H_id." | "."hemotreatment"." | "."$ydate"?>'">cancel</button>
                                                   
                                              </div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                                 </div>
                            </div>
                        </div>
                    </div>
           

     




        </section>


        <!-- Jquery Core Js -->
            <script>
        function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
        </script>

        <script src="../../plugins/jquery/jquery.min.js"></script>
        <script src="../../plugins/jquery/jquery.js"></script>

        <!-- Bootstrap Core Js -->
        <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Select Plugin Js -->
        <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

        <!-- Slimscroll Plugin Js -->
        <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="../../plugins/node-waves/waves.js"></script>

        <!-- Jquery CountTo Plugin Js -->
        <script src="../../plugins/jquery-countto/jquery.countTo.js"></script>

        <!-- Morris Plugin Js -->
        <script src="../../plugins/raphael/raphael.min.js"></script>
        <script src="../../plugins/morrisjs/morris.js"></script>

        <!-- ChartJs -->
        <script src="../../plugins/chartjs/Chart.bundle.js"></script>

        <!-- Jquery DataTable Plugin Js -->
        <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="../../js/pages/tables/jquery-datatable.js"></script>
        <!-- Sparkline Chart Plugin Js -->
        <script src="../../plugins/jquery-sparkline/jquery.sparkline.js"></script>



        <!-- Custom Js -->
        <script src="../../js/admin.js"></script>
        <script src="../../js/pages/index.js"></script>

        <!-- Demo Js -->
        <script src="../../js/demo.js"></script>
        <script>
            $(window).load(function() {
                var module = '<?php echo $transaction_a; ?>';
                var module1 = '<?php echo $patientprofile_a; ?>';
                var module2 = '<?php echo $employeeprofile_a; ?>';
                var module3 = '<?php echo $labtest_a; ?>';
                var module4 = '<?php echo $nephrologist_a; ?>';
                var module5 = '<?php echo $descriptors_a; ?>';
                var module6 = '<?php echo $userprofile_a; ?>';
                var module7 = '<?php echo $maintenance_a; ?>';
                var module8 = '<?php echo $reports_a; ?>';

                if (module == '0') {
                    $('#transaction').hide();

                }

                if (module1 == '0') {
                    $('#patientprofile').hide();

                }

                if (module2 == '0') {
                    $('#employeeprofile').hide();

                }

                if (module3 == '0') {
                    $('#labtest').hide();

                }

                if (module4 == '0') {
                    $('#nephrologist').hide();

                }

                if (module5 == '0') {
                    $('#descriptors').hide();

                }

                if (module6 == '0') {
                    $('#userprofile').hide();

                }

                if (module7 == '0') {
                    $('#systemmaintenance').hide();

                }

                if (module8 == '0') {
                    $('#reports').hide();

                }
                if (module1 == '0' && module2 == '0' && module3 == '0' && module4 == '0' && module5 == '0') {
                    $('#profile').hide();

                }
                if (module6 == '0' && module7 == '0') {
                    $('#maintenance').hide();

                }
            });

        </script>

    </body>

    </html>
