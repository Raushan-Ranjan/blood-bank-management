<?php
    include_once 'config.php';
    session_start();


if(isset($_POST['addBloodInfo'])){
  
  $name = $_SESSION['name'];
  $type = $_POST['bloodType'];
  $unit = $_POST['unit'];
  
  $sql = "INSERT INTO `bloodInfo`(`name`,`bloodType`, `unit`) VALUES ('$name','$type','$unit')";
  
  if ($conn->query($sql) === TRUE) {
     $conn->close();
     $_SESSION['success'] = "Blood Sample Info Added SuccessFully";
      header('Location:hospitalDashboard.php');
    } else {
      echo mysqli_error($conn);
    }

}

if(isset($_POST['updateBloodInfo'])){
  
    $name = $_SESSION['name'];
    $id = $_POST['id'];
    $type = $_POST['bloodType'];
    $unit = $_POST['unit'];
    
    $sql = "UPDATE `bloodInfo` SET `bloodType`= '$type',`unit`= '$unit' WHERE `id` = '$id'";
    
    if ($conn->query($sql) === TRUE) {
       $conn->close();
       $_SESSION['success'] = "Blood Sample Info Updated SuccessFully";
        header('Location:hospitalDashboard.php');
      } else {
        echo mysqli_error($conn);
      }
  
  }

if(isset($_GET['delete'])){
    $id =  $_GET['delete'];
    $sql = "DELETE FROM `bloodInfo` WHERE  id = '$id'";
   

    if ($conn->query($sql) === TRUE) {
        $conn->close();
       $_SESSION['success'] = "Blood Sample Info Deleated SuccessFully";
        header('Location:hospitalDashboard.php');
      } else {
        echo mysqli_error($conn);
      }
    
}

if(isset($_GET['logout'])){
 
  session_destroy();
  header('Location:index.php');
  
  
}


if(isset($_GET['login'])){
 
  header('Location:index.php');
  
}

if(isset($_GET['cancel'])){
 
  header('Location:hospitalDashboard.php');
  
}

if(isset($_GET['hospital'])){
 
  header('Location:hospital.php');
  
}

if(isset($_GET['receiver'])){
 
  header('Location:receiver.php');
  
}


