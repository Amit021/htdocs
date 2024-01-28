<?php

session_start();
if (!isset($_SESSION['patient'])) {
    header("Location: ../common_login.php"); // Redirect to login page if not logged in
    exit();
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
</head>

<body>
<?php

    include ("../include/header.php");
    include ("../include/connection.php")

?>

   <div class="container-fluid">
       <div class="col-md-12">
           <div class="row">
                  <div class="col-md-2" style="margin-left: -30px">
                      <?php
                         include ("sidenav.php");
                      ?>
                  </div>
                  <div class="col-md-10">
                      <div class="my-3">Patient Dashboard</div>


                      <div class="col-md-12">
                           <div class="row">
                                  <div class="col-md-3 bg-info mx-2" style="height: 150px">
                                      <div class="col-md-12">
                                          <div class="row">
                                                 <div class="col-md-8">
                                                       <h5 class="text-white my-4">My Profile</h5>
                                                 </div>
                                              <div class="col-md-4">
                                                  <a href="profile.php">
                                                       <i class="fa fa-user-circle fa-3x my-4" style="color: white"></i>
                                                  </a>
                                              </div>
                                          </div>
                                      </div>

                                  </div>

                               <div class="col-md-3 bg-warning mx-2" style="height: 150px">
                                   <div class="col-md-12">
                                       <div class="row">
                                           <div class="col-md-8">
                                               <h5 class="text-white my-4">Book Appointment</h5>
                                           </div>
                                           <div class="col-md-4">
                                               <a href="appointment.php">
                                                   <i class="fa fa-calendar fa-3x my-4" style="color: white"></i>
                                               </a>
                                           </div>
                                       </div>
                                   </div>

                               </div>

                               


                               </div>
                           </div>
                      </div>

                      <?php

                        if (isset($_POST['send'])){

                            $title = $_POST['send'];
                            $message = $_POST['message'];

                            if (empty($title)){

                            }elseif (empty($message)){

                            }else{
                                $user = $_SESSION['patient'];

                                $query = "INSERT INTO report(title,message,username,date_send) VALUES('$title','$message','$user',NOW())";

                                $res = mysqli_query($con, $query);

                                if ($res){

                                    echo "<script>alert('You have sent Your Report')</script>";
                                }
                            }
                        }
                      ?>

                  


                  </div>
           </div>
       </div>

   </div>
</body>

</html>
