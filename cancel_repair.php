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

    <title>Cancel Repair Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <?php
        include 'manu_headerAD.php';
    ?>
    <?php
    require('dataconnect.php'); //connect to database

    if(isset($_GET['id'])){ //check if id parameter exists in URL
        $id = $_GET['id'];

        //update the repair request in the database
        $sql = "UPDATE repair_requests SET StatusID='1', RepairmanID=NULL, EstimatedPrice=NULL, CompletionDate=NULL, EstimatedRepairDate=NULL, ConfirmationStatus='Not Confirmed', ConfirmationDate=NULL WHERE RequestCode='$id'";

        if(mysqli_query($conn, $sql)){
            echo '<div class="alert alert-success" role="alert">
                  Successfully cancelled the repair request!
                </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                  Failed to cancel the repair request: '. mysqli_error($conn) .'
                </div>';
        }
    }
    mysqli_close($conn); //close database connection
?>
    <div class="container">
        <h1 class="mt-5 mb-4">Cancel Repair Request</h1>
        <a href="status.php" class="btn btn-secondary">Back to Repair Requests</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>