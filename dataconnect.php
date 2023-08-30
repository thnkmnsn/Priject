<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "data_sscv2";

$conn = mysqli_connect($servername,$username,$password,$dbname) or die ("Server Error ไม่สามารถติดต่อฐานข้อมูลได้..."); 

mysqli_select_db($conn,$dbname) or die ("Database Error. ไม่สามารถเชื่อมต่อฐานข้อมูลได้...");

mysqli_query($conn,"SET NAMES UTF8");
mysqli_query($conn,"SET character_set_results=utf8");
mysqli_query($conn,"SET character_set_client=utf8"); 
mysqli_query($conn,"SET character_set_connection=utf8");

?>