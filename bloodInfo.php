

<?php 

include_once 'config.php';
session_start();

if(isset($_SESSION['name'])){

  if($_SESSION['type'] === 'hospital'){



$bloodType = '';
$unit ='';

if(isset($_POST['unit'])){

$name = $_SESSION['name'];
$type = $_POST['bloodType'];
$unit = $_POST['unit'];

$sql = "INSERT INTO `bloodInfo`(`name`,`bloodType`, `unit`) VALUES ('$name','$type','$unit')";

if ($conn->query($sql) === TRUE) {
    header('Location:index.php');
  } else {
    echo mysqli_error($conn);
  }

$conn->close();
}

if(isset($_GET['edit'])){
  $id =  $_GET['edit'];
  $sql = "SELECT * FROM `bloodInfo` WHERE  id = '$id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
      $unit = $row['unit'];
      $id = $_GET['edit'];
      
      $conn->close();
    } else {
      echo mysqli_error($conn);
    }
}
  }else{
    header('location:index.php');
  }
}else{
  header('location:index.php');
}

?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5 pt-5">

<?php   if($unit){  ?>
  <h2 class="text-center text-info mb-5">Update Blood Info</h2>
  <?php }else{ ?>

    <h2 class="text-center text-info mb-5">Add Blood Info</h2>

  <?php } ?>

<form class="needs-validation" action="process.php" method="POST" novalidate>


        <div class="form-group">
        <label for="exampleInputEmail1">Blood Type</label>
      <select name="bloodType" id="exampleInputEmail1" class="custom-select">
        <option value="A+">A+</option>
        <option value="AB+">AB+</option>
        <option value="B+">B+</option>
        <option value="O+">O+</option>
        <option value="A-">A-</option>
        <option value="AB-">AB-</option>
        <option value="B-">B-</option>
        <option value="O-">O-</option>
      </select>
      </div>



      <div class="form-group">
            <label for="exampleInputEmail1">Total Unit</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="unit" 
                    value="<?php if($unit) echo $unit; ?>"
                   min="1" placeholder="total Unit Of blood" required>
      <div class="invalid-feedback">Enter Valid Order Unit Blood Sample </div>

         </div>

<?php   if($unit){  ?>

  <div class="form-group">
   <input type="hidden" class="form-control" id="exampleInputEmail1" name="id" value="<?php echo $id; ?>" >  
  </div>
  
  <button type="submit" name="updateBloodInfo" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Update</button>

<?php }else{ ?>
   
    <button type="submit" name="addBloodInfo" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>

<?php } ?>

 <a href="process.php?cancel=1" class="btn btn-warning " ><i class="fas fa-times"></i> Cancel</a>

  </form>
</div>

<script>
(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</body>
</html>
