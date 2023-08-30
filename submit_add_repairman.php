<?php
require('dataconnect.php');

// Get data from the form
$Name = $_POST['Name'];
$Surname = $_POST['Surname'];
$Phone = $_POST['Phone'];
$Email = $_POST['Email'];
$Address = $_POST['Address'];
$SpecializationID = $_POST['SpecializationID'];

// Insert data into the repairman table and get the generated RepairmanID
$query1 = "INSERT INTO repairman (Name, Surname, Phone, Email, Address) VALUES ('$Name', '$Surname', '$Phone', '$Email', '$Address')";
mysqli_query($conn, $query1);
$RepairmanID = mysqli_insert_id($conn);

// Insert data into the repairman_specialization table using the generated RepairmanID
$query2 = "INSERT INTO repairman_specialization (RepairmanID, SpecializationID) VALUES ('$RepairmanID', '$SpecializationID')";

if (mysqli_query($conn, $query2)) {
    echo "Repairman added successfully.";
    header("Location: managerepairman.php");
}else{
    echo "<script>alert('Error! Please try again ');</script>";
     // if not match, display error message
    
    header( "refresh:0.5;url=addrepairman.php" ); // redirect back to login page after 3 seconds
}
mysqli_close($conn);
?>