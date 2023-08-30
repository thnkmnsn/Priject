<?php
    include 'header.php';
    ob_start();
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

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'manu_header.php'
    ?>
    <br>
    <div class="container">
        <div class="card mx-auto border-danger">
            <div class="card-header text-danger">
                <h2>ลบข้อมูลนาฬิกาของคุณออกจากระบบ</h2>
            </div>
            <div class="card-body">
                <?php
                    require('dataconnect.php');

                    if (isset($_GET['DeviceID'])) {
                        $deviceID = $_GET['DeviceID'];

                        if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {

                            $queryCheckRepair = "SELECT * FROM repair_requests WHERE DeviceID = $deviceID";
                            $resultCheckRepair = mysqli_query($conn, $queryCheckRepair);
                            if (mysqli_num_rows($resultCheckRepair) > 0) {
                                echo "คุณไม่สามารถลบข้อมูลนาฬิกานี้ได้เนื่องจากมีข้อมูลการแจ้งซ่อมอยู่";
                                echo "<br><br>";
                                echo "<a href=\"request_repair.php\" class=\"btn btn-outline-secondary\">กลับ</a>";
                            } else {
                                $query = "DELETE FROM equipment WHERE DeviceID = $deviceID";
                                if (mysqli_query($conn, $query)) {
                                    header('Location: request_repair.php');
                                    exit();
                                } else {
                                    echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
                                }
                            }
                        } else {
                            echo "คุณต้องการลบข้อมูลนี้ใช่หรือไม่?";
                            echo "<br><br>";
                            echo "<a href=\"deleteDevice.php?DeviceID=$deviceID&confirm=true\" class=\"btn btn-danger\">ยืนยัน</a>  ";
                            echo "<a href=\"request_repair.php\" class=\"btn btn-outline-secondary\">ยกเลิก</a>";
                        }
                    } else {
                        header('Location: request_repair.php');
                        exit();
                    }

                    mysqli_close($conn);

                    ob_end_flush();
                ?>
            </div>
        </div>
    </div>
    <br>

</body>

</html>