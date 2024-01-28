
<?php
include("include/header.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>HMS Home Page</title>

</head>

<body>

      <div style="margin-top: 50px"></div>
      <div class="container">
          <!--Start setting the browser screen at standard width division of 12-->
          <div class="col-md-12">
              <!--Setting the (rows) to cater for the number sections the 12-division will carry
                 Within the Row, you can divide it example as (4-4-3), (3,3,3,3), (6-6), (6-3-3),etc
              -->
              <div class="row d-flex justify-content-center">

                  <!--1st division set at (col-md-3) and margin/gap in horizontal line set to (mx-1), and adding bootstrap (shadow) to element -->
                  <div class="col-md-3 mx-1 shadow">
                   
                      <!-- design this division with an image   -->
                        <img src="img/info.png" alt="" style="width: 100%; height: 190px">
                         <!--a description for the image, and bootstrap class to center the image-->
                        <h5 class="text-center">Click on the button for more information</h5>
                         <!--Anchor Tag to make the button clickable and to redirect the link -->
                        <a href="">
                            <button class="btn btn-success my-3" style="margin-left: 20%">More Information</button>
                        </a>

                  </div>

                  <!--2nd division set at (col-md-3) and margin/gap in horizontal line set to (mx-1), and adding bootstrap (shadow) to element -->
                  <div class="col-md-3 mx-1 shadow">
                      <!-- design this division with an image   -->
                      <img src="img/patient.jpeg" alt="" style="width: 100%; height: 190px">
                      <!--a description for the image, and bootstrap class to center the image-->
                      <h5 class="text-center">Create Account so that we can take good care of you</h5>
                      <!--Anchor Tag to make the button clickable and to redirect the link -->
                      <a href="common_registration.php">
                          <button class="btn btn-success my-3" style="margin-left: 30%">Create Account..!!</button>
                      </a>

                  </div>

                  
              </div>
          </div>
          <!--Start setting the browser screen at standard width division of 12-->
      </div>
</body>
</html>


