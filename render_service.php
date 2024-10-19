<?php require_once('check_login.php'); ?>
<?php include('head.php'); ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('connect.php');

function validateRequiredFields($fields) {
    foreach ($fields as $field) {
        if (empty($field)) {
            return false; // A required field is empty
        }
    }
    return true; // All required fields are filled
}

if (isset($_POST['btn_submit'])) {
    // Determine if we're editing an existing appointment or creating a new one
    $isEditing = isset($_GET['editid']);

    $medicineSelected = $_POST['medicines_data'];
    echo "<script>console.log('Medicine Data:', " . json_encode($medicineSelected) . ");</script>";
    
    // Update appointment details if editing
    if ($isEditing) {
        
        $sql = "UPDATE appointment SET patientid='$_POST[patient]', departmentid='$_POST[department]', appointmentdate='$_POST[appointmentdate]', appointmenttime='$_POST[appointmenttime]', doctorid='$_POST[doctor]', app_reason='$_POST[app_reason]',status='Rendered' WHERE appointmentid='$_GET[editid]'";
        mysqli_query($conn, $sql);


        // Common code to handle treatment records for updating
        // Update patient status
        $sql = "UPDATE patient SET status='Active' WHERE patientid='$_POST[patient]'";
        mysqli_query($conn, $sql);

        // Collect medicine names for treatment records
        $medicine_names = [];

      if (isset($_POST['medicines_data'])) {
            // Decode the JSON data from the hidden input
            $medicines_data = json_decode($_POST['medicines_data'], true);

            foreach ($medicines_data as $medicine) {
                $medicine_id = $medicine['medicine_id'];
                $med_qty = $medicine['quantity'];

                // Get the medicine details from the inventory
                $sql_get_medicine = "SELECT medicine_name, medicine_qty FROM medicine_inventory WHERE medicine_id = '$medicine_id'";
                $result_medicine = mysqli_query($conn, $sql_get_medicine);

                if ($result_medicine && mysqli_num_rows($result_medicine) > 0) {
                    $row_medicine = mysqli_fetch_assoc($result_medicine);
                    $medicine_name = $row_medicine['medicine_name'];
                    $available_qty = $row_medicine['medicine_qty']; // Get available quantity directly from the first query
                    
                    // Check if the entered quantity is valid
                    if ($med_qty <= 0) {
                        echo "Quantity must be greater than zero for medicine ID: $medicine_id.";
                        continue; // Skip to the next iteration
                    }

                    if ($med_qty > $available_qty) {
                        echo "Not enough stock for medicine ID: $medicine_id. Available: $available_qty, Requested: $med_qty.";
                        continue; // Skip to the next iteration
                    }

                    // Update inventory (deduct the quantity)
                    $sql_update_inventory = "UPDATE medicine_inventory SET medicine_qty = medicine_qty - $med_qty WHERE medicine_id = '$medicine_id'";
                    if (!mysqli_query($conn, $sql_update_inventory)) {
                        echo "Failed to update inventory for medicine ID: $medicine_id. Error: " . mysqli_error($conn);
                        continue; // Skip to the next iteration
                    }

                    // Store the medicine name for later use
                    $medicine_names[] = $medicine_name;
                } else {
                    echo "Failed to retrieve medicine for ID: $medicine_id. Error: " . mysqli_error($conn);
                    continue; // Skip to the next iteration
                }
            }
        }

        echo "<script>console.log(". json_encode($medicine_names) .");</script>";

        echo "<script>console.log('Error: 3');</script>";

        // Convert the medicine names array to a comma-separated string
        $medicine_names_str = implode(", ", $medicine_names);

        // Insert treatment records, using the existing appointment ID
        $sql = "INSERT INTO treatment_records(serviceid, appointmentid, patientid, doctorid, treatment_description, medicine_dispense, treatment_date, treatment_time, status) 
                VALUES ('$_POST[service_id]', '$_GET[editid]', '$_POST[patient]', '$_POST[doctor]', '$_POST[diagnosis]', '$medicine_names_str', '$_POST[appointmentdate]', '$_POST[appointmenttime]', 'Active')";
        echo "<script>console.log('Error: 4');</script>";

        if($qsql = mysqli_query($conn,$sql))
                {
        ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Success
        </h3>
        <p>Treatmen Recorded Successfully</p>
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

    } else {
        // Insert new appointment details
        $sql = "INSERT INTO appointment (patientid, departmentid, appointmentdate, appointmenttime, doctorid, app_reason) VALUES ('$_POST[patient]', '$_POST[department]', '$_POST[appointmentdate]', '$_POST[appointmenttime]', '$_POST[doctor]', '$_POST[app_reason]')";

        if ($qsql = mysqli_query($conn, $sql)) {
            // Get the appointment ID of the newly created appointment
            $appointmentid = mysqli_insert_id($conn);
        } else {
            echo mysqli_error($conn);
        }
    }
}
if (isset($_GET['editid'])) {
    $sql = "SELECT * FROM appointment WHERE appointmentid='$_GET[editid]'";
    $qsql = mysqli_query($conn, $sql);
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
                                    <h4>Treatment Details</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a>Treatment</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="add_user.php">Treatment</a>
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
                                    <form id="main" method="post" action="" enctype="multipart/form-data"
                                        onsubmit="return handleSubmit()">
                                        <?php
                                            if (isset($_GET['patid'])) {
                                                $sqlpatient = "SELECT * FROM patient WHERE patientid='" . $_GET['patid'] . "'";
                                                $qsqlpatient = mysqli_query($con, $sqlpatient);
                                                $rspatient = mysqli_fetch_array($qsqlpatient);
                                                echo $rspatient[$patientname] . " (Patient ID - $rspatient[patientid])";
                                                echo "<input type='hidden' name='select4' value='$rspatient[patientid]'>";
                                            }
                                            ?>
                                        <input type="hidden" class="form-control" name="appointmentid"
                                            id="appointmentid"
                                            value="<?php if (isset($_GET['editid'])) { echo $rsedit['appointmentid']; } ?>" />


                                        <div class="form-group row">
                                            <labe lhtmlFor="" class="col-sm-2 col-form-label">Patient</labe>
                                            <div class="col-sm-4">
                                                <?php
                                                    $sqlpatient = "SELECT * FROM patient WHERE patientid = '".$rsedit['patientid']."'";
                                                    $qsqlpatient = mysqli_query($conn, $sqlpatient);
                                                    $rspatient = mysqli_fetch_array($qsqlpatient);

                                                     echo "<input value='{$rspatient['patientid']}'  type='hidden' class='form-control' name='patient' id='patient' readonly />";
                                                    
                                                    echo "<input value='{$rspatient['patientname']}' type='text' class='form-control' readonly />";
                                                   
                                                    ?>
                                                <span class="messages"></span>
                                            </div>

                                            <label htmlFor="" class="col-sm-2 col-form-label">Department</label>
                                            <div class="col-sm-4">
                                                <?php
                                                    $sqldepartment= "SELECT * FROM department WHERE delete_status = 0";
                                                    $qsqldepartment = mysqli_query($conn,$sqldepartment);
                                                    $rsdepartment=mysqli_fetch_array($qsqldepartment);

                                                    echo "<input value='$rsdepartment[departmentid]'  type='hidden' class='form-control' name='department' id='department'  />";
                                                    
                                                    echo "<input value='$rsdepartment[departmentname]' type='text' class='form-control' readonly />";
                                                ?>
                                                <span class="messages"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label htmlFor="" class="col-sm-2 col-form-label">Date</label>
                                            <div class="col-sm-4">
                                                <input type="date" class="form-control" name="appointmentdate"
                                                    id="appointmentdate"
                                                    value="<?php if(isset($_GET['editid'])) { echo $rsedit['appointmentdate']; } ?>"
                                                    readonly />
                                                <span class="messages"></span>
                                            </div>

                                            <label htmlFor="" class="col-sm-2 col-form-label">Time</label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" name="appointmenttime"
                                                    id="appointmenttime"
                                                    value="<?php if(isset($_GET['editid'])) { echo $rsedit['appointmenttime']; } ?>"
                                                    readonly />

                                                <span class="messages"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label htmlFor="" class="col-sm-2 col-form-label">Doctor</label>
                                            <div class="col-sm-4">
                                                <?php
                                                        $sqldoctor= "SELECT * FROM doctor WHERE delete_status=0";
                                                        $qsqldoctor = mysqli_query($conn,$sqldoctor);
                                                        $rsdoctor = mysqli_fetch_array($qsqldoctor);

                                                        echo "<input value='$rsdoctor[doctorid]' type='hidden' class='form-control' name='doctor' id='doctor'  />";
                                    
                                                        echo "<input value='$rsdoctor[doctorname]' type='text' class='form-control' readonly />";
                                                    ?>
                                            </div>
                                            <label htmlFor="" class="col-sm-2 col-form-label">Service to Avail</label>
                                            <div class="col-sm-4">
                                                <?php
                                                        $sqlservices= "SELECT * FROM services WHERE delete_flg=0";
                                                        $qsqlservices = mysqli_query($conn,$sqlservices);
                                                        $rsservices = mysqli_fetch_array($qsqlservices);

                                                        echo "<input value='$rsservices[service_id]' type='hidden' class='form-control' name='service_id' id='service_id'  />";
                        
                                                        echo "<input value='$rsservices[service_name]' type='text' class='form-control' readonly />";

                                                    ?>

                                                <span class="messages"></span>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label htmlFor="" class="col-sm-2 col-form-label">Appointment Reason</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="app_reason" required
                                                    id="app_reason"
                                                    value="<?php if(isset($_GET['editid'])) { echo $rsedit['app_reason']; } ?>"
                                                    readonly />
                                                <span class="messages"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label htmlFor="" class="col-sm-2 col-form-label">Diagnosis</label>
                                            <div class="col-sm-10">
                                                <textarea style="height:10rem; overflow:auto" class="form-control"
                                                    name="diagnosis" required id="diagnosis"></textarea>
                                                <span class="messages"></span>
                                            </div>
                                        </div>


                                        <!-- Medicine Dispense Section -->

                                        <div id="medicine-container"></div>

                                        <div class="form-group row">
                                            <div class="col-sm-12 text-right">
                                                <button type="button" class="btn btn-primary"
                                                    onclick="addMedicineField()">Dispense Medicine</button>
                                            </div>
                                        </div>
                                        <script>
                                        // Declare an array to store the selected medicines and quantities
                                        var medicines = [];

                                        // Function to add a new medicine field
                                        function addMedicineField() {
                                            var medicineContainer = document.getElementById('medicine-container');
                                            var newField = document.createElement('div');
                                            newField.classList.add('form-group', 'row');

                                            newField.innerHTML = `
                                       
                                    <label class="col-sm-2 col-form-label">Medicine</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="medicine[]" required onchange="getSelectedMedicine(this)">
                                            <option value="">-- Select One --</option>
                                            <?php
                                            $sqlmedicine = "SELECT * FROM medicine_inventory WHERE delete_flg = 0";
                                            $qsqlmedicine = mysqli_query($conn, $sqlmedicine);
                                            while ($rsmedicine = mysqli_fetch_array($qsqlmedicine)) {
                                                echo "<option value='$rsmedicine[medicine_id]'>$rsmedicine[medicine_name] ($rsmedicine[medicine_qty] pcs)</option>";
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="medicine_names[]" value="" />
                                        <span class="messages"></span>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Medicine Dispense Quantity</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" name="med_qty[]" required min="1" />
                                        <span class="messages"></span>
                                    </div>

                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-danger" onclick="removeMedicineField(this)">Remove</button>
                                    </div>
                                    
                                    `;

                                            medicineContainer.appendChild(newField);
                                        }

                                        // Function to remove a medicine field
                                        function removeMedicineField(button) {
                                            button.closest('.form-group.row').remove();
                                        }

                                        // Function to handle selected medicine
                                        function getSelectedMedicine(selectElement) {
                                            var selectedOption = selectElement.options[selectElement.selectedIndex];
                                            var medicineId = selectedOption.value;
                                            var fullText = selectedOption.text;
                                            var medicineName = fullText.split(' (')[0];

                                            selectElement.closest('.form-group.row').querySelector(
                                                'input[name="medicine_names[]"]').value = medicineName;
                                        }

                                        // Function to get medicine data and update the array
                                        function getMedicineData() {
                                            var rows = document.querySelectorAll('#medicine-container .form-group.row');

                                            medicines = []; // Reset the array
                                            rows.forEach(function(row) {
                                                var medicineId = row.querySelector('select[name="medicine[]"]')
                                                    .value;
                                                var medicineName = row.querySelector(
                                                        'input[name="medicine_names[]"]')
                                                    .value;
                                                var quantity = row.querySelector('input[name="med_qty[]"]')
                                                    .value;

                                                if (medicineId && quantity > 0) {
                                                    medicines.push({
                                                        medicine_id: medicineId,
                                                        medicine_name: medicineName,
                                                        quantity: quantity
                                                    });
                                                }
                                            });
                                        }

                                        // Function to handle form submission
                                        function handleSubmit() {
                                            getMedicineData(); // Update the medicines array

                                            // Store the array as a JSON string in the hidden input field
                                            document.getElementById('medicines_data').value = JSON.stringify(medicines);

                                            console.log('Medicines:', medicines); // For debugging

                                            return true; // Allow the form to submit
                                        }
                                        </script>


                                        <!-- Hidden field to store the medicines array -->
                                        <input type="hidden" name="medicines_data" id="medicines_data" value="" />

                                        <div class="form-group row">
                                            <div class="col-sm-12 text-right">
                                                <button type="submit" name="btn_submit"
                                                    class="btn btn-primary m-b-0">Submit</button>
                                            </div>
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
<?php include('footer.php'); ?>