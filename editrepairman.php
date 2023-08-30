<?php
include 'headerAdmin.php';
?>
<?php
    require('dataconnect.php'); 

    if(isset($_GET['id'])){ // ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
        $id = $_GET['id'];
        
        // เลือกข้อมูลจากตาราง repairman ที่มีรหัสช่างซ่อมตามที่ส่งมาจากฟอร์ม และเก็บไว้ในตัวแปร $repairman และ $specializations ตามลำดับ
        $query = "SELECT * FROM repairman WHERE RepairmanID = '$id'";
        $result = mysqli_query($conn, $query);
        $repairman = mysqli_fetch_assoc($result);

        //query to select the specializations of the repairman
        $query = "SELECT SpecializationID FROM repairman_specialization WHERE RepairmanID = '$id'";
        $result = mysqli_query($conn, $query);
        $specializations = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else{
        header("Location: managerepairman.php");
    }

    // ตรวจสอบว่ามีการกดปุ่ม submit หรือไม่
    if(isset($_POST['submit'])){
        // นำข้อมูลจากฟอร์มมาเก็บในตัวแปร
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $specializations = $_POST['specializations'];

        // อัพเดทข้อมูลในฐานข้อมูล โดยใช้คำสั่ง UPDATE ใน SQL โดยมี WHERE คือ ตัวเลือกในการอัพเดท ในที่นี้คือ รหัสช่างซ่อม และ รหัสช่างซ่อมที่เลือกจากฟอร์ม
        $query = "UPDATE repairman SET Name='$name', Surname='$surname', Email='$email', Phone='$phone', Address='$address' WHERE RepairmanID='$id'";
        $result = mysqli_query($conn, $query);

        // ลบข้อมูลในตาราง repairman_specialization ที่มีรหัสช่างซ่อมตรงกับที่เลือกจากฟอร์ม โดยใช้คำสั่ง DELETE ใน SQL 
        $query = "DELETE FROM repairman_specialization WHERE RepairmanID='$id'";
        $result = mysqli_query($conn, $query);

        // วนลูปเพื่อเพิ่มข้อมูลในตาราง repairman_specialization โดยใช้คำสั่ง INSERT ใน SQL โดยมีค่าที่เพิ่มคือ รหัสช่างซ่อม และ รหัสสาขาที่เลือกจากฟอร์ม 
        // โดยใช้ตัวแปร $id ที่เก็บรหัสช่างซ่อม และ ตัวแปร $specialization ที่เก็บรหัสสาขา ที่เลือกจากฟอร์ม ในการวนลูป
        foreach($specializations as $specialization){
            $query = "INSERT INTO repairman_specialization (RepairmanID, SpecializationID) VALUES ('$id', '$specialization')";
            $result = mysqli_query($conn, $query);
        }

        header("Location: managerepairman.php");
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

    <title>Edit repairman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <style>
        /* Custom styles for this page */
        .form-container {
            width: 30%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <?php
    include 'manu_headerAD.php'
    ?>

    <main>
        <br>
        <div class="container bg-secondary-subtle border border-primary-subtle">
            <div class="">
                <h1 class="col-md-12 mt-5">Edit repairman</h1>
                <form class="row g-3" action="editrepairman.php?id=<?php echo $id; ?>" method="POST">
                    <div class="form-group col-md-6 mt-5">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?php echo $repairman['Name']; ?>">
                    </div>
                    <div class="form-group col-md-6 mt-5">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname"
                            value="<?php echo $repairman['Surname']; ?>">
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?php echo $repairman['Email']; ?>">
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="<?php echo $repairman['Phone']; ?>">
                    </div>
                    <div class="form-group col-md-12 mt-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="<?php echo $repairman['Address']; ?>">
                    </div>
                    <div class="form-group col-md-3 mt-3">
                        <label for="specialization">Specializations</label>
                        <input type="text" class="form-control" id="specialization" name="specialization"
                            readonly="readonly" value="
                            <?php
                                $query = "SELECT SpecializationID FROM repairman_specialization WHERE RepairmanID = '$id'"; // คำสั่ง SQL ในการเลือก specialization ของ repairman ที่มี id ตรงกับที่เลือก
                                $result = mysqli_query($conn, $query); // ประมวลผลคำสั่ง SQL 
                                $specializationIDs = array(); // สร้าง array เพื่อเก็บ id ของ specialization ที่เลือกไว้
                                while($row = mysqli_fetch_assoc($result)){
                                    $specializationIDs[] = $row['SpecializationID'];
                                } // วนลูปเพื่อเก็บ id ของ specialization ที่เลือกไว้ใน array $specializationIDs
                                // นำเข้าข้อมูลจากตาราง specialization มาแสดง โดยแสดงเฉพาะ specialization ที่มี id ตรงกับที่เลือก 
                                // และเก็บไว้ในตัวแปร $specializationNames และแสดงผล โดยใช้ implode ในการแสดง 
                                // และใช้คำว่า No specialization ในกรณีที่ไม่มี specialization ใดๆ
                                if (count($specializationIDs) > 0) {
                                    $query = "SELECT SpecializationName FROM specialization WHERE SpecializationID IN (" . implode(",", $specializationIDs) . ")";
                                    $result = mysqli_query($conn, $query);
                                    $specializationNames = array();
                                    while($row = mysqli_fetch_assoc($result)){
                                        $specializationNames[] = $row['SpecializationName'];
                                    }
                                    echo implode(", ", $specializationNames);
                                } else {
                                    echo "No specialization";
                                }
                            ?>
                        ">
                    </div>

                    <div class="form-group col-md-12 mt-3">
                        <label for="specializations">Specializations</label>
                        <?php
                            //ดึงข้อมูลจากตาราง specialization ทั้งหมด มาแสดง และเก็บไว้ในตัวแปร $result
                            $query = "SELECT * FROM specialization";
                            $result = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_assoc($result)){
                                // ตรวจสอบว่า SpecializationID ที่รับมาตรงกับ SpecializationID ในตาราง repairman_specialization หรือไม่ ถ้าตรงให้เลือก ถ้าไม่ตรงให้ไม่เลือก
                                $selected = "";
                                foreach($specializations as $s){
                                    if($s['SpecializationID'] == $row['SpecializationID']){
                                        $selected = "selected";
                                    }
                                }
                                echo "<div class='form-check'>
                                <input class='form-check-input' type='radio' name='specializations[]' id='specialization-".$row['SpecializationID']."' value='".$row['SpecializationID']."' ".$selected.">
                                <label class='form-check-label' for='specialization-".$row['SpecializationID']."'>".$row['SpecializationName']."</label>
                                </div>";
                            }
                            // วนลูปเพื่อแสดง specialization ทั้งหมด โดยให้เลือก specialization ที่มี id ตรงกับที่เลือกไว้ 
                            // และไม่เลือก specialization ที่ไม่มี id ตรงกับที่เลือกไว้ 
                        ?>
                    </div>
                    <input class="p-2 col-md-6 mt-5 mb-3 btn btn-primary" type="submit" name="submit"
                        value="Save changes">
                    <a class="p-2 col-md-6 mt-5 mb-3 btn btn-outline-danger" href="managerepairman.php"
                        role="button">Cancel</a>
                </form>
            </div>
        </div>
    </main>
    <?php
    $conn->close();
    ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>