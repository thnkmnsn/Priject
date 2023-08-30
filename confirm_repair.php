<?php
include 'header.php';
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

    <title>Confirm Repair Request - Confirm Repair Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="style.css">

    <script>
    $(document).ready(function() {
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
    </style>
</head>

<body>
    <main>
    <?php
    include 'manu_header.php'
    ?>
    <?php
        require('dataconnect.php'); //connect to database

        if(isset($_POST['confirm'])) //check if form was submitted
        {
            $id = $_POST['id'];
            $confirmationdate = date('Y-m-d H:i:s');
            $confirmationstatus = $_POST['confirmationstatus'];

            //update the repair request in the database
            $sql = "UPDATE repair_requests SET ConfirmationStatus='$confirmationstatus', ConfirmationDate='$confirmationdate' WHERE RequestCode='$id'";

            if(mysqli_query($conn, $sql)){
                echo '<div class="alert alert-success" role="alert">
                    Successfully confirmed the repair request!
                    </div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
                    Failed to confirm the repair request: '. mysqli_error($conn) .'
                    </div>';
            }
        }
        if(isset($_GET['id'])) //check if ID parameter is set in URL
        {
            $id = $_GET['id'];
            $sql = "SELECT * FROM repair_requests WHERE RequestCode='$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        }
    ?>
    <div class="container">
        <h1 class="mt-5 mb-4">Confirm Repair Request</h1>
        <form method="post">
            <div class="form-group">
                <label for="id">Request Code:</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $row['RequestCode']; ?>"
                    readonly>
            </div><br>
            <div class="form-group">
                <label for="confirmationstatus">Confirmation Status:</label>
                <select class="form-control" id="confirmationstatus" name="confirmationstatus">
                    <option value="Confirmed">Confirmed</option>
                </select>
            </div>
            <br>
            <button type="submit" name="confirm" class="btn btn-primary">Confirm</button>
            <a href="status.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <?php
    mysqli_close($conn); //close database connection
    ?>
    </main>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>