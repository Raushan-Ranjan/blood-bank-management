<?php

session_start();

include 'config.php';



if(isset($_GET['email'])){

$id = $_GET['id'];
$_SESSION['order_email']= $_GET['email'];
$_SESSION['order_id'] = $id;

$sql = "SELECT * FROM `bloodInfo` where id = '$id'";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

$_SESSION['order_name'] = $row['name'];


}

if(isset($_POST['bloodType']) && isset($_POST['unit'])){


  $bloodType = $_POST['bloodType'];
  $id = $_SESSION['order_id'];
  $unit = $_POST['unit'];
  $name = $_SESSION['order_name'];
  $receiver_name = $_SESSION['name'];
  $remail = $_SESSION['email_'];
  $hemail = $_SESSION['order_email'];

  $hidden_sql = "INSERT INTO `orderSample`(`id`,`hospital_name`,`receiver_name`,`bloodType`, `unit`,`receiver_email`,`hospital_email`) VALUES ('$id','$name','$receiver_name','$bloodType','$unit','$remail','$hemail')";

  if ($conn->query($hidden_sql) === TRUE) {
      $_SESSION['success'] = "Your Blood Sample Is Successfully Order";
      header('Location:bloodSample.php');

   } else {
    $_SESSION['success'] = "This Blood Sample Is Already Ordered.";
    header('Location:bloodSample.php');
   }

}





?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">

  <h2 class="text-center text-secondary">Order Blood Sample</h2>

<form class="needs-validation" action="orderPage.php" method="POST" novalidate>

  
        <div class="form-group">
            <label for="exampleInputEmail1">Blood Type</label>
            <input type="text" class="form-control" name="bloodType" value="<?php echo $row['bloodType']; ?>" readonly>
         </div>

      <div class="form-group">
            <label for="exampleInputEmail1">Unit</label>
            <input type="number" class="form-control" id="exampleInputEmail1" min="1" max="<?php echo $row['unit']; ?>" name="unit" placeholder="order blood Unit must be less than <?php echo $row['unit']; ?>" required>
      <div class="invalid-feedback">Enter Valid Order Unit Blood Sample </div>
         
         </div>

   
    <button type="submit" class="btn btn-primary">Order</button>
   
    <a href="bloodSample.php" class="btn btn-info">Cancel</a>
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