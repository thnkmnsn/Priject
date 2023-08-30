<?php
// เชื่อมต่อฐานข้อมูล
require('dataconnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบว่ามีการส่งค่า DeviceID มาหรือไม่
    if (isset($_POST['DeviceID'])) {
        $deviceID = $_POST['DeviceID'];
        $deviceName = $_POST['DeviceName'];
        $deviceType = $_POST['DeviceType'];
        $deviceModel = $_POST['DeviceModel'];
        $serialNumber = $_POST['SerialNumber'];
        $manufacturer = $_POST['Manufacturer'];
        $dateOfPurchase = $_POST['DateOfPurchase'];

        // ตรวจสอบว่ามีการเลือกไฟล์รูปภาพใหม่หรือไม่
        if (isset($_FILES['DevicePic']) && $_FILES['DevicePic']['error'] === UPLOAD_ERR_OK) {
            $devicePic = $_FILES['DevicePic'];
            $devicePicName = $devicePic['name'];
            $devicePicTmpName = $devicePic['tmp_name'];

            // ย้ายไฟล์รูปภาพไปยังโฟลเดอร์ img
            $destination = 'img/' . $devicePicName;
            move_uploaded_file($devicePicTmpName, $destination);
        } else {
            // ไม่มีการเลือกไฟล์รูปภาพใหม่ ใช้ชื่อไฟล์รูปภาพเดิม
            $query = "SELECT Device_pic FROM equipment WHERE DeviceID = $deviceID";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $devicePicName = $row['Device_pic'];
        }

        // อัปเดตข้อมูลในฐานข้อมูล
        $query = "UPDATE equipment SET 
            DeviceName = '$deviceName',
            DeviceType = '$deviceType',
            DeviceModel = '$deviceModel',
            SerialNumber = '$serialNumber',
            Manufacturer = '$manufacturer',
            DateOfPurchase = '$dateOfPurchase',
            Device_pic = '$devicePicName'
            WHERE DeviceID = $deviceID";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // อัปเดตข้อมูลสำเร็จ
            echo "<script>alert('อัปเดตข้อมูลเรียบร้อยแล้ว'); window.location.href = 'request_repair.php';</script>";
        } else {
            // อัปเดตข้อมูลไม่สำเร็จ
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล');</script>";
        }        
    } else {
        // ถ้าไม่มี DeviceID ที่ส่งมา ให้เปลี่ยนไปที่หน้า request_repair.php
        header('Location: request_repair.php');
        exit();
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>