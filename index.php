<!DOCTYPE html>
<html lang="en">


<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');?>

<?php 
 include('connect.php');
  $sql = "select * from admin where id = '".$_SESSION["id"]."'";
        $result=$conn->query($sql);
        $row1=mysqli_fetch_array($result);

 ?>


<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper full-calender">
                <div class="page-body">
                    <div class="row">
                        <?php
                        $sql_manage = "select * from manage_website"; 
                        $result_manage = $conn->query($sql_manage);
                        $row_manage = mysqli_fetch_array($result_manage);
                        ?>

                        <?php if($_SESSION['user'] == 'admin'){ ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">

                                            <h4 class="text-white">
                                                <?php
                                                $sql = "SELECT * FROM patient WHERE status='Active' and delete_status='0'";
                                                $qsql = mysqli_query($conn,$sql);
                                                echo mysqli_num_rows($qsql);
                                                ?>
                                            </h4>
                                            <h6 class="text-white m-b-0">Total Student Patient</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-2" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-pink update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">

                                            <h4 class="text-white">
                                                <?php
                                                $sql = "SELECT * FROM doctor WHERE delete_status='0'";
                                                $qsql = mysqli_query($conn,$sql);
                                                echo mysqli_num_rows($qsql);
                                            ?>
                                            </h4>
                                            <h6 class="text-white m-b-0">Total Health Personel</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-3" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-lite-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">

                                            <h4 class="text-white">
                                                <?php
                                                    $sql = "SELECT * FROM admin WHERE delete_status='0'";
                                                    $qsql = mysqli_query($conn,$sql);
                                                    echo mysqli_num_rows($qsql);
                                                ?>
                                            </h4>
                                            <h6 class="text-white m-b-0">Performing Admin
                                            </h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-4" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-yellow update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">

                                            <h4 class="text-white">School
                                                <?php 
                                                $sql = "SELECT sum(bill_amount) as total  FROM `billing_records` ";
                                                $qsql = mysqli_query($conn,$sql);
                                                while ($row = mysqli_fetch_assoc($qsql))
                                                { 
                                                echo $row['total'];
                                                }
                                            ?>
                                            </h4>
                                            <h6 class="text-white m-b-0">Student Patient</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-1" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <?php }else if($_SESSION['user'] == 'doctor'){ ?>
                        <div class="row col-sm-12">
                            <h3>Welcome <?php echo 'Dr. '.$_SESSION['fname']; ?></h3><br><br>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">

                                            <h4 class="text-white">
                                                <?php
                                                $sql = "SELECT * FROM appointment WHERE `doctorid`=1 AND appointmentdate=' ".date("Y-m-d")."' and delete_status='0'";
                                                $qsql = mysqli_query($conn,$sql);
                                                echo mysqli_num_rows($qsql);
                                            ?>
                                            </h4>
                                            <h6 class="text-white m-b-0">New Appoiment</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-2" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-pink update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">

                                            <h4 class="text-white">
                                                <?php
                                                $sql = "SELECT * FROM patient WHERE delete_status='0'";
                                                $qsql = mysqli_query($conn,$sql);
                                                echo mysqli_num_rows($qsql);
                                                ?>
                                            </h4>
                                            <h6 class="text-white m-b-0">Number of Student Patient</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-3" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-lite-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">

                                            <h4 class="text-white">
                                                <?php
                                                $sql = "SELECT * FROM appointment WHERE status='Active' AND `doctorid`=1 AND appointmentdate=' ".date("Y-m-d")."' and delete_status='0'" ;
                                                $qsql = mysqli_query($conn,$sql);
                                                echo mysqli_num_rows($qsql);
                                                ?>
                                            </h4>
                                            <h6 class="text-white m-b-0">Today's Appoinment
                                            </h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-4" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-yellow update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">

                                            <h4 class="text-white">QSU
                                                <?php 
                                                    $sql = "SELECT sum(bill_amount) as total  FROM `billing_records` WHERE `bill_type` = 'Consultancy Charge'" ;
                                                    $qsql = mysqli_query($conn,$sql);
                                                    while ($row = mysqli_fetch_assoc($qsql))
                                                    { 
                                                    echo $row['total'];
                                                    }
                                                ?>
                                            </h4>
                                            <h6 class="text-white m-b-0">School Clinic</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-1" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php }else if($_SESSION['user'] == 'patient'){ 

                                $sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
                                $qsqlpatient = mysqli_query($conn,$sqlpatient);
                                $rspatient = mysqli_fetch_array($qsqlpatient);

                                $sqlpatientappointment = "SELECT * FROM appointment WHERE patientid='$_SESSION[patientid]' ";
                                $qsqlpatientappointment = mysqli_query($conn,$sqlpatientappointment);
                                $rspatientappointment = mysqli_fetch_array($qsqlpatientappointment);
                                
                            ?>
                        <div class="row col-lg-12">
                            <h3><b>Dashboard</b></h3>
                        </div>
                        <div class="row col-lg-12">Welcome to Quirino State University<br><br></div>
                        <div class="card row col-lg-12">
                            <div class="card-block">
                                <!-- Row start -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="sub-title">
                                            <h2>Welcome <?php echo $rspatient['patientname']; ?> !</h2>
                                        </div>
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs md-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#home3"
                                                    role="tab">Registration History</a>
                                                <div class="slide"></div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#profile3"
                                                    role="tab">Appointment</a>
                                                <div class="slide"></div>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->

                                        <div class="tab-content card-block">
                                            <div class="tab-pane active" id="home3" role="tabpanel">
                                                <p class="m-0"><b>Registration History</b>
                                                <h3>You are with us from <?php echo $rspatient['admissiondate']; ?>
                                                    <?php echo $rspatient['admissiontime']; ?></h3>
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="profile3" role="tabpanel">
                                                <p class="m-0">
                                                    <b>Appointment</b>
                                                    <?php
                                                    if(mysqli_num_rows($qsqlpatientappointment) == 0)
                                                    {
                                                    ?>
                                                <h3>Appointment records not found.. </h3>
                                                <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                <h3>Last Appointment taken on -
                                                    <?php echo $rspatientappointment['appointmentdate']; ?>
                                                    <?php echo $rspatientappointment['appointmenttime']; ?> </h3>
                                                <?php
                                                    }
                                                ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row end -->
                            </div>
                        </div>
                        <?php } ?>

                    </div>

                    <?php if($_SESSION['user'] == 'admin'){ ?>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Appoinment</h5>

                                </div>
                                <div class="card-block">
                                    <div class="ct-chart1 ct-perfect-fourth"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Patient</h5>
                                </div>
                                <div class="card-block">
                                    <div class="ct-chart1-patient ct-perfect-fourth"></div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Patient By Course</h5>
                                </div>
                                <div class="card-block">
                                    <div class="ct-chart1-course ct-perfect-fourth"></div>
                                    <div class="course-legend"></div> <!-- Legend Container -->
                                </div>
                            </div>
                        </div>



                    </div>



                    <div class="card">
                        <div class="card-header">
                            <h2>Appointments</h2>
                        </div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Patient detail</th>
                                            <th>Appointment Date & Time</th>
                                            <th>Department</th>
                                            <th>Health Personel</th>
                                            </th>
                                            <th>Reason</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql ="SELECT * FROM appointment WHERE (status !='') and delete_status='0'";
                                        if(isset($_SESSION['patientid']))
                                        {
                                            $sql  = $sql . " AND patientid='$_SESSION[patientid]'";
                                        }
                                        $qsql = mysqli_query($conn,$sql);
                                        while($rs = mysqli_fetch_array($qsql))
                                        {
                                            $sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]' and delete_status='0'";
                                            $qsqlpat = mysqli_query($conn,$sqlpat);
                                            $rspat = mysqli_fetch_array($qsqlpat);
                                            
                                            
                                            $sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]' and delete_status='0'";
                                            $qsqldept = mysqli_query($conn,$sqldept);
                                            $rsdept = mysqli_fetch_array($qsqldept);
                                        
                                            $sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]' and delete_status='0'";
                                            $qsqldoc = mysqli_query($conn,$sqldoc);
                                            $rsdoc = mysqli_fetch_array($qsqldoc);
                                            echo "<tr>
                                                <td>&nbsp;$rspat[patientname]<br>&nbsp;$rspat[mobileno]</td>     
                                            <td>&nbsp;" . date("d-M-Y",strtotime($rs['appointmentdate'])) . " &nbsp; " . date("H:i A",strtotime($rs['appointmenttime'])) . "</td> 
                                            <td>&nbsp;$rsdept[departmentname]</td>
                                            <td>&nbsp;$rsdoc[doctorname]</td>
                                                <td>&nbsp;$rs[app_reason]</td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php include('footer.php');?>

