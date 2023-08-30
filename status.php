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

    <title>Check Repair Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="style.css">

    <script>
    $(document).ready(function() {
        $('#repair-requests-table').DataTable();
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
    </style>
</head>

<body>
    <?php
        include 'manu_header.php';
        ?>
    <?php
        require('dataconnect.php'); //connect to database
        $user_id = $_SESSION['UserID'];

        $query = "SELECT repair_requests.*, equipment.*, status.* FROM repair_requests 
                    JOIN equipment ON repair_requests.DeviceID = equipment.DeviceID 
                    JOIN status ON repair_requests.StatusID = status.StatusID 
                    WHERE repair_requests.UserID='$user_id'";
        $result = mysqli_query($conn, $query);
    ?>
    <main>
        <div class="container-fluid">
            <h1 class="mt-5 mb-4">สถานะใบแจ้งซ่อม</h1>
            <div class="card border-dark mb-3">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="repair-requests-table" class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>เลขที่แจ้งซ่อม</th>
                                    <th>วันที่แจ้งซ่อม</th>
                                    <th>วันที่จะเข้าซ่อม</th>
                                    <th>รายละเอียด</th>
                                    <th>ยี่ห้อ</th>
                                    <th>ประเภท</th>
                                    <th>รุ่น</th>
                                    <th>ซีเรียล</th>
                                    <th>สถานะซ่อม</th>
                                    <th>วันที่ซ่อมเสร็จ</th>
                                    <th>ราคาประเมิน</th>
                                    <th>วันที่ยืนยัน</th>
                                    <th>ดำเนินการ</th>
                                    <th>.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $row['RequestCode'] ?></td>
                                    <td><?= $row['DeliveryDate'] ?></td>
                                    <td><?= $row['EstimatedRepairDate'] ?></td>
                                    <td><?= $row['ProblemDetails'] ?></td>
                                    <td><?= $row['DeviceName'] ?></td>
                                    <td><?= $row['DeviceType'] ?></td>
                                    <td><?= $row['DeviceModel'] ?></td>
                                    <td><?= $row['SerialNumber'] ?></td>
                                    <td>
                                        <?php if ($row['StatusID'] == 1): ?>
                                        <span class="badge bg-warning text-dark">รอดำเนินการ</span>
                                        <?php elseif ($row['StatusID'] == 2): ?>
                                        <span class="badge bg-success">ปิดงาน</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row['CompletionDate'] ?></td>
                                    <td><?= $row['EstimatedPrice'] ?></td>
                                    <td><?= $row['ConfirmationDate'] ?></td>
                                    <td>
                                        <?php
                                            if ($row['ConfirmationStatus'] == 'Not Confirmed') { //ถ้า confirmation status เป็น not confirmed
                                                echo '<button class="btn btn-secondary disabled">Not Confirmed</button>'; // แสดงปุ่ม not confirmed และไม่สามารถกดได้
                                            } elseif ($row['ConfirmationStatus'] == 'Confirmed') { //ถ้า confirmation status เป็น confirmed
                                                echo '<button class="btn btn-success disabled">Confirmed</button>'; // แสดงปุ่ม confirmed และไม่สามารถกดได้
                                                ?> </td>
                                    <td><?php
                                                echo '<a href="print_request.php?request_code='.$row['RequestCode'].'" class="btn btn-secondary">Print Request</a>'; // แสดงปุ่ม print request และส่งค่า request code ไปยังหน้า print_request.php
                                            } else { //ถ้า confirmation status เป็น null
                                                echo '<a href="confirm_repair.php?id=' . $row['RequestCode'] . '" class="btn btn-primary">Confirm</a>'; // แสดงปุ่ม confirm และส่งค่า id ไปยังหน้า confirm_repair.php
                                                ?> </td>
                                    <td><?php
                                                echo '<a href="cancel_repair.php?id=' . $row['RequestCode'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to cancel this repair request?\')">Cancel</a>'; // แสดงปุ่ม cancel และส่งค่า id ไปยังหน้า cancel_repair.php
                                            } // ปิด if else
                                        ?>
                                    </td>
                                </tr>
                                <?php endwhile; // ออกจาก loop while ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include_once 'footerEnd.php';
    ?>

    <?php
    mysqli_close($conn); //ปิดการเชื่อมต่อ database
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>