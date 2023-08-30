<?php
require('dataconnect.php'); // เชื่อมต่อกับฐานข้อมูล

$search = $_GET['search'];
$search_type = $_GET['search_type'];

$query = ""; // กำหนดค่าเริ่มต้นให้กับตัวแปร $query

// ค้นหาตามประเภทที่ระบุ
switch ($search_type) {
    case 'RequestCode':
        $query = "SELECT repair_requests.*, equipment.* FROM repair_requests INNER JOIN equipment ON repair_requests.DeviceID = equipment.DeviceID WHERE repair_requests.RequestCode LIKE '%$search%'";
        break;
    case 'DeviceID':
        $query = "SELECT repair_requests.*, equipment.* FROM repair_requests INNER JOIN equipment ON repair_requests.DeviceID = equipment.DeviceID WHERE repair_requests.DeviceID LIKE '%$search%'";
        break;
    case 'DeviceName':
        $query = "SELECT repair_requests.*, equipment.* FROM repair_requests INNER JOIN equipment ON repair_requests.DeviceID = equipment.DeviceID WHERE equipment.DeviceName LIKE '%$search%'";
        break;
    case 'UserID':
        $query = "SELECT repair_requests.*, equipment.* FROM repair_requests INNER JOIN equipment ON repair_requests.DeviceID = equipment.DeviceID WHERE repair_requests.UserID LIKE '%$search%'";
        break;
    case 'ConfirmationStatus':
        $query = "SELECT repair_requests.*, equipment.* FROM repair_requests INNER JOIN equipment ON repair_requests.DeviceID = equipment.DeviceID WHERE repair_requests.ConfirmationStatus LIKE '%$search%'";
        break;
    default:
        $query = "SELECT repair_requests.*, equipment.* FROM repair_requests INNER JOIN equipment ON repair_requests.DeviceID = equipment.DeviceID";
        break;
}

if ($query != "") {
    $result = mysqli_query($conn, $query);
} else {
    die("No search query was provided.");
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Repair Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <a class="navbar-brand" href="#">Management page for administrators</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="adminpage.php">Home Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="managemembers.php">Manage members</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Manage repair requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="device.php">Manage devices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="managerepairman.php">Manage repairman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-primary" href="adminlogin.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

</head>

<body>
    <main>
        <div class="container">
            <h2>Search results:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Request Code</th>
                        <th>Device ID</th>
                        <th>Device Name</th>
                        <th>User ID</th>
                        <th>Status</th>
                        <!-- Add other columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['RequestCode']; ?></td>
                        <td><?php echo $row['DeviceID']; ?></td>
                        <td><?php echo $row['DeviceName']; ?></td>
                        <td><?php echo $row['UserID']; ?></td>
                        <td><?php echo $row['ConfirmationStatus']; ?></td>
                        <!-- Add other columns as needed -->
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>

<?php
mysqli_close($conn); // ปิดการเชื่อมต่อกับฐานข้อมูล
?>