<style>
.course-legend {
    margin-top: 10px;
    font-size: 14px;
}

.course-legend div {
    margin: 5px 0;
}

/* Define colors for each course */
.line-course-1 {
    stroke: #FF5733;
}

.line-course-2 {
    stroke: #33FF57;
}

.line-course-3 {
    stroke: #3357FF;
}

.line-course-4 {
    stroke: #FF33A6;
}

.line-course-5 {
    stroke: #FF9933;
}

.line-course-6 {
    stroke: #33FFF0;
}
</style>

<link rel="stylesheet" href="files/bower_components/chartist/css/chartist.css" type="text/css" media="all">
<!-- Chartlist charts -->
<script src="files/bower_components/chartist/js/chartist.js"></script>
<script src="files/assets/pages/chart/chartlist/js/chartist-plugin-threshold.js"></script>
<script type="text/javascript">
/*Threshold plugin for Chartist start*/
var appointment = [];
<?php
    for ($i = 01; $i < 13; $i++) { 
    $count = 0;
    $sql ="SELECT * FROM appointment WHERE (status !='') and delete_status='0' and MONTH(appointmentdate) = '".$i."'";$qsql = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($qsql);
  ?>
appointment.push(<?php echo $count; ?>);
<?php } ?>
new Chartist.Line('.ct-chart1', {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    series: [
        appointment
    ]
}, {
    showArea: false,

    axisY: {
        onlyInteger: true
    },
    plugins: [
        Chartist.plugins.ctThreshold({
            threshold: 4
        })
    ]
});

