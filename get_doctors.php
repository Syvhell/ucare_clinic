<?php
include('connect.php'); // Include your database connection

if (isset($_GET['departmentid'])) {
    $departmentid = $_GET['departmentid'];
    $sql = "SELECT * FROM doctor WHERE departmentid='$departmentid' AND delete_status=0";
    $result = mysqli_query($conn, $sql);

    $doctors = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $doctors[] = $row; // Append each doctor to the array
    }

    echo json_encode($doctors); // Return JSON response
}
?>