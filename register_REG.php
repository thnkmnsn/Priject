<?php
  require('dataconnect.php');
  
  $name = $_POST['Name'];
  $surname = $_POST['Surname'];
  $email = $_POST['Email'];
  $password = $_POST['Password'];
  $phone = $_POST['Phone'];
  $address = $_POST['Address'];
  

  $sql = "INSERT INTO users (Name,Surname,Email,Password,Phone,Address)
            VALUES ('$name', '$surname', '$email', '$password', '$phone', '$address')"; // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูล

  $query = mysqli_query($conn,$sql);

  if ($query){
    echo "New record created successfully";
    header("Location: home.php");
  }else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
$conn->close();
?>
