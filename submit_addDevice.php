<?php
session_start();
require('dataconnect.php');

// Get data from the form
$devicename = $_POST['DeviceName'];
$devicetype = $_POST['DeviceType'];
$devicemodel = $_POST['DeviceModel'];
$serialnumber = $_POST['SerialNumber'];
$manufacturer = $_POST['Manufacturer'];
$datepurchase = $_POST['DateOfPurchase'];
$device_pic = $_FILES['Device_pic']['name']; // Get the filename

$UserID = $_SESSION['UserID'];

// Get the current maximum value of the primary key column
$max_key_query = mysqli_query($conn, "SELECT MAX(DeviceID) FROM equipment"); // คือ คำสั่งให้หาค่าที่มากที่สุดในตาราง equipment ใน column DeviceID แล้วเก็บค่าไว้ในตัวแปร $max_key_query
$max_key = mysqli_fetch_array($max_key_query)[0]; // คือ คำสั่งให้เอาค่าที่ได้จาก $max_key_query มาเก็บไว้ในตัวแปร $max_key แล้วเอาค่าที่ได้มาใส่ใน array แล้วเอาค่าที่อยู่ใน index ที่ 0 มาเก็บไว้ในตัวแปร $max_key

// Use the next value in the sequence for the new row
$deviceid = $max_key + 1;

$sql = "INSERT INTO equipment (DeviceID, DeviceName, DeviceType, DeviceModel, SerialNumber, Manufacturer, DateOfPurchase, Device_pic, UserID)
        VALUES ('$deviceid', '$devicename', '$devicetype', '$devicemodel', '$serialnumber', '$manufacturer', '$datepurchase', '$device_pic', '$UserID')";

$query = mysqli_query($conn, $sql);

if ($query) {
    // Move the uploaded file to the desired location
    $target_directory = "img/";
    $target_file = $target_directory . basename($_FILES["Device_pic"]["name"]);

    if (move_uploaded_file($_FILES["Device_pic"]["tmp_name"], $target_file)) {
        echo "<script>alert('Repair request submitted successfully.');</script>";
        header("refresh:0.5;url=request_repair.php");
    } else {
        echo "<script>alert('Error: Failed to move uploaded file.');</script>";
    }
} else {
    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
}

$conn->close();
?>