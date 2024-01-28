<?php
session_start();
include("../include/header.php");
include("../include/connection.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Patient Details</title>
</head>

<body>
    <div class="col-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-3">View Patient Details</h5>
                    <?php
                    if (isset($_GET['patient_id']) && !empty($_GET['patient_id'])) {
                        $patient_id = $_GET['patient_id'];
                        $patientQuery = "SELECT * FROM patient WHERE patient_id = '$patient_id'";
                        $patientRes = mysqli_query($con, $patientQuery);
                        if ($patientRes && mysqli_num_rows($patientRes) > 0) {
                            $patientRow = mysqli_fetch_array($patientRes);
                            echo "<img src='../patient/img/patient.jpg" . $patientRow['profile'] . "' alt='Patient Profile' class='col-md-12 my-2' height='250px' style='width:35%; display: block; margin-left: auto; margin-right: auto;'>";
                            echo "<table class='table table-hover table-dark'>";
                            echo "<tr><th class='text-center' colspan='2'>Details</th></tr>";
                            echo "<tr><td>Firstname</td><td>" . $patientRow['firstname'] . "</td></tr>";
                            echo "<tr><td>Surname</td><td>" . $patientRow['surname'] . "</td></tr>";
                            echo "<tr><td>Username</td><td>" . $patientRow['username'] . "</td></tr>";
                            echo "<tr><td>Email</td><td>" . $patientRow['email'] . "</td></tr>";
                            echo "<tr><td>Phone</td><td>" . $patientRow['phone'] . "</td></tr>";
                            echo "<tr><td>Gender</td><td>" . $patientRow['gender'] . "</td></tr>";
                            echo "<tr><td>Country</td><td>" . $patientRow['country'] . "</td></tr>";
                            //echo "<tr><td>Date Registered</td><td>" . $patientRow['date_reg'] . "</td></tr>";
                            echo "</table>";

                            // Fetch and display medical records
                            $recordsQuery = "SELECT * FROM medical_records WHERE patient_id='$patient_id' ORDER BY visit_date DESC";
                            $recordsRes = mysqli_query($con, $recordsQuery);
                            // ... [previous code] ...

                            if ($recordsRes && mysqli_num_rows($recordsRes) > 0) {
                                echo "<h5 class='text-center my-3'>Medical Records</h5>";
                                echo "<table class='table table-hover table-dark'>";
                                echo "<tr><th>Visit Date</th><th>Diagnosis</th><th>Treatment</th><th>Notes</th><th>Actions</th></tr>";
                                while ($recordRow = mysqli_fetch_array($recordsRes)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($recordRow['visit_date']?? 'N/A') . "</td>";
                                    echo "<td>" . htmlspecialchars($recordRow['diagnosis']) . "</td>";
                                    echo "<td>" . htmlspecialchars($recordRow['treatment']) . "</td>";
                                    echo "<td>" . htmlspecialchars($recordRow['notes']) . "</td>";
                                    echo "<td>";
                                    // Edit button
                                    echo "<a href='edit_record.php?record_id=" . $recordRow['record_id'] . "' class='btn btn-secondary'>Edit</a> ";
                                    // Delete button
                                    echo "<a href='delete_record.php?record_id=" . $recordRow['record_id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "<p>No medical records found for this patient.</p>";
                            }
  
// ... [rest of the code] ...

                        } else {
                            echo "<p>No patient details to display or patient not found.</p>";
                        }
                    } else {
                        echo "<p>No patient ID provided.</p>";
                    }  
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
