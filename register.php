<?php
    function validasiNRP($NRP):bool{
        if (strlen($NRP) != 9) return false;
        $prodi = substr($NRP,0,1);
        $angka = substr($NRP,1,9);
        
        if(!ctype_alpha($prodi)) return false;
        if(!ctype_digit($angka)) return false;
        return true;
    }

    include("database.php");
    
    if (isset($_POST['add_user'])) {
        if(empty($_POST['nrp'])){
            $error = "Nrp kosong.";
        }
        elseif(empty($_POST['nama'])){
            $error = "Nama kosong.";
        }
        elseif(empty($_POST['password'])){
            $error = "Password kosong.";
        }
        else{
            $nrp = strtolower($_POST['nrp']);
            $nrp = str_replace("'","",$nrp);
            

            $q = mysqli_query($connect, "SELECT * FROM user WHERE nrp='$nrp'");
            $data = mysqli_fetch_assoc($q);
            if ($data) {
                $error = "Nrp sudah ada.";
            } else {
                if(validasiNRP($nrp)){
                    $password = md5($_POST['password']);
                    $nama = $_POST['nama'];
                    $q = mysqli_query($connect, "INSERT INTO `user`(`nrp`, `password`, `nama`) VALUES ('$nrp','$password','$nama')");
                    header("Location: index.php");
                    exit;
                }
                else {
                    $error = "Format nrp salah.";
                }
            }
        }
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>Register Page</title>
    </head>
    <body>  
        <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="post">
            <label for="username" class="">NRP</label>
            <input type="text" class="" id="nrp" name="nrp" required>
            
            <label for="username" class="">Nama</label>
            <input type="text" class="" id="nama" name="nama" required>

            <label for="password" class="">Password</label>
            <input type="password" class="" id="password" name="password" required>
            <button type="submit" class="" name="add_user">Tambah</button>
            <a href="index.php">Kembali</a>
        </form>
    </body>
</html>