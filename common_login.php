<?php
session_start();
include("include/connection.php");

$error = array();

if (isset($_POST['login'])) {
    $role = $_POST['role']; // Role selected by the user
    $uname = $_POST['uname'];
    $password = $_POST['pass'];

    if (empty($uname)) {
        $error['login'] = "Enter Username";
    } elseif (empty($password)) {
        $error['login'] = "Enter Password";
    } else {
        // Check the role and set the query accordingly
        if ($role == 'admin') {
            $query = "SELECT * FROM admin WHERE username='$uname' AND password='$password'";
            $target_dashboard = 'admin/index.php';
            $session_role = 'admin';
        } elseif ($role == 'doctor') {
            $query = "SELECT * FROM doctors WHERE username='$uname' AND password='$password'";
            $target_dashboard = 'doctor/index.php';
            $session_role = 'doctor';
        
        } elseif ($role == 'patient') {
            $query = "SELECT * FROM patient WHERE username='$uname' AND password='$password'";
            $target_dashboard = 'patient/index.php';
            $session_role = 'patient';
        } else {
            $error['login'] = "Invalid Role Selected";
        }

        if (count($error) == 0) {
            $res = mysqli_query($con, $query);
            $data = $res->fetch_assoc();
            $_SESSION["data"] = $data;
            echo $data;

            if (isset($res)) { // Check if $res is defined
                if (mysqli_num_rows($res) == 1) {
                    $_SESSION[$session_role] = $uname; // Set session for role
                    header("Location: $target_dashboard");
                    exit();
                } else {
                    $error['login'] = 'Invalid Account or Password';
                }
            } else {
                // Handle query execution error
                $error['login'] = 'Error executing the query: ' . mysqli_error($con);
            }
        }
    }
}

if (isset($error['login'])) {
    $l = $error['login'];
    $show = "<h5 class='text-center alert alert-danger'>$l</h5>";
} else {
    $show = "";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Common Login Page</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- ... other resources ... -->
</head>
<body style="background-image: url('img/hospBuild.jpg'); background-repeat: no-repeat; background-size: cover">
<?php include("include/header.php"); ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 jumbotron my-5">
                    <h5 class="text-center my-5">Unified Login</h5>
                    <div><?php echo $show ?></div>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="role" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="doctor">Doctor</option>
                                <option value="patient">Patient</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                        </div>
                        <input type="submit" name="login" class="btn btn-info my-3" value="Login">
                    </form>
                    <p class="text-center">Don't have an account? <a href="patientaccount.php">Register here</a></p>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>
</html>