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

    <title>Manage repairman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#repair-requests-table').DataTable();
    });
    </script>
    <!-- เรียกใช้งาน Datatable โดยการกำหนด id ให้กับตารางข้อมูลของเราเป็น repair-requests-table และกำหนดให้มีการแสดงผล 10 แถวแรก 
    โดยใช้คำสั่ง $('#repair-requests-table').DataTable(); ซึ่งเป็นคำสั่งเรียกใช้งาน Datatable ในส่วนของตารางข้อมูลที่มี id เป็น repair-requests-table -->

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
    </style>
</head>

<body>
    <?php
        include 'manu_headerAD.php';
    ?>

    <main>
        <br>
        <div class="container">
            <h1>จัดการข้อมูลช่างซ่อม</h1>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <a href="addrepairman.php" class="btn btn-primary mb-3">เพิ่มข้อมูลช่าง</a>
                    <table id="repair-requests-table" class="table table-responsive mt-3">
                        <thead>
                            <tr>
                                <th>รหัสช่างซ่อม</th>
                                <th>ชื่อ</th>
                                <th>นามสกุล</th>
                                <th>Email</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>ที่อยู่</th>
                                <th>ความเชี่ยวชาญ</th>
                                <th>ตัวดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                require('dataconnect.php');
                                
                                $query = "SELECT repairman.*, GROUP_CONCAT(specialization.SpecializationName SEPARATOR ', ') 
                                AS Specialization 
                                FROM repairman 
                                LEFT JOIN repairman_specialization 
                                ON repairman.RepairmanID = repairman_specialization.RepairmanID 
                                LEFT JOIN specialization 
                                ON repairman_specialization.SpecializationID = specialization.SpecializationID 
                                GROUP BY repairman.RepairmanID"; 
                                // ^ เลือกข้อมูลจากตาราง repairman และเชื่อมตาราง repairman_specialization 
                                // และ specialization โดยให้เชื่อมตาราง repairman กับ repairman_specialization ด้วยคอลัมน์ RepairmanID 
                                // และเชื่อมตาราง repairman_specialization กับ specialization ด้วยคอลัมน์ SpecializationID 
                                // และให้แสดงข้อมูลจากตาราง specialization โดยใช้คำสั่ง GROUP_CONCAT ในการรวมข้อมูลที่มีค่าซ้ำกันในคอลัมน์ SpecializationName 
                                // และให้แสดงข้อมูลจากตาราง repairman โดยจะแสดงข้อมูลที่มีค่าซ้ำกันในคอลัมน์ RepairmanID และให้แสดงข้อมูลจากตาราง repairman โดยจะแสดงข้อมูลที่มีค่าซ้ำกันในคอลัมน์ RepairmanID
                                $result = mysqli_query($conn, $query);
                                
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $specialization = $row['Specialization'] ? $row['Specialization'] : "No specialization"; 
                                        // ^ใช้ตัวแปร $specialization เก็บข้อมูลที่ได้จากการ query ข้อมูลจากตาราง specialization แล้วเช็คว่ามีข้อมูลหรือไม่ ถ้ามีให้แสดงข้อมูล ถ้าไม่มีให้แสดงข้อความว่า No specialization
                                        echo "<tr>
                                                <td>".$row['RepairmanID']."</td>
                                                <td>".$row['Name']."</td>
                                                <td>".$row['Surname']."</td>
                                                <td>".$row['Email']."</td>
                                                <td>".$row['Phone']."</td>
                                                <td>".$row['Address']."</td>
                                                <td>".$specialization."</td>
                                                <td>
                                                    <a href='editrepairman.php?id=".$row['RepairmanID']."' class='btn btn-secondary mr-2'>Edit</a>
                                                    <a href='deleterepairman.php?id=".$row['RepairmanID']."' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this repairman?\");'>Delete</a>
                                                </td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr>
                                            <td colspan='8'>No data available</td>
                                        </tr>";
                                }
                                
                                mysqli_close($conn);
                                ?>
                        </tbody>
                    </table>
                </div>
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

</body>

</html>