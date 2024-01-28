<?php
//session_start(); // Uncomment if header.php is included at the very beginning of the page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-info bg-info">
        <h5 class="text-white">Electric Health Record</h5>
        <div class="mr-auto"></div>
        <ul class="navbar-nav">
            <?php
            if (isset($_SESSION['admin']) || isset($_SESSION['doctor']) || isset($_SESSION['patient'])) {
                $user = isset($_SESSION['admin']) ? $_SESSION['admin'] : (isset($_SESSION['doctor']) ? $_SESSION['doctor'] : $_SESSION['patient']);
                echo '
                    <li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>
                ';
            } else {
                echo '
                    <li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li>     
                    <li class="nav-item"><a href="common_login.php" class="nav-link text-white">Login</a></li>
                ';
            }
            ?>
        </ul>
    </nav>
</body>
</html>
