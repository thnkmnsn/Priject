<?php
    include_once 'headerAdmin.php';
?>
<?php
require('dataconnect.php');

if (isset($_POST['submit'])){
    
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

    <title>Check Repair Status - ตรวจสอบสถานะการซ่อม</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>
    <?php include 'manu_headerAD.php' ?>

    <div class="mt-5 mb-4">
        <h1 class="text-center">Edit Repair Request</h1>
    </div>


    <form method="POST">
        <div class="">
            <label for="id">Request Code: รหัสใบแจ้งซ่อม</label>
            <input type="text" class="form-control" id="id" name="id" value="<?php echo $_GET['id']; ?>" readonly>
        </div>


    </form>

</body>

</html>