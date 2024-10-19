<?php
include('connect.php'); // Include your database connection

if (isset($_GET['departmentid'])) {
    $departmentid = $_GET['departmentid'];
    $sql = "SELECT * FROM services WHERE department_id='$departmentid' AND delete_flg=0";
    $result = mysqli_query($conn, $sql);

    $services = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $services[] = $row; // Append each service to the array
    }

    echo json_encode($services); // Return JSON response
}
?>