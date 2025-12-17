<?php
    session_start();
    include("database.php");
    if (isset($_POST['login'])) {
    $nrp = strtolower($_POST['nrp']);
    $nrp = str_replace("'","",$nrp);
    $password = $_POST['password'];

    $q = mysqli_query($connect, "SELECT * FROM user WHERE nrp='$nrp'");
    $data = mysqli_fetch_assoc($q);
    if ($data) {
        if ($data['password'] == md5($password)) {
            $_SESSION['nrp'] = $data['nrp'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['is_admin'] = 0;

            $q = mysqli_query($connect, "SELECT *, COUNT(*) as total FROM admin WHERE nrp = '$nrp'");
            $data = mysqli_fetch_assoc($q);

            if($data['total'] == 1 and $data['status_aktif'] == 1){
                $_SESSION['is_admin'] = 1;
            }
            header("Location: user_homepage.php");
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Nrp tidak ditemukan.";
    }
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>Login Page</title>
    </head>
    <body>  
        <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="post">
            <label for="username" class="">NRP</label>
            <input type="text" class="" id="nrp" name="nrp" required>
            
            <label for="password" class="">Password</label>
            <input type="password" class="" id="password" name="password" required>
            <button type="submit" class="" name="login">Login</button>
            <a href="register.php">Register</a>
        </form>
    </body>
</html>