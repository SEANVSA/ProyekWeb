<?php 
    $mysqlusername = "root";
    $mysqlpassword = "";
    $mysqlhostname = "localhost";
    $dbname = "proyek_tekwebA";
    $connect=mysqli_connect($mysqlhostname, $mysqlusername, $mysqlpassword, $dbname) OR die('Please try again');
?>