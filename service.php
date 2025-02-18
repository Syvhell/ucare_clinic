<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_POST['btn_submit']))
{
    if(isset($_GET['editid']))
    {
        $sql ="UPDATE services SET service_name='$_POST[service_name]',department_id='$_POST[department]' WHERE service_id='$_GET[editid]'";
        if($qsql = mysqli_query($conn,$sql))
        {
 ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Success
        </h3>
        <p>Service Record Updated Successfully</p>
        <p>
            <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
            <?php echo "<script>setTimeout(\"location.href = 'view-service.php';\",1500);</script>"; ?>
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
        $sql ="INSERT INTO services(department_id,service_name) values('$_POST[department]','$_POST[service_name]')";
        if($qsql = mysqli_query($conn,$sql))
        {
?>
<div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Success
        </h3>
        <p>Service Record Inserted Successfully</p>
        <p>
            <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
            <?php echo "<script>setTimeout(\"location.href = 'view-service.php';\",1500);</script>"; ?>
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
    $sql="SELECT * FROM services WHERE service_id='$_GET[editid]' ";
    $qsql = mysqli_query($conn,$sql);
    $rsedit = mysqli_fetch_array($qsql);
    
}
?>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Service</h4>
                                    <!-- <span>Lorem ipsum dolor sit <code>amet</code>, consectetur adipisicing elit</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a>Service</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Add Service</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-block">
                                    <form id="main" method="post" action="" enctype="multipart/form-data">

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Department</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="department" id="department"
                                                    placeholder="Enter lastname...." required="">
                                                    <option value="">-- Select One --</option>
                                                    <?php
                                                    $sqldepartment= "SELECT * FROM department WHERE delete_status=0";
                                                    $qsqldepartment = mysqli_query($conn,$sqldepartment);
                                                    while($rsdepartment=mysqli_fetch_array($qsqldepartment))
                                                    {
                                                    if($rsdepartment['departmentid'] == $rsedit['department_id'])
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
                                            <label class="col-sm-2 col-form-label">Service Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="service_name"
                                                    id="service_name"
                                                    value="<?php if(isset($_GET['editid'])) { echo $rsedit['service_name']; } ?>" />
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

<?php include('footer.php');?>

<script type="text/javascript">
$('#main').keyup(function() {
    $('#confirm-pw').html('');
});

$('#cnfirmpassword').change(function() {
    if ($('#cnfirmpassword').val() != $('#password').val()) {
        $('#confirm-pw').html('Password Not Match');
    }
});

$('#password').change(function() {
    if ($('#cnfirmpassword').val() != $('#password').val()) {
        $('#confirm-pw').html('Password Not Match');
    }
});
</script>