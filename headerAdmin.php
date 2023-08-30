<?php
session_start(); // start session
if(isset($_SESSION['AdminID'])){
    //echo "Welcome,ID: " . $_SESSION['UserID'];
}else{
    header("Location: adminlogin.php");
    exit();
}
if(!isset($_SESSION['Email'])){
    $_SESSION['Email'] = ""; // กำหนดค่าเริ่มต้น
}
?>