var defaultOptions = {
    threshold: 0,
    classNames: {
        aboveThreshold: 'ct-threshold-above',
        belowThreshold: 'ct-threshold-below'
    },
    maskNames: {
        aboveThreshold: 'ct-threshold-mask-above',
        belowThreshold: 'ct-threshold-mask-below'
    }
};

//Second Chart
var patient = [];
<?php
      for ($i = 01; $i < 13; $i++) { 
      $count_patient = 0;
      $sql ="SELECT * FROM patient WHERE (status !='') and delete_status='0' and MONTH(admissiondate) = '".$i."'";
      $qsql = mysqli_query($conn,$sql);
      $count_patient = mysqli_num_rows($qsql);
    ?>
patient.push(<?php echo $count_patient; ?>);
<?php } ?>

new Chartist.Line('.ct-chart1-patient', {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    series: [patient]
}, {
    showArea: false,

    axisY: {
        onlyInteger: true
    },
    plugins: [
        Chartist.plugins.ctThreshold({
            threshold: 4
        })
    ]
});

var defaultOptions = {
    threshold: 0,
    classNames: {
        aboveThreshold: 'ct-threshold-above',
        belowThreshold: 'ct-threshold-below'
    },
    maskNames: {
        aboveThreshold: 'ct-threshold-mask-above',
        belowThreshold: 'ct-threshold-mask-below'
    }
};

/*Threshold plugin for Chartist start*/
<?php
$courses_count = [];

// Get the list of courses
$sql_courses = "SELECT * FROM course WHERE delete_flg = 0";
$qsql_courses = mysqli_query($conn, $sql_courses);

// Initialize monthly counts for each course
while ($row_course = mysqli_fetch_assoc($qsql_courses)) {
    $course_id = $row_course['course_id'];
    $course_name = $row_course['course_name'];
    
    // Initialize monthly counts
    $courses_count[$course_name] = array_fill(0, 12, 0); // 12 months

    // Get patient counts per month for the current course
    for ($i = 1; $i <= 12; $i++) {
        $sql = "SELECT COUNT(*) as count FROM patient 
                WHERE delete_status = 0
                AND MONTH(admissiondate) = $i 
                AND course_id = $course_id";
        
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);
        
        // Store the count in the appropriate month
        $courses_count[$course_name][$i - 1] = (int)$data['count'];
    }
}

// Prepare data for Chartist
$seriesData = [];
foreach ($courses_count as $course_name => $monthly_counts) {
    $seriesData[] = $monthly_counts; // Add each course's counts to the series
}
?>


var courseData = <?php echo json_encode($courses_count); ?>;
var seriesData = [];
var colorClasses = ['#FF5733', '#33FF57', '#3357FF', '#FF33A6', '#FF9933', '#33FFF0']; // Color codes for each course

// Prepare data for Chartist and create legend
var colorIndex = 0;

for (var courseName in courseData) {
    if (courseData.hasOwnProperty(courseName)) {
        seriesData.push(courseData[courseName]);

        // Create legend item
        var legendItem = document.createElement('div');
        legendItem.innerHTML = `
            <span style="display:inline-block;width:12px;height:12px;background-color:${colorClasses[colorIndex]};margin-right:5px;"></span>
            ${courseName}`;
        document.querySelector('.course-legend').appendChild(legendItem);

        colorIndex++; // Move to the next color
    }
}

// Prepare the series for Chartist
new Chartist.Line('.ct-chart1-course', {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    series: seriesData.map((data, index) => ({
        name: `Course ${index + 1}`,
        data: data,
        className: 'line-course-' + (index + 1) // Assign class for color
    }))
}, {
    showArea: false,
    axisY: {
        onlyInteger: true
    },
    plugins: [
        Chartist.plugins.ctThreshold({
            threshold: 4
        })
    ]
});
</script>