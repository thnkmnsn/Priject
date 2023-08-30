<?php
require('dataconnect.php'); // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบว่ามีข้อมูล requestCode และ status ที่ส่งมาจาก AJAX
    if (isset($_POST['requestCode']) && isset($_POST['status'])) {
        $requestCode = $_POST['requestCode'];
        $status = $_POST['status'];

        // ตรวจสอบว่าเป็นการปิดงาน (status = 2) เพื่ออัปเดต CompletionDate
        if ($status == 2) {
            $completionDate = date('Y-m-d H:i:s'); // วันที่ปัจจุบัน
            $query = "UPDATE repair_requests SET StatusID = $status, CompletionDate = '$completionDate' WHERE RequestCode = $requestCode";
        } else {
            $query = "UPDATE repair_requests SET StatusID = $status WHERE RequestCode = $requestCode";
        }

        $result = mysqli_query($conn, $query);

        if ($result) {
            // อัปเดตสำเร็จ
            echo "สำเร็จ";
        } else {
            // อัปเดตล้มเหลว
            echo "error";
        }
    } else {
        // ข้อมูลไม่ครบถ้วน
        echo "ไม่มีข้อมูล";
    }
} else {
    // ไม่ใช่การร้องขอแบบ POST
    echo "คำขอไม่ถูกต้อง";
}
?>