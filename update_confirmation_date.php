<?php
  require('dataconnect.php'); //connect to database

  $request_id = $_POST['request_id'];
  $confirmation_date = $_POST['confirmation_date'];

  $query = "UPDATE repair_requests SET ConfirmationDate='$confirmation_date' WHERE RequestID='$request_id'";
  mysqli_query($conn, $query);
?>