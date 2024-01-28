<?php
// Start the session and include necessary files
session_start();
include("../include/header.php");
include("../include/connection.php");

// Check if the record ID is set in the GET request
if (isset($_GET['record_id'])) {
    $record_id = $_GET['record_id'];

    // Fetch the medical record from the database
    $query = "SELECT * FROM medical_records WHERE record_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $record_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve the updated details from the form
        $diagnosis = $_POST['diagnosis'];
        $treatment = $_POST['treatment'];
        $notes = $_POST['notes'];

        // Update the medical record in the database
        $updateQuery = "UPDATE medical_records SET diagnosis = ?, treatment = ?, notes = ? WHERE record_id = ?";
        $updateStmt = $con->prepare($updateQuery);
        $updateStmt->bind_param("sssi", $diagnosis, $treatment, $notes, $record_id);
        
        if ($updateStmt->execute()) {
            echo "<script>alert('Record updated successfully');</script>";
            // Redirect back to the view details page or somewhere else
            header("Location: view.php?patient_id=" . $record['patient_id']);
            exit();
        } else {
            echo "<script>alert('Error updating record');</script>";
        }
    }
    // ... [Rest of the edit form HTML goes here] ...
}



// ... [PHP code from previous example] ...

// Only proceed if a record has been fetched
if (isset($record)) {
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Medical Record</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Medical Record</div>
                        <div class="card-body">
                            <form action="edit_record.php?record_id=<?php echo $record_id; ?>" method="post">
                                <div class="form-group">
                                    <label for="diagnosis">Diagnosis</label>
                                    <input type="text" class="form-control" name="diagnosis" id="diagnosis" required value="<?php echo htmlspecialchars($record['diagnosis']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="treatment">Treatment</label>
                                    <input type="text" class="form-control" name="treatment" id="treatment" required value="<?php echo htmlspecialchars($record['treatment']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" name="notes" id="notes" rows="3"><?php echo htmlspecialchars($record['notes']); ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Record</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
    
    <?php
    } else {
        echo "<p>Record not found.</p>";
    }
    ?>