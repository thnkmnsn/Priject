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

    <title>Dashboard Management.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

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
    </style>
</head>

<body>
    <?php
        include 'manu_headerAD.php';
    ?>
    <main>
    <div class="container mt-5">
        <h1 class="text-center">ระบบจัดการข้อมูลหลังบ้าน เว็บ Timely Repairs</h1>
        <hr>

        <?php
        require('dataconnect.php'); // เชื่อมต่อกับฐานข้อมูล

        // จำนวนสมาชิกทั้งหมด
        $query_total_users = "SELECT COUNT(*) as total_users FROM users";
        $result_total_users = mysqli_query($conn, $query_total_users);
        $row_total_users = mysqli_fetch_assoc($result_total_users);
        $total_users = $row_total_users['total_users'];

        // จำนวนใบสั่งซ่อมทั้งหมด
        $query_total_requests = "SELECT COUNT(*) as total_requests FROM repair_requests";
        $result_total_requests = mysqli_query($conn, $query_total_requests);
        $row_total_requests = mysqli_fetch_assoc($result_total_requests);
        $total_requests = $row_total_requests['total_requests'];

        // จำนวนช่างซ่อมทั้งหมด
        $query_total_repairman = "SELECT COUNT(*) as total_repairman FROM repairman";
        $result_total_repairman = mysqli_query($conn, $query_total_repairman);
        $row_total_repairman = mysqli_fetch_assoc($result_total_repairman);
        $total_repairman = $row_total_repairman['total_repairman'];

        // จำนวนอุปกรณ์ทั้งหมด
        $query_total_equipment = "SELECT COUNT(*) as total_equipment FROM equipment";
        $result_total_equipment = mysqli_query($conn, $query_total_equipment);
        $row_total_equipment = mysqli_fetch_assoc($result_total_equipment);
        $total_equipment = $row_total_equipment['total_equipment'];

        mysqli_close($conn); // ปิดการเชื่อมต่อกับฐานข้อมูล
        ?>

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="adminpage.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <div class="row mt-5">
            <div class="col-md-3">

                <div class="card">
                    <div class="card-body text-primary">
                        <h5 class="card-title">สมาชิกทั้งหมด <span>| จำนวน</span></h5>

                        <div class="ps-3">
                            <h6>
                                <p class="card-text"><?php echo $total_users; ?> คน</p>
                            </h6>
                        </div>
                        <a href="managemembers.php" class="btn btn-warning btn-sm">จัดการสมาชิก</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <div class="card">
                    <div class="card-body text-primary">
                        <h5 class="card-title">คำขอซ่อมทั้งหมด <span>| จำนวน</span></h5>
                        <div class="ps-3">
                            <h6>
                                <p class="card-text"><?php echo $total_requests; ?> คำขอ</p>
                            </h6>
                        </div>
                        <a href="manage_repairrequests.php" class="btn btn-warning btn-sm">จัดการคำขอซ่อม</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <div class="card">
                    <div class="card-body text-primary">
                        <h5 class="card-title">อุปกรณ์ทั้งหมด <span>| จำนวน</span></h5>
                        <div class="ps-3">
                            <h6>
                                <p class="card-text"><?php echo $total_equipment; ?> ชิ้น</p>
                            </h6>
                        </div>

                        <a href="device.php" class="btn btn-warning btn-sm">จัดการอุปกรณ์</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <div class="card">
                    <div class="card-body text-primary">
                        <h5 class="card-title">ช่างซ่อมทั้งหมด <span>| จำนวน</span></h5>
                        <div class="ps-3">
                            <h6>
                                <p class="card-text"><?php echo $total_repairman; ?> คน</p>
                            </h6>
                        </div>
                        <a href="managerepairman.php" class="btn btn-warning btn-sm">จัดการข้อมูลช่างซ่อม</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <?php
            require('dataconnect.php'); // เชื่อมต่อกับฐานข้อมูล

            // จำนวนใบแจ้งซ่อมทั้งหมด
            $query_total = "SELECT COUNT(*) as total_requests FROM repair_requests";
            $result_total = mysqli_query($conn, $query_total);
            $row_total = mysqli_fetch_assoc($result_total);
            $total_requests = $row_total['total_requests'];

            // จำนวนใบแจ้งซ่อมที่รอการยืนยัน
            $query_pending = "SELECT COUNT(*) as pending_requests FROM repair_requests WHERE ConfirmationStatus = 'Pending'";
            $result_pending = mysqli_query($conn, $query_pending);
            $row_pending = mysqli_fetch_assoc($result_pending);
            $pending_requests = $row_pending['pending_requests'];

            // จำนวนใบแจ้งซ่อมที่ถูกคอมเฟิร์ม
            $query_confirmed = "SELECT COUNT(*) as confirmed_requests FROM repair_requests WHERE ConfirmationStatus = 'Confirmed'";
            $result_confirmed = mysqli_query($conn, $query_confirmed);
            $row_confirmed = mysqli_fetch_assoc($result_confirmed);
            $confirmed_requests = $row_confirmed['confirmed_requests'];

            // จำนวนใบแจ้งซ่อมที่ถูกยกเลิก
            $query_canceled = "SELECT COUNT(*) as canceled_requests FROM repair_requests WHERE ConfirmationStatus = 'Not Confirmed'";
            $result_canceled = mysqli_query($conn, $query_canceled);
            $row_canceled = mysqli_fetch_assoc($result_canceled);
            $canceled_requests = $row_canceled['canceled_requests'];

            // สรุปราคารวมทั้งหมด
            $query_total_price = "SELECT SUM(EstimatedPrice) as total_price FROM repair_requests WHERE ConfirmationStatus = 'Confirmed'";
            $result_total_price = mysqli_query($conn, $query_total_price);
            $row_total_price = mysqli_fetch_assoc($result_total_price);
            $total_price = $row_total_price['total_price'];

            mysqli_close($conn); // ปิดการเชื่อมต่อกับฐานข้อมูล
        ?>
        <div class="table-responsive ">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>จำนวนใบแจ้งซ่อมทั้งหมด</th>
                        <th>จำนวนใบแจ้งซ่อมที่ยังไม่ถูกคอมเฟิร์ม</th>
                        <th>จำนวนใบแจ้งซ่อมที่ถูกคอมเฟิร์ม</th>
                        <th>จำนวนใบแจ้งซ่อมที่ถูกยกเลิก</th>
                        <th>สรุปราคารวมทั้งหมด</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $total_requests; ?></td>
                        <td><?php echo $pending_requests; ?></td>
                        <td><?php echo $confirmed_requests; ?></td>
                        <td><?php echo $canceled_requests; ?></td>
                        <td><?php echo number_format($total_price, 2); ?> บาท</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </main><br>
    <?php
        include_once 'footerEnd.php';
    ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0-alpha1/dist/js/bootstrap.min.js"></script>



    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>