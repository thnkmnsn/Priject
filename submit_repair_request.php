<?php
session_start();
require('dataconnect.php');

$DeviceID = $_POST['DeviceID'];
$RepairType = $_POST['RepairType'];
$ProblemDetails = $_POST['ProblemDetails'];
$EstimatedRepairDate = $_POST['EstimatedRepairDate'];
$DeliveryDate = isset($_POST['DeliveryDate']) ? $_POST['DeliveryDate'] : date('Y-m-d\TH:i');
$Image1 = null;
$Image2 = null;
$Image3 = null;

if (!empty($_FILES['Image1']['tmp_name'])) {
    $extension = pathinfo($_FILES['Image1']['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid() . '.' . $extension;
    $target_directory = 'img/';
    $target_file = $target_directory . $newFileName;
    if (move_uploaded_file($_FILES['Image1']['tmp_name'], $target_file)) {
        $Image1 = $newFileName;
    }
}

if (!empty($_FILES['Image2']['tmp_name'])) {
    $extension = pathinfo($_FILES['Image2']['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid() . '.' . $extension;
    $target_directory = 'img/';
    $target_file = $target_directory . $newFileName;
    if (move_uploaded_file($_FILES['Image2']['tmp_name'], $target_file)) {
        $Image2 = $newFileName;
    }
}

if (!empty($_FILES['Image3']['tmp_name'])) {
    $extension = pathinfo($_FILES['Image3']['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid() . '.' . $extension;
    $target_directory = 'img/';
    $target_file = $target_directory . $newFileName;
    if (move_uploaded_file($_FILES['Image3']['tmp_name'], $target_file)) {
        $Image3 = $newFileName;
    }
}

$UserID = $_SESSION['UserID'];

$sql = "INSERT INTO repair_requests (DeviceID, RepairType, ProblemDetails, EstimatedRepairDate, UserID, DeliveryDate, Image1, Image2, Image3)
        VALUES ('$DeviceID', '$RepairType', '$ProblemDetails', '$EstimatedRepairDate', '$UserID', '$DeliveryDate', '$Image1', '$Image2', '$Image3')";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>";
    echo "var modal = new bootstrap.Modal(document.getElementById('successModal'));";
    echo "modal.show();";
    echo "</script>";
    // echo "<script>setTimeout(function(){ window.location.href = 'request_repair.php'; }, 1000);</script>";
} else {
    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งซ่อมเรียบร้อย</title>
    <!-- ไลบรารี Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">

    <!-- ไลบรารี jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- ไลบรารี Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Repair request submitted successfully</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>ส่งใบแจ้งซ่อมเรียบร้อย</p>
                    <p>เราจะแจ้งประเมินราคาซ่อมให้คุณภายใน 3 วันทำการ</p>
                    <p>หากคุณยังไม่ได้รับราคาประเมิน โปรดติดต่อเรา</p>
                    <a href="contact-third.php" class="">ติดต่อเรา</a>
                </div>
                <div class="modal-footer">
                    <a href="status.php" class="btn btn-secondary">รายการแจ้งซ่อม</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        var modal = new bootstrap.Modal(document.getElementById('successModal'));
        modal.show();
    });
    </script>

</body>

</html>