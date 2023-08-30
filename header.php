<?php
session_start(); // start session
if(isset($_SESSION['UserID'])){
    //echo "Welcome,ID: " . $_SESSION['UserID'];
}else{
    header("Location: index.php");
    exit();
}
if(!isset($_SESSION['Name'])){
    $_SESSION['Name'] = ""; // กำหนดค่าเริ่มต้น
}
if(!isset($_SESSION['Email'])){
    $_SESSION['Email'] = ""; // กำหนดค่าเริ่มต้น
}
?>