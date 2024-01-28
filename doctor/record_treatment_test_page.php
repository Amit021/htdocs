<?php
session_start();
include("../include/connection.php");
include("../include/header.php");

if (!isset($_SESSION['doctor'])) {
    header("Location: ../common_login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $visit_date = mysqli_real_escape_string($con, $_POST['visit_date']);
    $diagnosis = mysqli_real_escape_string($con, $_POST['diagnosis']);
    $treatment = mysqli_real_escape_string($con, $_POST['treatment']);
    $notes = mysqli_real_escape_string($con, $_POST['notes']);
    $doctorId = $_SESSION['data'];
}

    
    $recordInsertQuery = $con->prepare("INSERT INTO medical_records (patient_id, notes, diagnosis, treatment, visit_date) VALUES (?, ?, ?, ?, ?)");
    $query = $con->prepare("INSERT INTO medical_records (notes, diagnosis, treatment, visit_date) VALUES (?, ?, ?, ?)");
    $query->bind_param("ssss", $notes, $diagnosis, $treatment, $visit_date);


    
    if (isset($query)) {
        $result = $query->execute();
        if ($result) {
            $show = "<h5 class='text-center alert alert-success'>Registration Successful!</h5>";
        } else {
            $error['register'] = 'Error in registering. Try again.';
        }
    }

?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Record Treatment and Tests</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> <!-- Adjust the path to your CSS file -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2" style="margin-left: -30px;">
                        <?php include("sidenav.php"); ?>
                    </div>
                    <div class="col-md-10">
                        <div class="container">
                            <h5 class="text-center my-2">Patient's Medical Record</h5>
                            
                            <!-- Patient's History Section -->
                            <div class="card mb-3">
                                <div class="card-header">Patient's History</div>
                                <div class="card-body">
                                    <?php if (!empty($patientHistory)): ?>
                                        <?php foreach ($patientHistory as $record): ?>
                                            <p><strong>Visit Date:</strong> <?php echo htmlspecialchars($record['visit_date']?? 'N/A'); ?></p>
                                            <p><strong>Notes:</strong> <?php echo htmlspecialchars($record['notes']); ?></p>
                                            <p><strong>Diagnosis:</strong> <?php echo htmlspecialchars($record['diagnosis']); ?></p>
                                            <p><strong>Treatment:</strong> <?php echo htmlspecialchars($record['treatment']); ?></p>
                                            <hr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>No medical records found for this patient.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                 
                            <!-- New Treatment and Test Record Form -->
                            <h5 class="text-center my-4">Record New Treatment and Tests</h5>
                            
                            <form method="POST" action="record_treatment_test_page.php">
                                <div class="form-group">
                                    <label for="visit_date">Treatment Date:</label>
                                    <input type="date" class="form-control" name="visit_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Diagnosis:</label>
                                    <textarea class="form-control" name="diagnosis" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Treatment:</label>
                                    <textarea class="form-control" name="treatment" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Notes:</label>
                                    <textarea class="form-control" name="notes" required></textarea>
                                </div>
                                <input type="hidden" name="appointment_id" value="<?php echo $appointmentId; ?>">
                                <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
                                
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    



