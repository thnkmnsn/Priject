<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ระบบรับแจ้งซ่อมนาิกาบนเว็บไซต์ - Watch Repair Notification System">
    <meta name="author" content="Vasutron Luanglum - วสุทร เลิงลำ">
    <meta name="keywords" content="โครงการ, โปรเจ็คจบ, โครงการ ป.ตรี, Project, โครงการ">

    <title>Login</title>
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

    <main>
        <br>
        <div class="container py-5">
            <div class="jumbotron">
                <div class="text-center">
                    <img src="img/Asset1.svg" alt="" width="300" class="d-inline-block align-text-top">
                    <!-- <h1 class="display-4">Timely Repairs</h1> -->
                    <p></p>
                    <p class="lead">บริการรับซ่อมนาฬิกาครบวงจร เราพร้อมให้บริการ และช่วยเหลือคุณ</p>
                    <hr class="my-4">
                </div>
                <p>หากคุณต้องการใช้บริการ โปรดเข้าสู่ระบบด้านล่างนี้เพื่อเริ่มต้น</p>
                <p>หรือลงทะเบียน เป็นสมาชิกกับเรา</p>
            </div>

            <div class="form-container mt-5">
                <div class="card border-dark mb-3">
                    <div class="card-header">
                        <h1 class="text-center mb-2 mt-2">เข้าสู่ระบบ</h1>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="post">
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">ชื่อผู้ใช้ :</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">รหัสผ่าน :</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="remember-me" name="remember-me">
                                <label class="form-check-label" for="remember-me">จำข้อมูลของฉัน</label>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark">เข้าสู่ระบบ</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <a class="btn btn-outline-primary" href="register.php" role="button">ลงทะเบียนสมาชิก</a>
                            <a class="btn btn-outline-info" href="#" role="button" id="registrationModalLink"
                                data-toggle="modal" data-target="#registrationModal">ลืมรหัสผ่าน ?</a>
                            </p>

                            <!-- Modal -->
                            <div class="modal fade" id="registrationModal" tabindex="-1"
                                aria-labelledby="registrationModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="registrationModalLabel">คุณลืมรหัสผ่านใช่หรือไม่
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- เนื้อหาใน Modal -->
                                            <p>โปรดพักผ่อนเยอะ ๆ และจดจำข้อมูลส่วนบุคคลของคุณให้ได้</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p>สำหรับผู้ดูแลระบบ <a href="adminlogin.php">Login Admin</a></p>
                            <!-- <p>For repairmen. <a href="">Login Repairmen</a>.</p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#registrationModalLink').click(function() {
            $('#registrationModal').modal('show');
        });
    });
    </script>
</body>

</html>