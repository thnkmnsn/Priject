<?php
session_start(); //start session to save admin id
require('dataconnect.php'); //connect to database

if(isset($_POST['username']) && isset($_POST['password'])){ // check if the form is submitted
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // prepare and bind sql statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, "SELECT * FROM administrators WHERE Name = ? AND Password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) == 1){ // if there is a match,
        $row = mysqli_fetch_assoc($result);
        $_SESSION['AdminID'] = $row['AdminID']; // save admin id in session
        $_SESSION['Email'] = $row['Email']; // save admin email in session
        header("Location: adminpage.php"); // redirect to adminpage
    }else{
        echo "Login Error!"; // if not match, display error message
    }
}
?>