 <?php 
 include('connect.php');
  $sql = "select * from admin where id = '".$_SESSION["id"]."'";
        $result=$conn->query($sql);
        $ro=mysqli_fetch_array($result);

 ?>


 <div class="pcoded-main-container">
     <div class="pcoded-wrapper">
         <nav class="pcoded-navbar">
             <div class="pcoded-inner-navbar main-menu">
                 <div class="pcoded-navigatio-lavel">U-CARES</div>
                 <ul class="pcoded-item pcoded-left-item">
                     <li class="">
                         <a href="index.php">
                             <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                             <span class="pcoded-mtext">Dashboard</span>
                         </a>
                     </li>

                     <?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'doctor') || ($_SESSION['user'] == 'patient')){ ?>
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)">
                             <span class="pcoded-micon"><i class="feather icon-edit"></i></span>
                             <span class="pcoded-mtext">Appointment</span>
                         </a>
                         <ul class="pcoded-submenu">
                             <?php if($_SESSION['user'] == 'patient') { ?>
                             <li class="">
                                 <a href="appointment.php">
                                     <span class="pcoded-mtext">New Appointment</span>
                                 </a>
                             </li>
                             <?php } ?>
                             <?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'doctor')) { ?>
                             <li class="">
                                 <a href="view-pending-appointment.php">
                                     <span class="pcoded-mtext">View Pending Appointments</span>
                                 </a>
                             </li>
                             <li class="">
                                 <a href="view-appointments-approved.php">
                                     <span class="pcoded-mtext">View Approved Appointments</span>
                                 </a>
                             </li>
                             <?php } ?>
                             <?php if($_SESSION['user'] == 'patient') { ?>
                             <li class="">
                                 <a href="view-appointments.php">
                                     <span class="pcoded-mtext">View Appointments</span>
                                 </a>
                             </li>
                             <?php } ?>
                         </ul>
                     </li>
                     <?php } ?>

                     <?php if($_SESSION['user'] == 'admin') { ?>
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)">
                             <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                             <span class="pcoded-mtext">Health Personels</span>
                         </a>
                         <ul class="pcoded-submenu">

                             <li class="">
                                 <a href="doctor.php">
                                     <span class="pcoded-mtext">New Health Personel</span>
                                 </a>
                             </li>

                             <li class="">
                                 <a href="view-doctor.php">
                                     <span class="pcoded-mtext">View Health Personel</span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <?php } ?>

                     <?php if($_SESSION['user'] == 'doctor') { ?>
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)">
                             <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                             <span class="pcoded-mtext">Health Personels</span>
                         </a>
                         <ul class="pcoded-submenu">

                             <li class="">
                                 <a href="visiting-hour.php">
                                     <span class="pcoded-mtext">New Visiting Hour</span>
                                 </a>
                             </li>

                             <li class="">
                                 <a href="view-visiting-hour.php">
                                     <span class="pcoded-mtext">View Visiting Hour</span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <?php } ?>

                     <?php if($_SESSION['user'] == 'patient') { ?>
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)">
                             <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                             <span class="pcoded-mtext">Prescription</span>
                         </a>
                         <ul class="pcoded-submenu">

                             <li class="">
                                 <a href="view-prescription.php">
                                     <span class="pcoded-mtext">View Prescription Record</span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <?php } ?>


                     <?php if($_SESSION['user'] == 'patient') { ?>
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)">
                             <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                             <span class="pcoded-mtext">Treatment</span>
                         </a>
                         <ul class="pcoded-submenu">

                             <li class="">
                                 <a href="view-treatment-record.php">
                                     <span class="pcoded-mtext">View Treatment Record</span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <?php } ?>

                     <?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'doctor')) { ?>
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)">
                             <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                             <span class="pcoded-mtext">Patients</span>
                         </a>
                         <ul class="pcoded-submenu">
                             <?php if($_SESSION['user'] == 'admin') { ?>
                             <li class="">
                                 <a href="patient.php">
                                     <span class="pcoded-mtext">Add Patient</span>
                                 </a>
                             </li>
                             <?php } ?>
                             <li class="">
                                 <a href="view-patient.php">
                                     <span class="pcoded-mtext">View Patients Records</span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <?php } ?>



                     <?php if($_SESSION['user'] == 'admin') { ?>
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)">
                             <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                             <span class="pcoded-mtext">Service</span>
                         </a>
                         <ul class="pcoded-submenu">

                             <li class="">
                                 <a href="department.php">
                                     <span class="pcoded-mtext">Add Department</span>
                                 </a>
                             </li>

                             <li class="">
                                 <a href="view-department.php">
                                     <span class="pcoded-mtext">View Department</span>
                                 </a>
                             </li>

                             <li class="">
                                 <a href="course.php">
                                     <span class="pcoded-mtext">Add Course</span>
                                 </a>
                             </li>

                             <li class="">
                                 <a href="view-course.php">
                                     <span class="pcoded-mtext">View Courses</span>
                                 </a>
                             </li>

                             <li class="">
                                 <a href="medicine.php">
                                     <span class="pcoded-mtext">Add Medicine</span>
                                 </a>
                             </li>

                             <li class="">
                                 <a href="view-medicine.php">
                                     <span class="pcoded-mtext">View Medicine</span>
                                 </a>
                             </li>
                             <li class="">
                                 <a href="service.php">
                                     <span class="pcoded-mtext">Add Services</span>
                                 </a>
                             </li>
                             <li class="">
                                 <a href="view-service.php">
                                     <span class="pcoded-mtext">View Services</span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <?php } ?>

                     <?php if($_SESSION['user'] == 'doctor') { ?>
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)">
                             <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                             <span class="pcoded-mtext">Service</span>
                         </a>
                         <ul class="pcoded-submenu">
                             <li class="">
                                 <a href="view-treatment-record.php">
                                     <span class="pcoded-mtext">View Treatment Records </span>
                                 </a>
                             </li>

                             <li class="">
                                 <a href="view-treatment.php">
                                     <span class="pcoded-mtext">View Treatment </span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <?php } ?>

                     <!-- <li class="">
<a href="setting.php">
<span class="pcoded-micon"><i class="feather icon-bookmark"></i></span>
<span class="pcoded-mtext">Settings</span>
</a>
</li> -->

                     <li>
                         <a href="logout.php">
                             <i class="feather icon-log-out"></i> Logout
                         </a>
                     </li>
                 </ul>
             </div>
         </nav>