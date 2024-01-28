<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: common_login.php"); // Redirect to login page if not logged in
    exit();
}
/* if (isset($_SESSION["data"])) {
    var_dump($_SESSION["data"]);
} */
?>


<!DOCTYPE html>
<html lang="en">
      <head>
           <title>Admin Dasboard</title>
      </head>
<body>

<?php

include("../include/header.php");
include("../include/connection.php");
?>


<!--The container-fluid occupies full width of the screen -->
<div class="container-fluid">
      <div class="col-md-12"><!--setting the element to the total length columns of a browser-->
          <!--.-->
          <div class="row">
                 <!---->
                 <div class="col-md-2" style="margin-left: -30px">

                     <!--Sidenav-->
                    <!-- <div class="list-group bg-info" style="height: 90vh">
                         <a href="index.php" class="list-group-item list-group-item-action bg-info text-center">Dashboard</a>
                         <a href="admin.php" class="list-group-item list-group-item-action bg-info text-center">Administrators</a>
                         <a href="doctor.php" class="list-group-item list-group-item-action bg-info text-center">Doctors</a>
                         <a href="patient.php" class="list-group-item list-group-item-action bg-info text-center">Patients</a>
                     </div>-->
                     <!--END Sidenav-->
                     <?php
                        /*pasted the above in a different file.*/
                         include("sidenav.php");
                     ?>


                 </div>

              <!--This is the second column created -->
              <div class="col-md-10">
                     <!--Giving a title description to Columns-->
                     <h4 class="my-2">Admin Dashboard</h4>

                  <!--Inside the 2nd Column for the dashboard, we set a column divider to total 12-->
                     <div class="col-md-12 my-1">
                         <!--bootstrap row to arrange items in rows-->
                          <div class="row">
                              <!--First row for the parent column is set to Medium 3, gave it a success colour, and an interval of 2px-->
                               <div class="col-md-3 bg-success mx-2" style=" height: 130px">
                                     <!---->
                                      <div class="col-md-12">
                                            <div class="row">
                                                  <div class="col-md-8">
                                                      <?php
                                                         $ad = mysqli_query($con, "SELECT * FROM admin");
                                                         $num = mysqli_num_rows($ad);
                                                      ?>
                                                        <!--<h5 class="my-2 text-white" style="font-size:30px">0</h5>-->
                                                      <h5 class="my-2 text-white" style="font-size:30px"><?php echo $num?></h5>
                                                        <h5>Total</h5>
                                                        <h5>Admin</h5>
                                                  </div>

                                                   <div class="col-md-4">
                                                       <a href="admin.php"><i class="fa fa-users-cog fa-3x my-4" style="color: white"></i></a>
                                                   </div>

                                            </div>
                                      </div>
                               </div>

                              <div class="col-md-3 bg-info mx-2" style="height: 130px">
                                       <!--After Accepting/rejecting Application using the code in (ajax_approve.php)
                                           (ajax_reject.php)(ajax_show_jo_request.php) to either (reject) or (accept),
                                            it will update each of the request in the database table named (doctors) from (Pending) to (Approve)
                                            or (Pending) to (Reject)

                                        -->
                                  <?php
                                     $doctor = mysqli_query($con, "SELECT * FROM doctors");
                                     $num2  = mysqli_num_rows($doctor);
                                  ?>
                                  <div class="col-md-12">
                                      <div class="row">
                                          <div class="col-md-8">
                                              <!--<h5 class="my-2 text-white" style="font-size:30px">0</h5>-->
                                              <h5 class="my-2 text-white" style="font-size:30px"><?php echo $num2?></h5>
                                              <h5>Total</h5>
                                              <h5>Doctors</h5>
                                          </div>

                                          <div class="col-md-4">
                                              <a href="doctor.php"><i class="fa fa-user-md fa-3x my-4" style="color: white"></i></a>
                                          </div>

                                      </div>
                                  </div>

                              </div>
                              <?php
                                 $patient = mysqli_query($con, "SELECT * FROM patient");
                                 $num3  = mysqli_num_rows($patient);
                              ?>
                                    <div class="col-md-3 bg-warning mx-2" style="height: 130px">
                                        <div class="col-md-12">
                                            <div class="row">
                                          <div class="col-md-8">
                                              <?php
                                                  $p = mysqli_query($con, "SELECT * FROM patient");
                                                  $pp = mysqli_num_rows($p);
                                              ?>

                                              <h5 class="my-2 text-white" style="font-size:30px"><?php echo $num3?></h5>
                                              <h5>Total</h5>
                                              <h5>Patients</h5>
                                          </div>

                                          <div class="col-md-4">
                                              <a href="../doctor/patient.php"><i class="fa fa-procedures fa-3x my-4" style="color: white"></i></a>
                                          </div>

                                            </div>
                                        </div>
                                    </div>

                             

                          </div>
                      </div>

              </div>
          </div>

      </div>

  </div>


</body>
</html>







.
