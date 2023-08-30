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

    <title>Manage members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function () {
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
    </style>
</head>

<body>
    <?php
    include 'manu_headerAD.php'
    ?>
    <main>
        <br>
        <div class="container">
            <h1>จัดการสมาชิก</h1>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <table id="repair-requests-table" class="table table-responsive mt-3">
                        <thead>
                            <tr>
                                <th>รหัสสมาชิก</th>
                                <th>ชื่อ</th>
                                <th>นามสกุล</th>
                                <th>Email</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>ที่อยู่</th>
                                <th>ตัวดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                require('dataconnect.php'); //connect to database
                                
                                $query = "SELECT * FROM users";
                                $result = mysqli_query($conn, $query);
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<tr>';
                                    echo '<td>'.$row['UserID'].'</td>';
                                    echo '<td>'.$row['Name'].'</td>';
                                    echo '<td>'.$row['Surname'].'</td>';
                                    echo '<td>'.$row['Email'].'</td>';
                                    echo '<td>'.$row['Phone'].'</td>';
                                    echo '<td>'.$row['Address'].'</td>';
                                    echo '<td>
                                            <a href="editmember.php?id='.$row['UserID'].'" class="btn btn-secondary">Edit</a>
                                            <a href="deletemember.php?id='.$row['UserID'].'" class="btn btn-danger">Delete</a>
                                         </td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
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

</body>

</html>