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

    <title>Timely Repairs - ฟอร์มแจ้งซ่อม</title>

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
    </style>

</head>

<body>
    <?php
    include 'manu_header.php'
    ?>
    <br>
    <div class="container mt3">
        <div class="card border-dark mb-3">
            <div class="card-header">
                <h1 class="text-center my-2">ฟอร์มแจ้งซ่อมนาฬิกา</h1>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-8">
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
                        <!-- submit_repair_request.php -->
                        <form action="submit_repair_request.php" method="post" enctype="multipart/form-data" class="row g-2">

                            <input type="hidden" name="DeviceID" value="<?php echo $device['DeviceID']; ?>">

                            <div class="col-md-4">
                                <label for="DeviceName" class="form-label">ชื่อนาฬิกา</label>
                                <input type="text" class="form-control" id="DeviceName" name="DeviceName"
                                    value="<?php echo $device['DeviceName']; ?>" disabled readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="DeviceType" class="form-label">ประเภทนาฬิกา</label>
                                <input type="text" class="form-control" id="DeviceType" name="DeviceType"
                                    value="<?php echo $device['DeviceType']; ?>" disabled readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="DeviceModel" class="form-label">รุ่นนาฬิกา</label>
                                <input type="text" class="form-control" id="DeviceModel" name="DeviceModel"
                                    value="<?php echo $device['DeviceModel']; ?>" disabled readonly>
                            </div>

                            <div class="mb-3">
                                <label for="SerialNumber" class="form-label">ซีเรียล</label>
                                <input type="text" class="form-control" id="SerialNumber" name="SerialNumber"
                                    value="<?php echo $device['SerialNumber']; ?>" disabled readonly>
                            </div>

                            <!-- แสดงรูปภาพนาฬิกาที่แจ้งซ่อม -->
                            <div class="d-flex justify-content-center">
                                <img src="img/<?php echo $device['Device_pic']; ?>"
                                    style="max-width: 200px; max-height: 200px;" class="img-fluid">
                            </div>
                            <label class="d-flex justify-content-center"><i>รูปนาฬิกาที่แจ้งซ่อม</i></label>

                            <div class="mb-3">
                                <label for="RepairType" class="form-label">ประเภทการซ่อม</label>
                                <select class="form-select" name="RepairType" id="RepairType" required>
                                    <option value="">เลือกประเภทการซ่อม</option>
                                    <option value="Battery_Replacement">เปลี่ยนแบตเตอรี่</option>
                                    <option value="Strap_Replacement">เปลี่ยนสายนาฬิกา</option>
                                    <option value="Watch_Crystal_Replacement">เปลี่ยนกระจกหน้าปัดนาฬิกา</option>
                                    <option value="Mechanism_Repair">ซ่อมกลไก</option>
                                    <option value="Other">อื่น ๆ</option>
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="ProblemDetails">รายละเอียดแจ้งซ่อม:</label>
                                <textarea class="form-control" id="ProblemDetails" name="ProblemDetails"
                                    required></textarea>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-6 col-form-label">รูปความเสียหาย</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control form-control-sm" id="Image1" name="Image1">
                                </div>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control form-control-sm" id="Image2" name="Image2">
                                </div>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control form-control-sm" id="Image3" name="Image3">
                                </div>
                            </div>


                            <div class="form-group" style="display:none;">
                                <label for="UserID">User ID:</label>
                                <input type="text" class="form-control" id="UserID" name="UserID"
                                    value="<?php echo $_SESSION['UserID']; ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="EstimatedRepairDate">วันที่:เวลา จะเข้าซ่อม / ส่งนาฬิกาเข้าซ่อม:</label>
                            </div>

                            <!-- Estimated Repair Date -->
                            <div class="col-md-4">
                                <input type="datetime-local" class="form-control" id="EstimatedRepairDate"
                                    name="EstimatedRepairDate" min="<?php echo date('Y-m-d\TH:i'); ?>" required>
                            </div>

                            <label for="DeliveryDate" class="form-control" readonly>Delivery Date วันที่แจ้งซ่อม :
                                <input type="datetime-local" value="<?php echo date('Y-m-d\TH:i'); ?>" disabled
                                    readonly> </label>

                            <button type="submit" class="btn btn-primary mt-3 mb-3 w-100" id="registrationModalLink"
                                data-toggle="modal" data-target="#registrationModal">ยืนยันแจ้งซ่อม</button>
                            <a href="request_repair.php" class="btn btn-secondary">กลับ</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- <div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registrationModalLabel">คุณลืมรหัสผ่านใช่หรือไม่
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>ส่งใบแจ้งซ่อมเรียบร้อย</p>
                        <p>เราจะแจ้งประเมินราคาซ่อมให้คุณภายใน 3 วันทำการ</p>
                        <p>หากคุณยังไม่ได้รับราคาประเมิน โปรดติดต่อเรา</p>
                        <a href="contact-third.php" class="">ติดต่อเรา</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> -->

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- <script>
    $(document).ready(function() {
        $('#registrationModalLink').click(function() {
            $('#registrationModal').modal('show');
        });
    });
    </script> -->
</body>

</html>