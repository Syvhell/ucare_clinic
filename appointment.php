<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if(isset($_POST['btn_submit']))
{
    if(isset($_GET['editid']))
    {
        $sql ="UPDATE appointment SET patientid='$_POST[patient]',departmentid='$_POST[department]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[appointmenttime]',doctorid='$_POST[doctor]',app_reaosn='$_POST[app_reason]',appointmenttype='$_POST[appointmenttype]' WHERE appointmentid='$_GET[editid]'";
        if($qsql = mysqli_query($conn,$sql))
        {
?>
<div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Success
        </h3>
        <p>Appointment Record Updated Successfully</p>
        <p>
            <?php echo "<script>setTimeout(\"location.href = 'view-appointments.php';\",1500);</script>"; ?>
        </p>
    </div>
</div>
<?php
        }
        else
        {
            echo mysqli_error($conn);
        }   
    }
    else
    {
        $sql ="UPDATE patient SET status='Active' WHERE patientid='$_POST[patient]'";
        $qsql=mysqli_query($conn,$sql);

        $sql ="INSERT INTO appointment(patientid, departmentid, appointmentdate, appointmenttime,appointmenttype,status, doctorid, app_reason) values('$_POST[patient]','$_POST[department]','$_POST[appointmentdate]','$_POST[appointmenttime]','$_POST[appointmenttype]','Pending','$_POST[doctor]','$_POST[app_reason]')";
        if($qsql = mysqli_query($conn,$sql))
        {
?>
<div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Success
        </h3>
        <p>Appointment Record Inserted Successfully</p>
        <p>
            <?php echo "<script>setTimeout(\"location.href = 'view-appointments.php?patientid=$_POST[patient]';\",1500);</script>"; ?>
        </p>
    </div>
</div>
<?php
        }
        else
        {
            echo mysqli_error($conn);
        }
    }
}
if(isset($_GET['editid']))
{
    $sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
    $qsql = mysqli_query($conn,$sql);
    $rsedit = mysqli_fetch_array($qsql);
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Appointment</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a>Appointment</a></li>
                                    <li class="breadcrumb-item"><a href="add_user.php">Appointment</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header"></div>
                                <div class="card-block">
                                    <form id="main" method="post" action="" enctype="multipart/form-data">
                                        <?php
                                            if(isset($_GET['patid']))
                                            {
                                                $sqlpatient= "SELECT * FROM patient WHERE patientid='".$_GET['patid']."'";
                                                $qsqlpatient = mysqli_query($conn,$sqlpatient);
                                                $rspatient=mysqli_fetch_array($qsqlpatient);
                                                echo $rspatient['patientname'] . " (Patient ID - $rspatient[patientid])";
                                                echo "<input type='hidden' name='select4' value='$rspatient[patientid]'>";
                                            }
                                        ?>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Patient</label>
                                            <div class="col-sm-4">
                                                <?php
                                                    $sqlpatient = "SELECT * FROM patient WHERE patientid = '".$_SESSION["id"]."'";
                                                    $qsqlpatient = mysqli_query($conn, $sqlpatient);
                                                    $rspatient = mysqli_fetch_array($qsqlpatient);
                                                    echo "<input value='{$rspatient['patientid']}' type='hidden' class='form-control' name='patient' id='patient' readonly />";
                                                    echo "<input value='{$rspatient['patientname']}' type='text' class='form-control' readonly />";
                                                ?>
                                                <span class="messages"></span>
                                            </div>

                                            <label class="col-sm-2 col-form-label">Department</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="department" id="department"
                                                    placeholder="Enter lastname...." required>
                                                    <option value="">-- Select One --</option>
                                                    <?php
                                                        $sqldepartment= "SELECT * FROM department WHERE delete_status = 0";
                                                        $qsqldepartment = mysqli_query($conn,$sqldepartment);
                                                        while($rsdepartment=mysqli_fetch_array($qsqldepartment))
                                                        {
                                                            if($rsdepartment['departmentid'] == $rsedit['departmentid'])
                                                            {
                                                                echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
                                                            }
                                                            else
                                                            {
                                                                echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <span class="messages"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Date</label>
                                            <div class="col-sm-4">
                                                <input type="date" class="form-control" name="appointmentdate"
                                                    id="appointmentdate" required>
                                                <span class="messages"></span>
                                            </div>

                                            <label class="col-sm-2 col-form-label">Time</label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" name="appointmenttime"
                                                    id="appointmenttime" placeholder="Enter lastname...." required>
                                                <span class="messages"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Physician</label>
                                            <div class="col-sm-4">
                                                <select id="doctor" name="doctor" class="form-control" disabled>
                                                    <option value="">-- Select Physician --</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 col-form-label">Service to Avail</label>
                                            <div class="col-sm-4">
                                                <select id="service" name="appointmenttype" class="form-control"
                                                    disabled>
                                                    <option value="">-- Select Service -- </option>
                                                </select>
                                                <span class="messages"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Appointment Reason</label>
                                            <div class="col-sm-10">
                                                <input type="textarea" class="form-control" name="app_reason" required
                                                    id="app_reason"
                                                    value="<?php if(isset($_GET['editid'])) { echo $rsedit['app_reason']; } ?>" />
                                                <span class="messages"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" name="btn_submit"
                                                    class="btn btn-primary m-b-0">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#department').change(function() {
        const departmentId = $(this).val();

        // Reset doctor and service dropdowns
        $('#doctor').empty().append('<option value="">-- Select Physician --</option>').prop('disabled',
            true);
        $('#service').empty().append('<option value="">-- Select Service --</option>').prop('disabled',
            true);

        if (departmentId) {
            // Fetch doctors based on selected department
            $.ajax({
                url: 'get_doctors.php', // PHP script to fetch doctors
                type: 'GET',
                data: {
                    departmentid: departmentId
                },
                dataType: 'json',
                success: function(doctors) {
                    $.each(doctors, function(index, doctor) {
                        $('#doctor').append(
                            `<option value="${doctor.doctorid}">${doctor.doctorname}</option>`
                        );
                    });
                    $('#doctor').prop('disabled', false); // Enable doctor dropdown
                }
            });

            // Fetch services based on selected department
            $.ajax({
                url: 'get_services.php', // PHP script to fetch services
                type: 'GET',
                data: {
                    departmentid: departmentId
                },
                dataType: 'json',
                success: function(services) {
                    $.each(services, function(index, service) {
                        $('#service').append(
                            `<option value="${service.service_id}">${service.service_name}</option>`
                        );
                    });
                    $('#service').prop('disabled', false); // Enable service dropdown
                }
            });
        }
    });
});
</script>
<!-- Date -->
<script>
const dateInput = document.getElementById('appointmentdate');

dateInput.addEventListener('focus', function() {
    // Get today's date and set it as the min date
    const today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);
});

dateInput.addEventListener('input', function() {
    const selectedDate = new Date(this.value);
    const day = selectedDate.getUTCDay();

    // Disable weekends (Saturday = 6, Sunday = 0)
    if (day === 6 || day === 0) {
        this.value = ''; // Clear the selected value
        alert('Weekends are not allowed. Please select a weekday.');
    }
});
</script>

<?php include('footer.php');?>