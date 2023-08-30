<?php
include 'headerAdmin.php';
?>
<?php
require('dataconnect.php');

// Check if user id is set and is a valid integer
if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
    $id = $_GET['id'];

    // Get user information
    $stmt = $conn->prepare("SELECT Name FROM users WHERE UserID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if user exists
    if(!$row){
        echo "User not found";
        exit;
    }

    // Check if form is submitted
    if(isset($_POST['submit'])){
        // Delete user from database
        $stmt = $conn->prepare("DELETE FROM users WHERE UserID = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();

        // Check if delete query was successful
        if($result){
            // Redirect to managemembers page
            header('Location: managemembers.php');
            exit;
        }else{
            echo "Failed to delete user";
        }
    }
}else{
    echo "Invalid user ID";
    exit;
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

    <title>Delete Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>
    <?php
        include 'manu_headerAD.php';
    ?>
    <div class="container mt-5">
        <div class="card mx-auto border-danger">
            <div class="card-body">
                <h2 class="card-title mb-4 text-danger">ลบสมาชิก</h2>
                <p class="card-text mb-3">คุณต้องการลบข้อมูลนี้ใช่หรือไม่?</p>
                <form method="POST" class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" value="<?php echo $row['Name']; ?>" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="actions">&nbsp;</label>
                        <div class="d-flex justify-content-end">
                            <a href="managemembers.php" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-times-circle me-2"></i> Cancel
                            </a>
                            <button type="submit" name="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt me-2"></i> Delete
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>