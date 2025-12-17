<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Panel</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand">Halo, <?php echo $_SESSION['nama']; ?></a>
        <div class="navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="user_homepage.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="panitia.php">Panitia</a></li>
                <?php
                    if($_SESSION['is_admin'] == 1){
                        echo '<li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>';
                    }
                ?>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </div>
    </div>
</nav>
<div class="container"></div>