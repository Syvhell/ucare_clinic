<!-- Author Name: Nikhil Bhalerao +919423979339. 
PHP, Laravel and Codeignitor Developer
-->
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_GET['delid']))
{
  $sql ="UPDATE appointment SET delete_status='1' WHERE appointmentid='$_GET[delid]'";
  $qsql=mysqli_query($conn,$sql);
  if(mysqli_affected_rows($conn) == 1)
  {
?>
<div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Success
        </h3>
        <p>Appointment record deleted successfully.</p>
        <p>
            <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
            <?php echo "<script>setTimeout(\"location.href = 'view-pending-appointment.php';\",1500);</script>"; ?>
        </p>
    </div>
</div>
<?php
    //echo "<script>alert('appointment record deleted successfully..');</script>";
    //echo "<script>window.location='view-pending-appointment.php';</script>";
  }
}
if(isset($_GET['approveid']))
{
  $sql ="UPDATE patient SET status='Active' WHERE patientid='$_GET[patientid]'";
  $qsql=mysqli_query($conn,$sql);
  
  $sql ="UPDATE appointment SET status='Approved' WHERE appointmentid='$_GET[approveid]'";
  $qsql=mysqli_query($conn,$sql);
  if(mysqli_affected_rows($conn) == 1)
  {
?>
<div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Success
        </h3>
        <p>Appointment record Approved successfully.</p>
        <p>
            <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
            <?php echo "<script>setTimeout(\"location.href = 'view-pending-appointment.php';\",1500);</script>"; ?>
        </p>
    </div>
</div>
<?php
    //echo "<script>alert('Appointment record Approved successfully..');</script>";
    //echo "<script>window.location='view-pending-appointment.php';</script>";
  } 
}
?>
?>
<?php
if(isset($_GET['id']))
{ ?>
<div class="popup popup--icon -question js_question-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Sure
            </h1>
            <p>Are You Sure To Delete This Record?</p>
            <p>
                <a href="view-pending-appointment.php?delid=<?php echo $_GET['id']; ?>" class="button button--success"
                    data-for="js_success-popup">Yes</a>
                <a href="view-pending-appointment.php" class="button button--error" data-for="js_success-popup">No</a>
            </p>
    </div>
</div>
<?php } ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Patient Report</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a>Patient Report</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Report</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-body">

                    <div class="card">
                        <div class="card-header">
                            <div class="col-sm-10">
                                <?php if(isset($useroles)){  if(in_array("create_user",$useroles)){ ?>
                                <a href="add_user.php"><button class="btn btn-primary pull-right">+ Add
                                        Users</button></a>
                                <?php } } ?>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#profile"
                                                role="tab">Patient Profile</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#appointment"
                                                role="tab">Appointment Record</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#treatment" role="tab">Treatment
                                                Record</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#prescription"
                                                role="tab">Prescription record</a>
                                            <div class="slide"></div>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabs-left-content card-block">
                                        <div class="tab-pane active" id="profile" role="tabpanel">
                                            <p class="m-0">
                                                <?php
                                                  $sqlpatient = "SELECT * FROM patient p LEFT JOIN course c ON c.course_id = p.course_id and delete_flg=0 where patientid='$_GET[patientid]'";
                                                  $qsqlpatient = mysqli_query($conn,$sqlpatient);
                                                  $rspatient=mysqli_fetch_array($qsqlpatient);
                                                ?>
                                            <div class="table-responsive dt-responsive">
                                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                    <tbody>
                                                        <tr>
                                                            <th>Patient Name</th>
                                                            <td>&nbsp;<?php echo $rspatient['patientname']; ?></td>
                                                            <th>Patient ID</th>
                                                            <td>&nbsp;<?php echo $rspatient['patientid']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address</th>
                                                            <td>&nbsp;<?php echo $rspatient['address']; ?></td>
                                                            <th>Gender</th>
                                                            <td> <?php echo $rspatient['gender'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact Number</th>
                                                            <td>&nbsp;<?php echo $rspatient['mobileno']; ?></td>
                                                            <th>Date Of Birth </th>
                                                            <td>&nbsp;<?php echo $rspatient['dob']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Course</th>
                                                            <td>&nbsp;<?php echo $rspatient['course_name']; ?></td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="appointment" role="tabpanel">
                                            <p class="m-0">
                                            <div class="table-responsive dt-responsive">
                                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Department</th>
                                                            <th>Doctor</th>
                                                            <th>Appointment Date</th>
                                                            <th>Appointment Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            // Fetch the latest appointment ID
                                                            $sqlappointment1 = "SELECT max(appointmentid) FROM appointment WHERE patientid='$_GET[patientid]' AND (status='Active' OR status='Approved' OR status='Pending')";
                                                            $qsqlappointment1 = mysqli_query($conn, $sqlappointment1);
                                                            $rsappointment1 = mysqli_fetch_array($qsqlappointment1);

                                                            // Check if there is an appointment ID
                                                            if (!empty($rsappointment1[0])) {
                                                                // Fetch the latest appointment details
                                                                $sqlappointment = "SELECT * FROM appointment WHERE appointmentid='$rsappointment1[0]'";
                                                                $qsqlappointment = mysqli_query($conn, $sqlappointment);
                                                                $rsappointment = mysqli_fetch_array($qsqlappointment);

                                                                // Fetch department details
                                                                $sqldepartment = "SELECT * FROM department WHERE departmentid='$rsappointment[departmentid]'";
                                                                $qsqldepartment = mysqli_query($conn, $sqldepartment);
                                                                $rsdepartment = mysqli_fetch_array($qsqldepartment);

                                                                // Fetch doctor details
                                                                $sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rsappointment[doctorid]'";
                                                                $qsqldoctor = mysqli_query($conn, $sqldoctor);
                                                                $rsdoctor = mysqli_fetch_array($qsqldoctor);

                                                                // Display appointment details
                                                                echo "<tr>
                                                                        <td>&nbsp;" . htmlspecialchars($rsdepartment['departmentname']) . "</td>
                                                                        <td>&nbsp;" . htmlspecialchars($rsdoctor['doctorname']) . "</td>
                                                                        <td>&nbsp;" . date("d-M-Y", strtotime($rsappointment['appointmentdate'])) . "</td>
                                                                        <td>&nbsp;" . date("h:i A", strtotime($rsappointment['appointmenttime'])) . "</td>
                                                                    </tr>";
                                                            } else {
                                                                // No appointments found
                                                                echo "<tr>
                                                                        <td colspan='4' class='text-center'>No appointment records found for this patient.</td>
                                                                    </tr>";
                                                            }
                                                            ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </p>
                                        </div>

                                        <div class="tab-pane" id="treatment" role="tabpanel">
                                            <p class="m-0">
                                            <div class="table-responsive dt-responsive">
                                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                    <tr>
                                                        <th>Treatment type</th>
                                                        <th>Treatment date & time</th>
                                                        <th>Doctor</th>
                                                        <th>Treatment Description</th>
                                                        <th>Medicine Dispensed</th>
                                                    </tr>
                                                    <?php
                                                        // SQL query to fetch treatment records for the patient and appointment
                                                         $sql = "SELECT * FROM treatment_records
                                                                WHERE treatment_records.patientid='$_GET[patientid]'";
                                                        
                                                        $qsql = mysqli_query($conn, $sql);
                                                        
                                                        // Check if any records were returned
                                                        if (mysqli_num_rows($qsql) > 0) {
                                                            // Loop through the records and display them
                                                            while ($rs = mysqli_fetch_array($qsql)) {
                                                                // Fetch patient details
                                                                $sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
                                                                $qsqlpat = mysqli_query($conn, $sqlpat);
                                                                $rspat = mysqli_fetch_array($qsqlpat);

                                                                // Fetch doctor details
                                                                $sqldoc = "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
                                                                $qsqldoc = mysqli_query($conn, $sqldoc);
                                                                $rsdoc = mysqli_fetch_array($qsqldoc);

                                                                // Fetch treatment details
                                                                $sqltreatment = "SELECT * FROM services WHERE service_id='$rs[serviceid]'";
                                                                $qsqltreatment = mysqli_query($conn, $sqltreatment);
                                                                $rstreatment = mysqli_fetch_array($qsqltreatment);

                                                                // Display the record
                                                                echo "<tr>
                                                                        <td>&nbsp;{$rstreatment['service_name']}</td>
                                                                        <td>&nbsp;" . date("d-m-Y", strtotime($rs['treatment_date'])) . " &nbsp;" . date("h:i A", strtotime($rs['treatment_time'])) . "</td>
                                                                        <td>&nbsp;{$rsdoc['doctorname']}</td>
                                                                        <td>&nbsp;{$rs['treatment_description']}
                                                            
                                                                        <td>&nbsp;{$rs['medicine_dispense']}";
                                                                        


                                                                echo "</td></tr>";
                                                            }
                                                        } else {
                                                            // No records found, display a message
                                                            echo "<tr><td colspan='4'>No treatment records found for this patient.</td></tr>";
                                                        }
                                                    ?>
                                                </table>
                                            </div>
                                            </p>
                                        </div>



                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>







        </div>

    </div>
</div>

<div id="#">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('footer.php');?>
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Success
            </h1>
            <p><?php echo $_SESSION['success']; ?></p>
            <p>
                <?php echo "<script>setTimeout(\"location.href = 'view_user.php';\",1500);</script>"; ?>
                <!-- <button class="button button--success" data-for="js_success-popup">Close</button> -->
            </p>
    </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Error
            </h1>
            <p><?php echo $_SESSION['error']; ?></p>
            <p>
                <?php echo "<script>setTimeout(\"location.href = 'view_user.php';\",1500);</script>"; ?>
                <!--  <button class="button button--error" data-for="js_error-popup">Close</button> -->
            </p>
    </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
<script>
var addButtonTrigger = function addButtonTrigger(el) {
    el.addEventListener('click', function() {
        var popupEl = document.querySelector('.' + el.dataset.for);
        popupEl.classList.toggle('popup--visible');
    });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
</script>