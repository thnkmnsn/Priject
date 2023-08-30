<?php
session_start();
require('dataconnect.php');

// Check if Request Code is set and valid
if (isset($_GET['id'])) {
    $RequestCode = $_GET['id'];

    // Check if Request Code exists in repair_requests table
    $check_request = "SELECT RequestCode FROM repair_requests WHERE RequestCode = '$RequestCode'";
    $result_check = mysqli_query($conn, $check_request);
    if (mysqli_num_rows($result_check) == 0) {
        echo "Invalid Request Code";
        exit();
    }

    // Display confirmation message before deleting
    if(isset($_GET['confirmed'])) {
        $confirmed = $_GET['confirmed'];
        if($confirmed == 'true') {
            $query = "DELETE FROM repair_requests WHERE RequestCode = '$RequestCode'";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Repair request deleted successfully.');</script>";
            } else {
                echo "<script>alert('Error deleting repair request: ".mysqli_error($conn)."');</script>";
            }
            header("refresh:0.5;url=manage_repairrequests.php");
        } else {
            echo "<script>
                    if(confirm('Are you sure you want to delete this repair request?')){
                        window.location.href='deleteRequest.php?id=".$RequestCode."&confirmed=true';
                    } else {
                        window.location.href='manage_repairrequests.php';
                    }
                </script>";
        }
    } else {
        echo "<script>
                if(confirm('Are you sure you want to delete this repair request?')){
                    window.location.href='deleteRequest.php?id=".$RequestCode."&confirmed=true';
                } else {
                    window.location.href='manage_repairrequests.php';
                }
            </script>";
    }
} else {
    echo "Invalid Request Code";
}

mysqli_close($conn);
?>