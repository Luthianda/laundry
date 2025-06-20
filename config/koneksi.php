<?php
    $hostname = "localhost";
    $hostusername = "root";
    $hostpassword = "";
    $hostdatabase = "db_laundry";
    $config = mysqli_connect($hostname, $hostusername, $hostpassword, $hostdatabase);
    if(!$config){
        echo "Connection Failed";
    }
?>
