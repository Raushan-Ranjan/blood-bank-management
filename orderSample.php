<?php

session_start();

if(isset($_SESSION['name'])){

  if($_SESSION['type'] === 'hospital'){

include 'config.php';

$name = $_SESSION['name'];
$email = $_SESSION['email'];

$sql = "SELECT orderSample.receiver_name, orderSample.bloodType, orderSample.unit, orderSample.receiver_email, register.phone, register.street,register.city,register.state   FROM `orderSample` INNER join register on register.email = orderSample.receiver_email where orderSample.hospital_email = '$email'"; 

$result = $conn->query($sql);
}else{
  header('Location:index.php');

}

}else{
  header('Location:index.php');

}


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="process.php?cancel=1"> <?php echo $_SESSION['name']  ?> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
    <a class="nav-link" href="bloodInfo.php">Add Blood Info</a>
    <a class="nav-item nav-link" href="orderSample.php">View Sample Request</a>
    </div>
  </div>

  <div class="navbar-nav ml-auto">
        <a class="nav-item nav-link" href="process.php?logout=1">Logout</a>
  </div>

</nav>

<section class="container mb-5">
<h3 class="text-center text-info"> Receiver Order For Blood Sample</h3>

<?php   if($result){

        if ($result->num_rows > 0) {   ?>

<table class="table">
  <thead>
    <tr>
     
      <th scope="col">Blood Type</th>
      <th scope="col">unit</th>
      <th scope="col">Receiver</th>
      <th scope="col">Receiver Email</th>
      <th scope="col">Receiver Phone</th>
      <th scope="col">Receiver Address</th>
      <th scope="col" colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php  while($row = $result->fetch_assoc()) {  ?>
    <tr>
      <td><?php echo $row['bloodType']; ?></td>
      <td><?php echo $row['unit']; ?></td>
      <td><?php echo $row['receiver_name']; ?></td>
      <td><?php echo $row['receiver_email']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td><?php echo $row['street']; ?>,<?php echo $row['city']; ?>,<?php echo $row['state']; ?></td>
      
      <td> <a href="" class="btn btn-primary">Receive Order</a> </td>
    </tr>

<?php } ?>
  
  </tbody>
</table>

<?php }else{ ?>

   <div class="alert alert-warning alert-dismissible fade show text-center mt-3" role="alert">
   <strong>No Blood Sample Order Receive</strong>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>

<?php } }?>

</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>

