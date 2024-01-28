<?php
session_start();
include("../include/header.php");

?>


<!Doctype html>
<html>
<head>
    <title>Admin </title>

</head>

<body>
   <div class="container-fluid">
       <div class="col-md-12">
           <div class="row">
               <div class="col-md-2" style="margin-left: -30px">
                   <?php
                      include('sidenav.php');
                       include("../include/connection.php")
                   ?>
               </div>
               <div class="col-md-10">

                   <div class="col-md-12">
                       <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-center"> All Admin</h5>
                                <!--querying the database table by stating that IF the USERNAME is not the USERNAME in session then display them
                                    in the TABLE
                                   -->
                                <?php
                                  $ad = $_SESSION['admin'];
                                   $query = "SELECT * FROM admin WHERE username != '$ad'";
                                   $res = mysqli_query($con, $query);
                                   $output = "
                                     <table class='table table-bordered'>
                                     <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th style='width: 10%'>Action</th> 
                                   </tr>
                                    ";

                                    /*Condition stating that IF the queried statement from the database table as done above passes
                                       and is Less than (1) then display below */
                                   if(mysqli_num_rows($res) < 1){

                                       $output .= "<tr><td colspan='3' class='text-center'>No New Admin</td></tr>";
                                   }
                                     /*This condition below state that if Query is TRUE then pass each column names in the database tables in the format
                                       below and display all available rows in the table variable (output).

                                      */
                                   while($row = mysqli_fetch_array($res)){

                                       $id = $row['id'];
                                       $username = $row['username'];

                                       $output .="
                                         <tr>
                                        <td>$id</td>
                                        <td>$username</td>
                                        <td>
                                            <a href='admin.php?id=$id'><button id='$id' class='btn btn-danger remove'>Remove</button></a>
                                        </td>
                                        </tr>
                                       ";

                                   }
                                $output .="
                                         

                                       </table>
                                    "; /*End tag of the Table*/
                                   echo $output; /*Output the table*/

                                   if (isset($_GET['id'])){
                                       $id = $_GET['id'];

                                       $query = "DELETE FROM admin WHERE id='$id'";
                                       mysqli_query($con, $query);
                                   }

                                ?>
                                <!--<table class="table  table-bordered">
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th style="width: 10%">Action</th>-->

                                   <!-- <tr>
                                        <td>1</td>
                                        <td>Admin</td>
                                        <td>
                                            <button id="remove" class="btn btn-danger">Remove</button>
                                        </td>-->
                                    <!--</tr>

                                </table>-->
                            </div>
                            <div class="col-md 6">

                                <?php
                                     if (isset($_POST['add'])){
                                         $uname = $_POST['uname'];
                                         $pass = $_POST['pass'];
                                         $image = $_FILES['img']['name'];

                                         $error = array();

                                         if (empty($uname)){
                                             $error['u'] = "Enter Admin Username";
                                         }else if (empty($pass)){
                                             $error['u'] = "Enter Admin Password";
                                         }else if (empty($image)){
                                             $error['u'] = "Add Admin Picture";
                                         }
                                         /*This state that IF, there is no error recorded in filling the form then insert the data into the dataase*/
                                         if (count($error)== 0){

                                             $q = "INSERT INTO admin(username,password,profile) VALUES('$uname','$pass','$image')";

                                             $result = mysqli_query($con, $q);

                                             if ($result){
                                                  move_uploaded_file($_FILES['img']['tmp_name'],"img/$image");
                                             }else{

                                             }
                                         }

                                     }



                                     if (isset($error['u'])){
                                         $er = $error['u'];

                                         $show = "<h5 class='text-center alert-danger alert'>$er</h5>";
                                     }else{

                                         $show = "";
                                     }
                                ?>
                                <h5 class="text-center"> Add Admin</h5>
                                <form method="post" enctype="multipart/form-data">
                                    <?php
                                         echo  $show;

                                    ?>

                                     <div class="form-group">
                                         <label for="">Username</label>
                                             <input type="text" name="uname" class="form-control" autocomplete="off">
                                     </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                            <input type="password" name="pass" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <input type="file" name="img" class="form-control">
                                    </div>

                                    <input type="submit" name="add" value="Add New Admin" class="btn btn-success">

                                </form>
                            </div>
                       </div>
                   </div>

               </div>


           </div>


       </div>



   </div>

</body>

</html>
