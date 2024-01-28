<?php
session_start();

// Check if the user is logged in and has the right privilege
// For example, let's assume only doctors can delete records
if (!isset($_SESSION['data'])) {
    // If not a doctor, or not logged in, redirect to the login page
    header('Location: common_login.php');
    exit();
}

include("../include/connection.php");

if (isset($_GET['record_id'])) {
    $record_id = $_GET['record_id'];

    // Prepare a delete statement
    $query = "DELETE FROM medical_records WHERE record_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $record_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to a confirmation page or back to the records list with a success message
        header('Location: patient.php?status=success&message=Record deleted successfully');
    } else {
        // Redirect back with an error message
        header('Location: patient.php?status=error&message=Unable to delete record');
    }

    // Close statement
    $stmt->close();
} else {
    // Redirect back with an error message if no record ID is set
    header('Location: patient.php?status=error&message=No record ID provided');
}

// Close database connection if it's no longer needed
$con->close();

