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

    <title>Add Repairman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <style>
        /* Custom styles for this page */
        .form-container {
            width: 30%;
            margin: 0 auto;
            padding: 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <?php
    include 'manu_headerAD.php'
    ?>

    <div class="container mt-5">
        <h1>Add Repairman Form</h1>
        <form action="submit_add_repairman.php" method="post">
            <div class="form-group mt-2">
                <label for="RepairmanID">ID:</label>
                <input type="text" class="form-control" name="RepairmanID" id="RepairmanID" readonly="readonly"
                    placeholder="ระบบจะกำหนด ID อัตโนมัติ" required>
            </div>
            <div class="form-group">
                <label for="Name">Name:</label>
                <input type="text" class="form-control" id="Name" name="Name" required>
            </div>
            <div class="form-group">
                <label for="Surname">Surname:</label>
                <input type="text" class="form-control" id="Surname" name="Surname" required>
            </div>
            <div class="form-group">
                <label for="Phone">Phone:</label>
                <input type="text" class="form-control" id="Phone" name="Phone" required>
            </div>
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="email" class="form-control" id="Email" name="Email" required>
            </div>
            <div class="form-group">
                <label for="Address">Address:</label>
                <input type="text" class="form-control" id="Address" name="Address" required>
            </div>
            <div class="form-group">
                <label for="Specialization">Specialization:</label>
                <select class="form-control" id="Specialization" name="SpecializationID">
                    <?php
                        require('dataconnect.php');
                        $query = "SELECT SpecializationID, SpecializationName FROM specialization";
                        $result = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='".$row['SpecializationID']."'>".$row['SpecializationName']."</option>";
                        }
                        mysqli_close($conn);
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">เพิม่ข้อมูลช่าง</button>
        </form>
    </div>
</body>
</html>