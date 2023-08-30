<?php
include 'headerAdmin.php';
?>
<?php
    require('dataconnect.php'); // connect to database

    // check if form is submitted
    if(isset($_POST['submit'])){
        // get form data
        $userid = $_GET['id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        
        // update user information in database
        $stmt = $conn->prepare("UPDATE users SET Name=?, Surname=?, Email=?, Password=?, Phone=?, Address=? WHERE UserID=?");
        $stmt->bind_param("ssssssi", $name, $surname, $email, $password, $phone, $address, $userid);
        $result = $stmt->execute(); //คือการประมวลผลคำสั่ง sql ที่เราเขียนขึ้นมา โดยจะคืนค่าเป็น true หรือ false กลับมา
        if($result){
            // redirect to managemembers page after successful update
            header('Location: managemembers.php');
            exit;
        }
    }

    // get user information from database
    $userid = $_GET['id'];
    // Check if $userid is a valid integer
    if (!filter_var($userid, FILTER_VALIDATE_INT)) {
        echo "Invalid user ID";
        exit;
    }
    $stmt = $conn->prepare("SELECT * FROM users WHERE UserID=?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
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

    <title>Edit member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <style>
    /* Custom styles for this page */
    .form-container {
        width: 50%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    </style>

</head>

<body>
    <?php
        include 'manu_headerAD.php';
    ?>
    <br>
    <div class="container">
        <div class="form-container">
            <h2>Edit Member Information</h2><br>
            <?php
                include('dataconnect.php');
                $id=$_GET['id'];
                $sql="SELECT * FROM users WHERE UserID=$id";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_assoc($result);
            ?>
            <form action="editmember.php?id=<?php echo $id;?>" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name : ชื่อ</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['Name'];?>">
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Surname : นามสกุล</label>
                    <input type="text" class="form-control" id="surname" name="surname"
                        value="<?php echo $row['Surname'];?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E_mail</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo $row['Email'];?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password : รหัสผ่าน</label>
                    <input type="password" class="form-control" id="password" name="password"
                        value="<?php echo $row['Password'];?>">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone : เบอร์โทรศัพท์</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['Phone'];?>">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address : ที่อยู่</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="<?php echo $row['Address'];?>">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
                <a href="managemembers.php" class="btn btn-danger">Cancel</a>
            </form>
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