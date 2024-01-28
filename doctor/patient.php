<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Total Patient</title>
</head>

<body>
<?php
include("../include/header.php");
include ("../include/connection.php");

?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2 " style="margin-left: -30px">
                <?php
                include("sidenav.php");
                ?>
            </div>
            <div class="col-md-10">
                <h5 class="text-center my-3">Total Patients</h5>

                <?php
                $query = "SELECT * FROM patient";
                $res = mysqli_query($con,$query);

                $output = "";
                $output .="
                              <table class='table table-bordered'>
                                 <tr>
                                   <td>ID</td>
                                   <td>Firstname</td>      
                                   <td>Surname</td>
                                   <td>Email</td>
                                    <td>Phone</td>
                                    <td>Gender</td>
                                    <td>Country</td>
                                    <td>Medical Records</td>
   
                                 </tr>
                                 
                              
                             
                          ";
                if (mysqli_num_rows($res) < 1){
                    $output .= "
                                  
                                  <tr>
                                     <td class='text-center' colspan='10'>No Patient Yet</td>
                                  </tr>
                                 
                                
                                ";
                }

                while ($row = mysqli_fetch_array($res)){
                    $output .="
                                 <tr>
                                     <td>".$row['patient_id']."</td>
                                     <td>".$row['firstname']."</td>
                                     <td>".$row['surname']."</td>
                                     <td>".$row['email']."</td>
                                     <td>".$row['phone']."</td>
                                     <td>".$row['gender']."</td>
                                     <td>".$row['country']."</td>

                                     <td>
                                         <a href='view.php?patient_id=".$row['patient_id']."'>
                                         <button class='btn btn-info'>View</button>
                                         </a>
                                     </td>
                                    
                                 </tr>
                                 
                              
                              ";
                }

                $output .="
                             
                             </table>
                          ";

                echo $output;
                ?>
            </div>
        </div>
    </div>
</div>
<script>
        window.onload = function() {
            // Check for URL parameters for status and message
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            const message = urlParams.get('message');
            if (status && message) {
                alert(decodeURIComponent(message));
            }
        }
</script>
</body>

</html>
