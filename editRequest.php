<?php
    include 'headerAdmin.php';
?>
<?php
    require('dataconnect.php'); //connect to database
    if (isset($_POST['submit'])) {
        $RequestCode = $_GET['id'];
        $ProblemDetails = isset($_POST['problemdetails']) ? $_POST['problemdetails'] : '';
        $RepairmanID = isset($_POST['repairman']) ? $_POST['repairman'] : '';
        $EstimatedRepairDate = isset($_POST['estimatedrepairdate']) ? $_POST['estimatedrepairdate'] : '';
        $EstimatedPrice = isset($_POST['estimatedprice']) ? $_POST['estimatedprice'] : '';

        $query = "UPDATE repair_requests SET 
        RepairmanID='$RepairmanID',
        EstimatedPrice='$EstimatedPrice'
        WHERE RequestCode='$RequestCode'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location:manage_repairrequests.php");
            exit();
        } else {
            echo "Update failed";
        }
    } else {
        $RequestCode = $_GET['id'];
        $query = "SELECT * FROM repair_requests WHERE RequestCode='$RequestCode'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $('#repair-requests-table').DataTable();
        });
    </script>

    <style>
    /* Custom styles for this page */
    table {
        font-size: 14px;
        background-color: #fff;
        box-shadow: 0 6px 10px -4px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
        border-radius: 10px;
        overflow: hidden;
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
    }

    thead {
        background-color: #292b2c;
        color: #fff;
        position: sticky;
        top: 0;
    }

    tbody tr:nth-child(even) {
        background-color: #f5f5f5;
    }

    tbody tr:hover {
        background-color: #e6f5ff;
    }

    .zoomable-image {
        transition: transform 0.3s;
    }

    .zoomable-image:hover {
        transform: scale(1.8);
    }
    </style>
</head>

<body>
    <?php include 'manu_headerAD.php' ?>
    <div class="container">

        <h1 class="mt-5 mb-4">Edit Repair Request</h1>
        <?php
            include 'dataconnect.php';
            $id = $_GET['id'];
            $sql = "SELECT * FROM repair_requests WHERE RequestCode='$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        ?>

        <form action="editRequest.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-inline ">
                <div class="row">
                    <div class="form-group mr-3 col">
                        <label for="id">Request Code: รหัสใบแจ้งซ่อม</label>
                        <input type="text" class="form-control" id="id" name="id"
                            value="<?php echo $row['RequestCode']; ?>" disabled readonly>
                    </div>
                    <div class="form-group col">
                        <label for="estimatedrepairdate">Estimated Repair Date: วันที่จะเข้าซ่อม/ส่งซ่อม</label>
                        <input type="datetime-local" class="form-control" id="estimatedrepairdate"
                            name="estimatedrepairdate"
                            min="<?php echo date('Y-m-d\TH:i', strtotime($row['EstimatedRepairDate'])); ?>"
                            value="<?php echo date('Y-m-d\TH:i', strtotime($row['EstimatedRepairDate'])); ?>" disabled
                            readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="ProblemDetails">รายละเอียดความเสียหาย</label>
                    <textarea class="form-control" id="problemdetails" name="problemdetails" rows="3"
                        disabled><?php echo $row['ProblemDetails']; ?></textarea>
                </div>
            </div>

            <br>
            <div class="d-flex justify-content-center border border-1">
                <?php if (!empty($row['Image1'])): ?>
                <img src="img/<?php echo $row['Image1']; ?>" style="max-width: 200px; max-height: 200px;"
                    class="img-fluid zoomable-image">
                <?php else: ?>
                <p>ไม่พบรูปถ่าย</p>
                <?php endif; ?>
                <?php if (!empty($row['Image2'])): ?>
                <img src="img/<?php echo $row['Image2']; ?>" style="max-width: 200px; max-height: 200px;"
                    class="img-fluid zoomable-image">
                <?php endif; ?>
                <?php if (!empty($row['Image3'])): ?>
                <img src="img/<?php echo $row['Image3']; ?>" style="max-width: 200px; max-height: 200px;"
                    class="img-fluid zoomable-image">
                <?php endif; ?>
            </div>
            <label class="d-flex justify-content-center"><i>รูปถ่ายความเสียหาย</i></label>
            <div class="form-group">
                <label for="repairman">Repairman: รหัสช่างซ่อม</label>
                <select class="form-control" id="repairman" name="repairman">
                    <option value="">Select a repairman</option>
                    <?php
                    $sql = "SELECT * FROM repairman";
                    $result = mysqli_query($conn, $sql);
                    while ($repairman = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $repairman['RepairmanID'] . '"';
                        if ($repairman['RepairmanID'] == $row['RepairmanID']) echo ' selected';
                        echo '>' . $repairman['RepairmanID'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="estimatedprice">Estimated Price: ราคาประเมินเบื้องต้น</label>
                <input type="number" class="form-control " id="estimatedprice" name="estimatedprice" min="0.00"
                    value="<?php echo $row['EstimatedPrice']; ?>">
            </div>
            <div class="form-group mt-3">
                <label for="status">Status: สถานะการซ่อม</label>
                <?php if ($row['StatusID'] == 1): ?>
                <span class="btn btn-warning btn-sm">อยู่ระหว่างดำเนินการ</span>
                <?php elseif ($row['StatusID'] == 2): ?>
                <span class="btn btn-success btn-sm">ปิดงาน</span>
                <?php endif; ?>
            </div>
                
            <div class="form-group mt-2 col-3">
                <label for="CompletionDate">วันที่ซ่อมเสร็จ / ปิดงาน</label>
                <input type="datetime-local" class="form-control" id="CompletionDate" name="CompletionDate"
                    value="<?php echo date('Y-m-d\TH:i', strtotime($row['CompletionDate'])); ?>"disabled readonly>

            </div>

            <br>
            <button type="submit" name="submit" class="btn btn-primary mt-05">Update</button>
            <a href="manage_repairrequests.php" class="btn btn-danger">Cancel</a>
        </form>
        <br>

    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>