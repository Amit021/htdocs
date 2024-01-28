<?php
session_start();
include("../include/header.php");
include("../include/connection.php");

if (!isset($_SESSION['data'])) {
    header("Location: ../common_login.php");
    exit();
}
$doctorId = $_SESSION['data']['doctor_id'];

$query = "SELECT * FROM appointment WHERE doctor_id = '$doctorId'";
$res = mysqli_query($con, $query);

$output = "
    <table class='table table-bordered'>
        <tr>
            <td>ID</td>
            <td>Firstname</td>
            <td>Surname</td>
            <td>Gender</td>
            <td>Phone</td>
            <td>Appointment Date</td>
            <td>Symptoms</td>
            <td>Date Booked</td>
            <td>Action</td>
        </tr>
";

if (mysqli_num_rows($res) < 1) {
    $output .= "
        <tr>
            <td class='text-center' colspan='9'>No Appointment Yet</td>
        </tr>
    ";
}

while ($row = mysqli_fetch_assoc($res)) {
    $output .= "
        <tr>
            <td>" . htmlspecialchars($row['appointment_id'] ?? '') . "</td>
            <td>" . htmlspecialchars($row['firstname'] ?? 'N/A') . "</td>
            <td>" . htmlspecialchars($row['surname'] ?? 'N/A') . "</td>
            <td>" . htmlspecialchars($row['gender'] ?? 'N/A') . "</td>
            <td>" . htmlspecialchars($row['phone'] ?? 'N/A') . "</td>
            <td>" . htmlspecialchars($row['appointment_date'] ?? 'N/A') . "</td>
            <td>" . htmlspecialchars($row['symptoms'] ?? 'N/A') . "</td>
            <td>" . htmlspecialchars($row['date_booked'] ?? 'N/A') . "</td>
            <td>
                <a href='record_treatment_test_page.php?id=" . htmlspecialchars($row['appointment_id'] ?? '') . "&patientId=" . htmlspecialchars($row['patient_id'] ?? '') . "'>
                    <button class='btn btn-info'>Check</button>
                </a>
            </td>
        </tr>
    ";
}

$output .= "</table>";
echo $output;

?>

<?php

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
        echo "<script>alert('Details recorded successfully');</script>";
    } elseif ($_GET['status'] == 'error') {
        echo "<script>alert('Failed to record details');</script>";
    }
}
?>

</body>
</html>
