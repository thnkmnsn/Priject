<?php
include 'headerAdmin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ระบบรับแจ้งซ่อมนาิกาบนเว็บไซต์ - Watch Repair Notification System">
    <meta name="author" content="Vasutron Luanglum - วสุทร เลิงลำ">
    <meta name="keywords" content="โครงการ, โปรเจ็คจบ, โครงการ ป.ตรี, Project, โครงการ">

    <title>Device Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#repair-requests-table').DataTable();
    });
    </script>

    <style>
    /* Custom styles for this page */
    .form-container {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    table {
        font-size: 14px;
        background-color: #fff;
        box-shadow: 0 6px 10px -4px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
        border-radius: 10px;
        overflow: hidden;
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
    }

    thead {
        background-color: #292b2c;
        color: #fff;
        position: sticky;
        top: 0;
    }

    tbody tr:nth-child(even) {
        background-color: #f5f5f5;
    }

    tbody tr:hover {
        background-color: #e6f5ff;
    }

    .zoomable-image {
        transition: transform 0.3s;
    }

    .zoomable-image:hover {
        transform: scale(1.8);
    }
    </style>
</head>

<body>
    <?php
    include 'manu_headerAD.php'
    ?>
    <main>
        <div class="container-fluid">
            <h1 class="mt-5 mb-3 text-center">Clock information</h1>
            <p class="text-center">ข้อมูลนาฬิกาของผู้ใช้</p>
            <div class="container">
                <?php
                    require('dataconnect.php'); // เชื่อมต่อกับฐานข้อมูล
                    $selectedDeviceType = ""; // ประกาศตัวแปรและกำหนดค่าเริ่มต้นให้กับมัน
                    if(isset($_POST["DeviceType"])) { // ตรวจสอบว่าแบบฟอร์มถูกส่งหรือไม่
                        $selectedDeviceType = $_POST["DeviceType"]; // กำหนดค่าของประเภทอุปกรณ์ที่เลือกให้กับตัวแปร
                    }
                    $query = "SELECT DISTINCT(DeviceType) FROM equipment"; // สร้างคำสั่ง SQL เพื่อดึงข้อมูลประเภทอุปกรณ์ทั้งหมดจากตาราง equipment
                    $result = mysqli_query($conn, $query); // ประมวลผลคำสั่ง SQL
                ?>
                <?php 
                    while($row = mysqli_fetch_assoc($result)) // วนลูปแสดงข้อมูลประเภทอุปกรณ์ทั้งหมด โดยใช้ฟังก์ชัน mysqli_fetch_assoc() 
                ?>
            </div>

            <table id="repair-requests-table" class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">รหัสอุปกรณ์</th>
                        <!-- Device ID -->
                        <th scope="col">ชื่ออุปกรณ์</th>
                        <!-- Device Name -->
                        <th scope="col">ประเภทอุปกรณ์</th>
                        <!-- Device Type -->
                        <th scope="col">รุ่นอุปกรณ์</th>
                        <!-- Device Model -->
                        <th scope="col">หมายเลขซีเรียล</th>
                        <!-- Serial Number -->
                        <th scope="col">ผู้ผลิต</th>
                        <!-- Manufacturer -->
                        <th scope="col">วันที่ซื้อ</th>
                        <!-- Date of Purchase -->
                        <th scope="col">รูปนาฬิกา</th>
                        <!-- Picture -->
                        <th scope="col">User</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($conn->connect_error) {
                            die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
                        }   

                        $sql = "SELECT DeviceID, DeviceName, DeviceType, DeviceModel, SerialNumber, Manufacturer, DateOfPurchase, Device_pic, users.Name AS UserName 
                        FROM equipment 
                        INNER JOIN users ON equipment.UserID = users.UserID"; // สร้างคำสั่ง SQL เพื่อดึงข้อมูลอุปกรณ์ทั้งหมดจากตาราง equipment และ users โดยให้แสดงผลข้อมูลจากตาราง users และตาราง equipment ที่มี UserID ในตาราง equipment ตรงกับ UserID ในตาราง users
                        if($selectedDeviceType!=""){ // ตรวจสอบว่าตัวแปรมีค่าหรือไม่
                            $sql.= " WHERE e.DeviceType='$selectedDeviceType'"; // เพิ่มเงื่อนไขในคำค้นหา
                        }
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row["DeviceID"]. "</td>
                                    <td>" . $row["DeviceName"]. "</td>
                                    <td>" . $row["DeviceType"]. "</td>
                                    <td>" . $row["DeviceModel"]. "</td>
                                    <td>" . $row["SerialNumber"]. "</td>
                                    <td>" . $row["Manufacturer"]. "</td>
                                    <td>" . $row["DateOfPurchase"]. "</td>
                                    <td><img src='img/" . $row["Device_pic"] . "' class='zoomable-image' style='max-width: 100px; max-height: 100px;'></td>
                                    <td>" . $row["UserName"]. "</td>
                                </tr>";
                            }
                        } else {
                            echo "ไม่พบข้อมูลสำหรับประเภทอุปกรณ์ที่เลือก";
                        }
                
                        $totalDevicesSql = "SELECT COUNT(*) as total FROM equipment";
                        $totalDevicesResult = $conn->query($totalDevicesSql);
                        $totalDevices = $totalDevicesResult->fetch_assoc()["total"];
                
                        $selectedDevicesSql = "SELECT COUNT(*) as selected FROM equipment WHERE DeviceType=?";
                        $stmt = $conn->prepare($selectedDevicesSql);
                        $stmt->bind_param("s", $selectedDeviceType);
                        $stmt->execute();
                        $selectedDevicesResult = $stmt->get_result();
                        $selectedDevices = $selectedDevicesResult->fetch_assoc()["selected"];
                        
                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <br>

    <?php
        include_once 'footerEnd.php';
    ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
    // เลือกภาพทั้งหมดที่มีคลาส zoomable-image
    var images = document.querySelectorAll('.zoomable-image');

    // เพิ่มการจัดฟังก์ชันเมื่อนำเม้าส์ไปชี้ที่รูปภาพ
    images.forEach(function(image) {
        image.addEventListener('mouseenter', function() {
            image.style.transform = 'scale(1.8)';
        });

        image.addEventListener('mouseleave', function() {
            image.style.transform = 'scale(1)';
        });
    });
    </script>
</body>

</html>