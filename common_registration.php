<?php
session_start();
include("include/connection.php");

$error = array();
$show = "";
$role = "";

// Registration Handling
if (isset($_POST['register'])) {
    $role = $_POST['role'];
  
    

    if ($role == 'admin') {
        $profile = $_POST['profile1'] ?? '';
        $username = $_POST['username1'] ?? '';
        $password = $_POST['password1'] ?? ''; 
        $query = $con->prepare("INSERT INTO admin (username, password, profile) VALUES (?, ?, ?)");
        $query->bind_param("sss", $username, $password, $profile);
    } 
    if ($role == 'doctor') {
        $username = $_POST['username2'] ?? '';
        $password = $_POST['password2'] ?? ''; 
        $firstname = $_POST['firstname2'] ?? '';
        $surname = $_POST['surname2'] ?? '';
        $specialty = $_POST['specialty2'] ?? '';
        $phone = $_POST['phone2'] ?? '';
        $email = $_POST['email2'] ?? '';
        $data_reg = $_POST['data_reg2'] ?? '';
        $profile = $_POST['profile2'] ?? '';
        $country = $_POST['country2'] ?? '';
        $gender = $_POST['gender2'] ?? 'other';
        $query = $con->prepare("INSERT INTO doctors (firstname, surname, specialty, phone, email, username, password, gender, data_reg, country, profile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("sssssssssss", $firstname, $surname, $specialty, $phone, $email, $username, $password, $gender, $data_reg, $country, $profile);
    } 
    if ($role == 'patient') {
        $username = $_POST['username3'] ?? '';
        $password = $_POST['password3'] ?? ''; 
        $firstname = $_POST['firstname3'] ?? '';
        $surname = $_POST['surname3'] ?? '';
        $dob = $_POST['date_of_birth3'] ?? '';
        $phone = $_POST['phone3'] ?? '';
        $email = $_POST['email3'] ?? '';
        $country = $_POST['country3'] ?? '';
        $date_reg = $_POST['date_reg3'] ?? '';
        $address = $_POST['address3'] ?? '';
        $profile = $_POST['profile3'] ?? '';
        $gender = $_POST['gender3'] ?? 'other';
        $query = $con->prepare("INSERT INTO patient (firstname, surname, date_of_birth, phone, email, username, password, gender, address, date_reg, country, profile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssssssssssss", $firstname, $surname, $dob, $phone, $email, $username, $password, $gender, $address, $data_reg, $country, $profile);
    }    

    if (isset($query)) {
        $result = $query->execute();
        if ($result) {
            $show = "<h5 class='text-center alert alert-success'>Registration Successful!</h5>";
        } else {
            $error['register'] = 'Error in registering. Try again.';
        }
    }
}
?>

<!-- HTML content follows -->


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Common Registration Page</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function showRoleSpecificFields() {
            var role = document.getElementById("role").value;
            document.getElementById("adminFields").style.display = (role === "admin") ? "block" : "none";
            document.getElementById("doctorFields").style.display = (role === "doctor") ? "block" : "none";
            document.getElementById("patientFields").style.display = (role === "patient") ? "block" : "none";
        }
    </script>
</head>
<body style="background-image: url('img/your_background_image.jpeg'); background-repeat: no-repeat; background-size: cover">
    <?php include("include/header.php"); ?>
    <div id="registrationForm" class="row justify-content-center">
            <div class="col-md-6">
                <div class="jumbotron my-5">
                    <h5 class="text-center">Registration</h5>
                    <form method="post" action="common_registration.php">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="role" onchange="showRoleSpecificFields()">
                                <option value="select">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="doctor">Doctor</option>
                                <option value="patient">Patient</option>
                            </select>
                        </div>

                        <!-- Admin Specific Fields -->
                        <div id="adminFields" style="display: none;">
                            <div class="form-group">
                                <label for="usernameAdmin">Username</label>
                                <input type="text" name="username1" class="form-control"  placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="passwordAdmin">Password</label>
                                <input type="text" name="password1" class="form-control"  placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="profileAdmin">Profile</label>
                                <input type="text" name="profile1" class="form-control" placeholder="Profile Description">
                            </div>
                        </div>

                        <!-- Doctor Specific Fields -->
                        <div id="doctorFields" style="display: none;">
                            <div class="form-group">
                                <label for="firstnameDoctor">First Name</label>
                                <input type="text" name="firstname2" class="form-control" id="firstnameDoctor" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label for="surnameDoctor">Surname</label>
                                <input type="text" name="surname2" class="form-control" id="surnameDoctor" placeholder="Surname">
                            </div>
                            <div class="form-group">
                                <label for="specialtyDoctor">Specialty</label>
                                <input type="text" name="specialty2" class="form-control" id="specialtyDoctor" placeholder="Specialty">
                            </div>
                            <div class="form-group">
                                <label for="phoneDoctor">Phone</label>
                                <input type="text" name="phone2" class="form-control" id="phoneDoctor" placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <label for="emailDoctor">Email</label>
                                <input type="email" name="email2" class="form-control" id="emailDoctor" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="usernameDoctor">Username</label>
                                <input type="text" name="username2" class="form-control" id="usernameDoctor" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="passwordDoctor">Password</label>
                                <input type="text" name="password2" class="form-control" id="passwordDoctor" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="genderDoctor">Gender</label>
                                <select name="gender2" class="form-control" id="genderDoctor">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                            <!-- ... [Doctor Fields] ... -->
                        </div>

                        <!-- Patient Specific Fields -->
                        <div id="patientFields" style="display: none;">
                            <div class="form-group">
                                <label for="firstnamePatient">First Name</label>
                                <input type="text" name="firstname3" class="form-control" id="firstnamePatient" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label for="surnamePatient">Surname</label>
                                <input type="text" name="surname3" class="form-control" id="surnamePatient" placeholder="Surname">
                            </div>
                            <div class="form-group">
                                <label for="passwordPatient">Password</label>
                                <input type="text" name="password3" class="form-control" id="passwordPatient" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="userPatient">User Name</label>
                                <input type="text" name="username3" class="form-control" id="userPatient" placeholder="User Name">
                            </div>
                            <div class="form-group">
                                <label for="dobPatient">Date of Birth</label>
                                <input type="date" name="date_of_birth3" class="form-control" id="dobPatient">
                            </div>
                            <div class="form-group">
                                <label for="genderPatient">Gender</label>
                                <select name="gender3" class="form-control" id="genderPatient">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phonePatient">Phone</label>
                                <input type="text" name="phone3" class="form-control" id="phonePatient" placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <label for="emailPatient">Email</label>
                                <input type="email" name="email3" class="form-control" id="emailPatient" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="addressPatient">Address</label>
                                <textarea name="address3" class="form-control" id="addressPatient" placeholder="Address"></textarea>
                            </div>
                        </div>
                            <!-- ... [Patient Fields] ... -->
                        </div>

                        <input type="submit" name="register" class="btn btn-info my-4" value="Register">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>