<!-- Author Name: Nikhil Bhalerao +919423979339. 
PHP, Laravel and Codeignitor Developer
-->
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_GET['id']))
{
  $sql ="UPDATE medicine_inventory SET delete_flg='1' WHERE medicine_id='$_GET[id]'";
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
        <p>Medicine record deleted successfully.</p>
        <p>
            <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
            <?php echo "<script>setTimeout(\"location.href = 'view-medicine.php';\",1500);</script>"; ?>
        </p>
    </div>
</div>
<?php
    //echo "<script>alert('Medicine record deleted successfully..');</script>";
    //echo "<script>window.location='view-medicine.php';</script>";
  }
}
?>
<?php
if(isset($_GET['delid']))
{ ?>
<div class="popup popup--icon -question js_question-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Sure
            </h1>
            <p>Are You Sure To Delete This Record?</p>
            <p>
                <a href="view-medicine.php?id=<?php echo $_GET['delid']; ?>" class="button button--success"
                    data-for="js_success-popup">Yes</a>
                <a href="view-medicine.php" class="button button--error" data-for="js_success-popup">No</a>
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
                                    <h4>Medicine</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a>Medicine</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Medicine</a>
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
                            </div>

                        </div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Medicine name</th>
                                            <th>Medicine quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql ="SELECT * FROM medicine_inventory where delete_flg='0'";
                                        $qsql = mysqli_query($conn,$sql);
                                        while($rs = mysqli_fetch_array($qsql))
                                        {
                                          echo "<tr>
                                            <td>&nbsp;$rs[medicine_name]</td>
                                            <td>&nbsp;$rs[medicine_qty]</td>
                                            <td>&nbsp;
                                            <a href='medicine.php?editid=$rs[medicine_id]' class='btn btn-primary'>Edit</a> 
                                            <a href='view-medicine.php?delid=$rs[medicine_id]' class='btn btn-danger'>Delete</a></td>
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