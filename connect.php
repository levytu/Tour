<?php
    $host ="localhost";
    $user = "root";
    $pass = "";
    $database = "hamsterdb";

    $conn =mysqli_connect($host, $user, $pass, $database);
    mysqli_set_charset($conn,"utf8");
    
?>