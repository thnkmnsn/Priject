<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="adminpage.php">Management for administrators</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="adminpage.php">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="managemembers.php">จัดการสมาชิก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_repairrequests.php">จัดการใบแจ้งซ่อม</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="device.php">ข้อมูลนาฬิกาทั้งหมด</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="managerepairman.php">จัดการข้อมูลช่างซ่อม</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="managearticles.php">จัดการบทความ</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php
                    if(isset($_SESSION['Email'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ยินดีตอนรับ : คุณ
                        <strong><?php echo $_SESSION['Email']; ?></strong></a>
                    </li>
                    <li>
                        <a type="nav-link" class="btn btn-danger ms-auto" href="logoutAdmin.php">ออกจากระบบ</a>
                    </li>
                    <?php } else { ?>
                    <li>
                        <a type="nav-link" class="btn btn-primary ms-auto" href="adminlogin.php">Login</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>