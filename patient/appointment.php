<?php
session_start();
include("../include/connection.php");
include("../include/header.php");

$patientUsername = $_SESSION['patient'];
$patientQuery = "SELECT * FROM patient WHERE username='$patientUsername'";
$patientResult = mysqli_query($con, $patientQuery);
$patientData = mysqli_fetch_array($patientResult);

$firstname = $patientData['firstname'];
$surname = $patientData['surname'];
$gender = $patientData['gender'];
$phone = $patientData['phone'];

if (isset($_POST['book'])) {
    $date = $_POST['date'];
    $sym = $_POST['sym'];
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $patientData['patient_id'];

    if (!empty($sym)) {
        // Assuming 'details' or a similar column exists to store symptoms or other information
        $query = "INSERT INTO appointment (patient_id, doctor_id, appointment_date, symptoms, status, date_booked) 
                  VALUES ('$patient_id', '$doctor_id', '$date', '$sym', 'Scheduled', NOW())";

        $res = mysqli_query($con, $query);
        if ($res) {
            echo "<script>alert('You have booked an appointment');</script>";
            
        }
    }
    // Handle the case where 'sym' is empty
}


// Fetch available doctors from the database
$doctorsQuery = "SELECT doctor_id, firstname, surname FROM doctors";
$doctorsResult = mysqli_query($con, $doctorsQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Name of the website</title>
</head>
<body>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px">
                <?php include("sidenav.php"); ?>
            </div>

            <div class="col-md-10">
                <h5 class="text-center my-2">Book Appointment</h5>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 jumbotron">
                            <form action="" method="post">
                                <label for="">Select Doctor</label>
                                <select name="doctor_id" class="form-control" required>
                                    <option value="">Select a Doctor</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($doctorsResult)) {
                                        echo "<option value='" . $row['doctor_id'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
                                    }
                                    ?>
                                </select>

                                <label for="">Appointment Date</label>
                                <input type="date" name="date" class="form-control" required>

                                <label for="">Symptoms</label>
                                <input type="text" name="sym" class="form-control" autocomplete="off" placeholder="Enter Symptoms" required>

                                <input type="submit" name="book" class="btn btn-info my-2" value="Book Appointment">
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
