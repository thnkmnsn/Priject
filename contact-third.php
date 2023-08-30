<?php
session_start(); // start session
if(isset($_SESSION['UserID'])){
}
if(!isset($_SESSION['Name'])){
    $_SESSION['Name'] = ""; // กำหนดค่าเริ่มต้น
}
if(!isset($_SESSION['Email'])){
    $_SESSION['Email'] = ""; // กำหนดค่าเริ่มต้น
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="custom-style.css">
    <link rel="stylesheet" href="style.css">

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

</head>

<body>
    <?php
    include 'manu_header.php'
    ?>
    <div class="container mt-5">
        <div class="card border-dark mb-3">
            <div class="card-header text-center">
                <div class="pagetitle">
                    <h1>ติดต่อเรา</h1>
                </div>
            </div>
            <div class="card-body text-dark">

                <form>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" id="message" rows="5" required></textarea>
                    </div>
                    <a htef="#" class="btn btn-primary mt-3" id="registrationModalLink" data-bs-toggle="modal"
                        data-bs-target="#registrationModal">ส่งข้อมูล</a>

                    <!-- Modal -->
                    <div class="modal fade" id="registrationModal" tabindex="-5"
                        aria-labelledby="registrationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="registrationModalLabel">ส่งข้อมูลแล้ว</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- เนื้อหาใน Modal -->
                                    <p>เราได้รับข้อมูลของคุณแล้ว จะมีทีมงานติดต่อกลับคุณโดยเร็วที่สุด</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="pagetitle">
                        <h1>ติดต่อ</h1>
                    </div>
                    <section class="section contact">

                        <div class="row gy-4">

                            <div class="col-xl-6">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="info-box card">
                                            <i class="bi bi-geo-alt"></i>
                                            <h3>ที่อยู่</h3>
                                            <p>2298 ถนนสรรพาวุธ เขตบางนา<br>กรุงเทพมหานคร 10260 ประเทศไทย</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="info-box card">
                                            <i class="bi bi-telephone"></i>
                                            <h3>โทร</h3>
                                            <p>:<br>: 097 052 1721</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="info-box card">
                                            <i class="bi bi-envelope"></i>
                                            <h3>Email Us</h3>
                                            <p>popart.vl@gmail.com<br>thanakorn.moonsan@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="info-box card">
                                            <i class="bi bi-clock"></i>
                                            <h3>ช่วงเวลา</h3>
                                            <p>จันทร์ - ศุกร์<br>9:00 น. - 17:00 น.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-xl-6">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2617.270112178769!2d100.59999101576899!3d13.674054230722756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2a019f528d4d3%3A0x551a811a98884005!2z4Lih4Lir4Liy4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4LmA4LiL4Liy4LiY4LmM4Lit4Li14Liq4LiX4LmM4Lia4Liy4LiH4LiB4Lit4LiB!5e1!3m2!1sth!2sth!4v1684253313130!5m2!1sth!2sth"
                                    width="100%" height="85%" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>

                        </div>

                    </section>

                    <div class="col-md-6">

                        <h3>Follow Us <a href="https://github.com/Vasutron"><img src="img/github-mark.svg"
                                    width="50px"></a></h3>
                        <!-- <a href=" "><img src="img/Facebook-reversed.svg" width="50px"></a>
                        <a href=" "><img src="img/YouTube_Logo_2017.svg" width="50px"></a>
                        <a href=" "><img src="img/Instagram_logo_2022.svg" width="25px"></a> -->

                    </div>

                </div>
            </div>
        </div>

    </div><br>
    <footer class="pt-3 text-center bg-transparent border-dark border-top">
        <img src="img/Asset1.svg" alt="" width="100">
        <div class="text-center" style="margin-top: 10px; font-size: 14px; color: #777;">Contact Line ID: tor_original
        </div>
        <p class="text-center" style="margin-top: 5px; font-size: 14px; color: #777;"> Created by Vasutron © 2022</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>