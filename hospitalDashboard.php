<?php

session_start();
include 'config.php';


if(isset($_SESSION['name'])){

if($_SESSION['type'] === 'hospital'){


$name = $_SESSION['name'];

$sql = "SELECT * FROM `bloodInfo` WHERE `name` = '$name'";  

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="process.php?cancel=1"><?php echo $_SESSION['name']  ?> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
    <a class="nav-item nav-link" href="bloodInfo.php"><i class="fas fa-plus-square"></i> Add Blood Info</a>
    <a class="nav-item nav-link" href="orderSample.php"><i class="fas fa-binoculars"></i> View Sample Request</a>

    </div>
  </div>

  <div class="navbar-nav ml-auto">
  <a class="nav-item nav-link ml-auto" href="process.php?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

</nav>



<section class="container mt-5">

<?php  if(isset($_SESSION['success'])){   ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><?php echo $_SESSION['success']; ?> </strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>

<?php  


if ($result->num_rows > 0) {

?>

<table class="table">
  <thead>
    <tr>
     
      <th scope="col">Blood Type</th>
      <th scope="col">unit</th>
      <th scope="col" colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php 

while($row = $result->fetch_assoc()) {

  ?>
    <tr>
      <td><?php echo $row['bloodType']; ?></td>
      <td><?php echo $row['unit']; ?></td>
      <td> 
      <a href="bloodInfo.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
      <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
      </td>
    </tr>

<?php } ?>
  
  </tbody>
</table>

<?php }else{ ?>
  
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>No Blood Sample Added Yet</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    
  <?php } ?>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</section>
</body>
</html>

