<?php
    include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ระบบรับแจ้งซ่อมนาิกาบนเว็บไซต์ - Watch Repair Notification System">
    <meta name="author" content="Vasutron Luanglum - วสุทร เลิงลำ">
    <meta name="keywords" content="โครงการ, โปรเจ็คจบ, โครงการ ป.ตรี, Project">

    <title>Timely Repairs - ข้อมูลนาฬิกาของคุณ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="style.css">

    <script>
    $(document).ready(function() {
        $('#Device_details').DataTable();
    });
    </script>

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
    include 'manu_header.php';
    ?>
    <br>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h1 class="text-center my-4">ข้อมูลนาฬิกาของคุณ</h1>
            <div class="text-center">
                <label>กรณีไม่พบข้อมูลนาฬิกาของคุณ กรุณาเพิ่มข้อมูลเข้าสู่ระบบ</label>
            </div>
            <div class="mb-3">
                <a href="addDevice.php" class="btn btn-primary">เพิ่มข้อมูลนาฬิกา</a>
            </div>

            <?php
                $row = array(
                    'DeviceID' => '',
                    'DeviceName' => '',
                    'DeviceType' => '',
                    'DeviceModel' => '',
                    'SerialNumber' => '',
                    'Manufacturer' => '',
                    'DateOfPurchase' => '',
                );
                require('dataconnect.php'); //connect to database
                $query = "SELECT * FROM equipment WHERE UserID = ".$_SESSION['UserID'];
                $result = mysqli_query($conn, $query);
                $devices = mysqli_fetch_all($result, MYSQLI_ASSOC);
                mysqli_close($conn);
            ?>

            <div class="card border-dark mb-3">
                <div class="card-body">
                    <div class="table-responsive table-striped table-sm">
                        <table id="Device_details" class="table">
                            <thead>
                                <tr>
                                    <th>รหัสนาฬิกา</th><!-- Device ID -->
                                    <th>ยี่ห้อ</th><!-- Device Name -->
                                    <th>ประเภท</th><!-- Device Type -->
                                    <th>รุ่น</th><!-- Device Model -->
                                    <th>ซีเรียล</th><!-- Serial Number -->
                                    <th>ผู้ผลิต</th><!-- Manufacturer -->
                                    <th>วันที่ซื้อ</th><!-- Date of Purchase -->
                                    <th>รูปนาฬิกา</th>
                                    <!-- <th colspan="2">ดำเนินการ</th> -->
                                    <th>แก้ไข</th>
                                    <th>ลบ</th>
                                    <th>แจ้งซ่อม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($devices as $device): ?>
                                <tr>
                                    <td><?php echo $device['DeviceID']; ?></td>
                                    <td><?php echo $device['DeviceName']; ?></td>
                                    <td><?php echo $device['DeviceType']; ?></td>
                                    <td><?php echo $device['DeviceModel']; ?></td>
                                    <td><?php echo $device['SerialNumber']; ?></td>
                                    <td><?php echo $device['Manufacturer']; ?></td>
                                    <td><?php echo $device['DateOfPurchase']; ?></td>
                                    <td>
                                        <img src="img/<?php echo $device['Device_pic']; ?>" width="60px" height="60px"
                                            class="zoomable-image" alt="Device Image">
                                    <td>
                                        <a href="editDevice.php?DeviceID=<?php echo $device['DeviceID']; ?>"
                                            class="btn btn-primary btn-sm">แก้ไข</a>
                                    </td>
                                    <td>
                                        <a href="deleteDevice.php?DeviceID=<?php echo $device['DeviceID']; ?>"
                                            class="btn btn-danger btn-sm">ลบ</a>
                                    </td>
                                    <td>
                                        <a href="request_repair_form.php?DeviceID=<?php echo $device['DeviceID']; ?>"
                                            class="btn btn-warning btn-sm">แจ้งซ่อม</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <?php
        include_once 'footerEnd.php';
        ?>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
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