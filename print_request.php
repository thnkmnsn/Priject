<?php
include 'header.php';
require('dataconnect.php');
$request_code = $_GET['request_code'];
$query = "SELECT repair_requests.*, equipment.*, status.* FROM repair_requests 
    JOIN equipment ON repair_requests.DeviceID = equipment.DeviceID 
    JOIN status ON repair_requests.StatusID = status.StatusID 
    WHERE RequestCode='$request_code'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

    // Get UserID from session
    $userID = $_SESSION['UserID'];

    // Retrieve customer information from users table
    $sql2 = "SELECT Name, Surname, Address, Phone, Email FROM users WHERE UserID = '$userID'";
    $result2 = mysqli_query($conn, $sql2);
    $customer = mysqli_fetch_assoc($result2);
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

    <title>Repair Request - <?php echo $row['RequestCode']; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
    /* Custom styles for this page */
    .container {
        max-width: 700px;
        margin-top: 30px;
        position: relative;
    }

    h1 {
        font-size: 28px;
        margin-bottom: 30px;
    }

    .btn-print {
        margin-top: 30px;
    }

    .left-content {
        position: absolute;
        top: 0;
        left: 0;
    }

    .right-content {
        position: absolute;
        top: 0;
        right: 0;
    }

    .small-text {
        font-size: smaller;
        color: #888;
    }
    </style>
</head>

<body>

    <div class="container">
        <!-- Content section -->
        <h6 class="left-content">No. | เลขที่แจ้งซ่อม : <?php echo $row['RequestCode']; ?></h6>
        <h6 class="right-content">Date | วันที่ : <?php echo date('Y-m-d'); ?></h6>
        <div class="clearfix"></div>
        <hr>
        <!-- Rest of the content -->

        <h2 class="text-center"> <img src="img/Asset1.svg" alt="" width="100"> Timely Repairs Company Limited</h2>
        <h4 class="text-center">บริษัท ไทม์ลี่ รีแพร์ส จำกัด</h4>
        <h4 class="text-center">2298 ถนนสรรพาวุธ เขตบางนา กรุงเทพมหานคร 10260 ประเทศไทย</h4>
        <h6 class="text-center">2298 Soi Sapphawut, Bang Na District, Bangkok 10260 Thailand</h6>
        <h4 class="text-center">Tel: 02-123-4567 เลขประจำตัวผู้เสียภาษี: 1-2345-67894-01-2</h4>
        <hr>

        <h2 class="text-center">Repair Request <span>| ใบแจ้งซ่อม</span><span>/ ใบเสนอราคา</span></h2>
        <hr>
        <h3>Customer Details <span>| รายละเอียดลูกค้า</span></h3>

        <!-- Floating Labels Form -->
        <form class="row g-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <label for="floatingName">ชื่อ : <?php echo $customer['Name']; ?></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <label for="floatingName">นามสกุล : <?php echo $customer['Surname']; ?></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <label for="floatingEmail">Email : <?php echo $customer['Email']; ?></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <label for="floatingPhon">เบอร์โทรศัพท์ : <?php echo $customer['Phone']; ?></label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <label for="floatingTextarea">ที่อยู่ : <?php echo $customer['Address']; ?></label>
                </div>
            </div>
        </form><hr>

        <h3>Repair Request Details <span>| รายละเอียดแจ้งซ่อม</span></h3>
        <table class="table table-sm">
            <tr>
                <th>Request Code <span class="small-text">| เลขที่แจ้งซ่อม</span></th>
                <td><?php echo $row['RequestCode']; ?></td>
            </tr>
            <tr>
                <th>Delivery Date <span class="small-text">| วันที่จะส่งซ่อม</span></th>
                <td><?php echo $row['DeliveryDate']; ?></td>
            </tr>
            <tr>
                <th>Problem Details <span class="small-text">| รายละเอียดการแจ้ง</span></th>
                <td><?php echo $row['ProblemDetails']; ?></td>
            </tr>
            <!-- <tr>
                <th>Device ID</th>
                <td><?php echo $row['DeviceID']; ?></td>
            </tr> -->
            <tr>
                <th>Device Name <span class="small-text">| ยี่ห้อ</span></th>
                <td><?php echo $row['DeviceName']; ?></td>
            </tr>
            <tr>
                <th>Device Type <span class="small-text">| ประเภท</span></th>
                <td><?php echo $row['DeviceType']; ?></td>
            </tr>
            <tr>
                <th>Device Model <span class="small-text">| รุ่น</span></th>
                <td><?php echo $row['DeviceModel']; ?></td>
            </tr>
            <tr>
                <th>Serial Number <span class="small-text">| ซีเรียล</span></th>
                <td><?php echo $row['SerialNumber']; ?></td>
            </tr>
            <tr>
                <th>Manufacturer <span class="small-text">| ผู้ผลิต</span></th>
                <td><?php echo $row['Manufacturer']; ?></td>
            </tr>
            <!-- <tr>
                <th>Status</th>
                <td><?php echo $row['StatusName']; ?></td>
            </tr>
            <tr>
                <th>Repairman ID</th>
                <td><?php echo $row['RepairmanID']; ?></td>
            </tr> -->
            <tr>
                <th>Estimated Price <span class="small-text">| ราคาประเมิน</span></th>
                <td><?php echo number_format($row['EstimatedPrice'], 2); ?> บาท</td>
            <tr>

                <th>Completion Date <span class="small-text">| วันที่ซ่อมเสร็จ</span></th>
                <td><?php echo $row['CompletionDate']; ?></td>
            </tr>
        </table>
        <h6 class="text-left" style="position: absolute; ">วันที่พิมพ์ : <?php echo date('Y-m-d'); ?></h6>
        <br>

        <button class="btn btn-primary btn-print" onclick="window.print()">Print</button>
        <a href="status.php" class="btn btn-primary btn-print">Cancel</a>

    </div>

    <!-- Footer -->
    <hr>
    <footer class="pt-3 text-center bg-transparent border-dark border-top">
        <img src="img/Asset1.svg" alt="" width="100">
        <div class="text-center" style="margin-top: 10px; font-size: 14px; color: #777;">Contact Line ID: tor_original
        </div>
        <p class="text-center" style="margin-top: 5px; font-size: 14px; color: #777;"> Created by Vasutron © 2022</p>
    </footer>
</body>

</html>