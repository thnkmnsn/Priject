<?php
  require('dataconnect.php');

  $deviceid = $_POST['DeviceID'];
  $devicetype = $_POST['DeviceType'];
  $devicemodel = $_POST['DeviceModel'];
  $serialnumber = $_POST['SerialNumber'];
  $manufacturer = $_POST['Manufacturer'];
  $dateofpurchase = $_POST['DateOfPurchase'];
  $warrantyexpirationdate = $_POST['WarrantyExpirationDate'];
  $problemdetails = $_POST['ProblemDetails'];
  $userid = $_POST['UserID'];

  // check if the device already exists in the equipment table
  $check_query = "SELECT DeviceID FROM equipment WHERE DeviceID = '$deviceid'";
  $check_result = mysqli_query($conn, $check_query);

  // if the device does not exist, insert the data into both tables
  if (mysqli_num_rows($check_result) == 0) {
    $equipment_query = "INSERT INTO equipment (DeviceID, DeviceType, DeviceModel, SerialNumber, Manufacturer, DateOfPurchase, WarrantyExpirationDate) VALUES ('$deviceid', '$devicetype', '$devicemodel', '$serialnumber', '$manufacturer', '$dateofpurchase', '$warrantyexpirationdate')";
    $equipment_result = mysqli_query($conn, $equipment_query);
    $request_query = "INSERT INTO repair_requests (DeviceID, ProblemDetails, UserID) VALUES ('$deviceid', '$problemdetails', '$userid')";
    $request_result = mysqli_query($conn, $request_query);
    
    if ($equipment_result && $request_result) {
      echo "Data saved to both tables successfully."."<br>"."บันทึกข้อมูลลงเรียบร้อยแล้ว";
      header("Location: status.html");
    } else {
      echo "Error: " . $conn->error;
    }
  } else {
    echo "Device already exists in the equipment table."."<br>"."มีอุปกรณ์นี้รอซ่อมอยู่แล้ว";
    header("Location: request_repair.php");
    }
    $conn->close();
?>
<!-- <?php
  require('dataconnect.php');
  
  $deviceid = $_POST ['DeviceID'];
  $devicename = $_POST['DeviceName'];
  $devicetype = $_POST['DeviceType'];
  $devicemodel = $_POST['DeviceModel'];
  $serialnumber = $_POST['SerialNumber'];
  $manufacturer = $_POST['Manufacturer'];
  $dateofpurchase = $_POST['DateOfPurchase'];
  $warrantyexpirationdate = $_POST['WarrantyExpirationDate'];
  $problemdetails = $_POST['ProblemDetails'];
//   $deliverydate = $_POST['DeliveryDate'];
//   $completiondate = $_POST['CompletionDate'];
//   $repairmanid = $_POST['RepairanID'];
//   $requestcode = $_POST['RequestCode'];
//   $userid = $_POST['UserID'];
  
    $sql2 = "INSERT INTO equipment (DeviceID,DeviceName,DeviceType,DeviceModel,SerialNumber,Manufacturer,DateOfPurchase,WarrantyExpirationDate) VALUES ('$deviceid','$devicename','$devicetype','$devicemodel','$serialnumber','$manufacturer','$dateofpurchase','$warrantyexpirationdate')";
    $query2 = mysqli_query($conn,$sql2);
  // check if the device already exists in the equipment table
  $check_query = "SELECT DeviceID FROM equipment WHERE DeviceID = '$deviceid'";
  $check_result = mysqli_query($conn, $check_query);

  // if the device does not exist, insert the data into both tables
  if (mysqli_num_rows($check_result) == 0) {
    $sql = "INSERT INTO repair_requests (DeviceID,ProblemDetails) VALUES ('$deviceid','$problemdetails')";
    $query = mysqli_query($conn,$sql);
  
  
    if ($query && $query2){
      echo "Data saved to both tables successfully."."<br>"."บันทึกข้อมูลลงเรียบร้อยแล้ว";
      header("Location: status.html");
    }else{
      echo "Error: " . $conn->error;
    }
  } else {
    echo "Device already exists in the equipment table."."<br>"."มีอุปกรณ์นี้รอซ่อมอยู่แล้ว";
    header("Location: request_repair.php");
  }
  $conn->close();
?> -->