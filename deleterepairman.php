<?php
require('dataconnect.php');

$id = $_GET["id"];

//Delete related data from repairman_specialization table
$delete_related = "DELETE FROM repairman_specialization WHERE RepairmanID = '$id'";
mysqli_query($conn, $delete_related);

//Delete repairman data
$sql = "DELETE FROM repairman WHERE RepairmanID = '$id'";
$query = mysqli_query($conn, $sql);

// Check if the query was successful
if($query){
    // If successful, show a success message and redirect to the managerepairman.php page
    echo "<script>
    alert('Delete Data OK! ลบข้อมูลเรียบร้อยแล้ว');
    window.location.replace('managerepairman.php');
    </script>";
}else{
    // If not successful, show an error message and redirect back to the previous page
    echo "<script>
    alert('Delete Data Error! ลบข้อมูลไม่สำเร็จ');
    window.history.back();
    </script>";
}

// Close the connection
mysqli_close($conn);
?>