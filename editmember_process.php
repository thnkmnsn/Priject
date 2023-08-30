<?php
require('dataconnect.php'); // connect to database

// check if form is submitted
if(isset($_POST['submit'])){
    // get form data
    $userid = $_POST['userid'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    // update user information in database
    $query = "UPDATE users SET Name='$name', Surname='$surname', Email='$email', Phone='$phone', Address='$address' WHERE UserID=$userid";
    $result = mysqli_query($conn, $query);
    if($result){
        // redirect to managemembers page after successful update
        header('Location: managemembers.php');
        exit;
    }
}
?>