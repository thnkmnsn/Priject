<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
            <img src="img/Asset1.svg" alt="" width="100" class="d-inline-block align-text-top">
            </a>
            <!-- Timely Repairs -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="request_repair.php">ข้อมูลนาฬิกาของคุณ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="status.php">ตรวจสอบสถานะการซ่อม</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="repair.php">ขั้นตอนการซ่อม และการรับประกัน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="articles.php">บทความ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact-third.php">ติดต่อเรา</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php
                    if(isset($_SESSION['UserID'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ยินดีตอนรับ : คุณ
                            <strong><?php echo $_SESSION['Name']; ?></strong></a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link"><?php include('counter.php'); ?></a>
                    </li> -->
                    <li>
                        <a type="nav-link" class="btn btn-danger ms-auto" href="logout.php">ออกจากระบบ</a>
                    </li>
                    <?php } else { ?>
                    <li>
                        <a type="nav-link" class="btn btn-primary ms-auto" href="index.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact-third.php">Contact Us</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>