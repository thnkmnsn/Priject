<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ระบบรับแจ้งซ่อมนาิกาบนเว็บไซต์ - Watch Repair Notification System">
    <meta name="author" content="Vasutron Luanglum - วสุทร เลิงลำ">
    <meta name="keywords" content="โครงการ, โปรเจ็คจบ, โครงการ ป.ตรี, Project, โครงการ">

    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="style.css">

    <style>
    /* Custom styles for this page */
    .form-container {
        width: 85%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
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
                <h1 class="text-center my-2">ลงทะเบียนผู้ใช้งาน</h1>
            </div>
            <div class="card-body text-dark">
                <form class="" action="register_REG.php" method="post">
                    <div class="form-group mt-2">
                        <label for="UserID ">ID:</label>
                        <input type="text" class="form-control" name="UserID" id="UserID" readonly="readonly"
                            placeholder="ระบบจะกำหนด ID อัตโนมัติ" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="Name">Name: ชื่อผู้ใช้ (ใช้เป็นชื่อ User)</label>
                        <input type="text" class="form-control" name="Name" id="Name" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="Surname">Surname: นามสกุล</label>
                        <input type="text" class="form-control" name="Surname" id="Surname" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="Email">Email: อีเมล</label>
                        <input type="Email" class="form-control" name="Email" id="Email" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="Password">Password: รหัสผ่าน</label>
                        <input type="Password" class="form-control" name="Password" id="Password" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="Phone">Phone: หมายเลขโทรศัพท์</label>
                        <input type="text" class="form-control" name="Phone" id="Phone" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="Address">Address: ที่อยู่</label>
                        <input type="text" class="form-control" name="Address" id="Address" required>
                    </div>

                    <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">ลงทะบียน</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>