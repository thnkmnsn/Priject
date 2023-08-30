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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ระบบรับแจ้งซ่อมนาิกาบนเว็บไซต์ - Watch Repair Notification System">
    <meta name="author" content="Vasutron Luanglum - วสุทร เลิงลำ">
    <meta name="keywords" content="โครงการ, โปรเจ็คจบ, โครงการ ป.ตรี, Project, โครงการ">

    <title>Timely Repairs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php
    include 'manu_header.php'
    ?>
    <main>

        <div class="container jumbotron-fluid">
            <div class=" ">
                <br>
                <div class="text-center">
                    <img src="img/Asset1.svg" alt="" width="300" class="d-inline-block align-text-top">
                    <!-- <h1 class="display-4">Timely Repairs</h1> -->
                    <p></p>
                    <p class="lead">บริการรับซ่อมนาฬิกาครบวงจร เราพร้อมช่วยเหลือคุณ</p>
                    <hr class="my-4">
                </div>
                <p>หากคุณต้องการแจ้งซ่อม โปรดคลิกปุ่มด้านล่าง "ตรวจสอบข้อมูล" ด้านล่างนี้ เพื่อตรวจสอบข้อมูลนาฬิกาของคุณ
                </p>
                <a class="btn btn-primary btn-lg mb-3" href="request_repair.php" role="button">ตรวจสอบข้อมูล</a>
            </div>



            <!-- // Path: บทความ -->
            <?php
            include("dataconnect.php"); // นำเข้าไฟล์ dataconnect.php ที่มีการเชื่อมต่อฐานข้อมูล

            $sql = "SELECT * FROM articles ORDER BY publication_date DESC"; // สร้างคำสั่ง SQL สำหรับดึงข้อมูลบทความทั้งหมดจากฐานข้อมูล
            $result = mysqli_query($conn, $sql); // สั่งให้ PHP ดึงข้อมูลจากฐานข้อมูลด้วยคำสั่ง SQL
        ?>
            <div class="mt-5">
                <h4 class="display-4 mt-3 mb-3">บทความน่ารู้</h4>
                <hr class="my-4">
                <div class="row">
                    <div class="col-md-12" id="articles-container">
                        <?php
                while ($row = mysqli_fetch_assoc($result)) { // วนลูปเพื่อดึงข้อมูลจากแต่ละบทความในฐานข้อมูล
                ?>
                        <div class="article-container">
                            <h2 class="article-title"><?php echo $row["title"]; ?></h2>
                            <p class="article-date"><?php echo date("F d, Y", strtotime($row["publication_date"])); ?>
                            </p>
                            <p><?php echo $row["content"]; ?></p>
                            <p class="reference">Source: <a href="<?php echo $row["reference_url"]; ?>"
                                    target="_blank"><?php echo $row["author"]; ?> / Source Name</a>
                            </p>
                        </div>
                        <?php
                }
                ?>
                    </div>
                </div>
            </div>

            <script>
            $(document).ready(function() {
                let articles = $(".article-container");
                let itemsPerPage = 2;
                let currentPage = 1;
                let totalPages = Math.ceil(articles.length / itemsPerPage);

                function updatePagination() {
                    // ซ่อนบทความทั้งหมด
                    articles.hide();

                    // แสดงบทความในหน้าปัจจุบัน
                    for (let i = (currentPage - 1) * itemsPerPage; i < currentPage * itemsPerPage && i <
                        articles
                        .length; i++) {
                        $(articles[i]).show();
                    }
                }

                function createPagination() {
                    let pagination = $('<ul class="pagination"></ul>');

                    for (let i = 1; i <= totalPages; i++) {
                        let listItem = $('<li class="page-item"></li>');
                        let link = $('<a class="page-link" href="#"></a>').text(i).on('click', function(e) {
                            e.preventDefault();
                            currentPage = i;
                            updatePagination();
                        });
                        listItem.append(link);
                        pagination.append(listItem);
                    }
                    $("#articles-container").after(pagination);
                }
                updatePagination();
                createPagination();
            });
            </script>
            <br>
            <hr>
            
        <?php
        include 'footer.php'
        ?>

        </div><br>
    </main>
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