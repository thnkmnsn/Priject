<?php
require('dataconnect.php'); //connect to database

$request_id = $_POST['request_id'];
$confirmation_status = $_POST['confirmation_status'];

$query = "UPDATE repair_requests SET ConfirmationStatus='$confirmation_status' WHERE RequestID='$request_id'";
$result = mysqli_query($conn, $query);

if ($result) {
  echo "Confirmation status updated successfully";
} else {
  echo "Error updating confirmation status: " . mysqli_error($conn);
}
mysqli_close($conn);
?>