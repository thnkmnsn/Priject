<?php
    include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ระบบรับแจ้งซ่อมนาฬิกาบนเว็บไซต์ - Watch Repair Notification System">
    <meta name="author" content="Vasutron Luanglum - วสุทร เลิงลำ">
    <meta name="keywords" content="โครงการ, โปรเจ็คจบ, โครงการ ป.ตรี, Project">

    <title>Timely Repairs - แก้ไขข้อมูลนาฬิกา</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="style.css">

    <style>
    /* Custom styles for this page */
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
    include 'manu_header.php'
    ?>
    <div class="container mt-3">
        <div class="card border-dark mb-3">
            <div class="card-header">
                <h1 class="text-center my-2">แก้ไขข้อมูลนาฬิกา</h1>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">

                    <?php
                        // ตรวจสอบว่ามีการส่งค่า DeviceID มาหรือไม่
                        if (isset($_GET['DeviceID'])) {
                            $deviceID = $_GET['DeviceID'];

                            require('dataconnect.php'); // เชื่อมต่อฐานข้อมูล

                            // สร้างคำสั่ง SQL เพื่อดึงข้อมูลของนาฬิกาที่ต้องการแก้ไข
                            $query = "SELECT * FROM equipment WHERE DeviceID = $deviceID";
                            $result = mysqli_query($conn, $query);
                            $device = mysqli_fetch_assoc($result);

                            // ปิดการเชื่อมต่อฐานข้อมูล
                            mysqli_close($conn);
                        } else {
                            // ถ้าไม่มี DeviceID ที่ส่งมา ให้เปลี่ยนไปที่หน้า request_repair.php
                            header('Location: request_repair.php');
                            exit();
                        }
                    ?>

                    <!-- แบบฟอร์มสำหรับแก้ไขข้อมูล -->
                    <form action="updateDevice.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="DeviceID" value="<?php echo $device['DeviceID']; ?>">

                        <div class="mb-3">
                            <label for="DeviceName" class="form-label">ชื่อนาฬิกา</label>
                            <input type="text" class="form-control" id="DeviceName" name="DeviceName"
                                value="<?php echo $device['DeviceName']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="DeviceType" class="form-label">ประเภทนาฬิกา</label>
                            <input type="text" class="form-control" id="DeviceType" name="DeviceType"
                                value="<?php echo $device['DeviceType']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="DeviceModel" class="form-label">รุ่นนาฬิกา</label>
                            <input type="text" class="form-control" id="DeviceModel" name="DeviceModel"
                                value="<?php echo $device['DeviceModel']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="SerialNumber" class="form-label">ซีเรียลนามเบอร์</label>
                            <input type="text" class="form-control" id="SerialNumber" name="SerialNumber"
                                value="<?php echo $device['SerialNumber']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="Manufacturer" class="form-label">ผู้ผลิตนาฬิกา</label>
                            <input type="text" class="form-control" id="Manufacturer" name="Manufacturer"
                                value="<?php echo $device['Manufacturer']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="DateOfPurchase" class="form-label">วันที่ซื้อนาฬิกา</label>
                            <input type="date" class="form-control" id="DateOfPurchase" name="DateOfPurchase"
                                value="<?php echo $device['DateOfPurchase']; ?>">
                        </div>

                        <div class="mb-3 row">
                            <!-- แสดงรูปภาพเดิมก่อนอัพโหลด -->
                            <label class="col-sm-3 col-form-label">รูปเดิม :</label>
                            <div class="col-sm-9">
                                <img src="img/<?php echo $device['Device_pic']; ?>"
                                    style="max-width: 300px; max-height: 300px;">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <!-- ฟอร์มแสดงรูปภาพใหม่ก่อนอัพโหลด -->
                            <label class="col-sm-3 col-form-label">รูปใหม่ :</label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" id="DevicePic" name="DevicePic"
                                    onchange="previewImage(event)">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <!-- ฟอร์มแสดงรูปภาพที่เลือก -->
                            <label class="col-sm-3 col-form-label">Preview :</label>
                            <div class="col-sm-9">
                                <img id="imagePreview" style="max-width: 300px; max-height: 300px;">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                        <a href="request_repair.php" class="btn btn-secondary">กลับ</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!--//สคริปต์ แสดงรูปภาพก่อนอัพโหลด -->
    <script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = reader.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
    </script>
</body>

</html>