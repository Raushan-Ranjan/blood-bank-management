<?php

session_start();

include 'config.php';

$sql = "SELECT * FROM `bloodInfo`";  
$result = $conn->query($sql);

if(isset($_SESSION['name']) && isset($_SESSION['login'])){

$name = $_SESSION['name'];
$bloodType = $_SESSION['bloodType'];

$sql = "SELECT bloodInfo.id, bloodInfo.bloodType as bloodType,bloodInfo.name as name,register.street,bloodInfo.unit,register.phone, register.email,register.city,register.state FROM `bloodInfo` inner join register on bloodInfo.name = register.name where bloodInfo.bloodType = '$bloodType' ORDER BY `name` ASC, `bloodType` ASC ";

$result = $conn->query($sql);

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
  <a class="navbar-brand" href="#">  <?php if(isset($_SESSION['login'])){ echo $_SESSION['name']; } else { echo "User"; } ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-nav ml-auto">
     

      <?php if(isset($_SESSION['login'])){ ?>
      <a class="nav-item nav-link" href="process.php?logout=1"> <i class="fas fa-sign-out-alt"></i> LogOut</a>
      <?php }else{ ?>
       <a class="nav-item nav-link" href="process.php?login=1"><i class="fas fa-sign-in-alt"></i> LogIn</a>
      <?php } ?>


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

<?php if($result){ 

   if(isset($_SESSION['login'])){  ?>
      <h3 class="text-info text-center mb-4">Showing Blood Sample According to Your Preference</h3>
      <?php }else{ ?>
      <h3 class="text-info text-center mb-4"> Showing All Available Blood Sample</h3>
      <?php } 

 if ($result->num_rows > 0) {  ?>

<table class="table">
  <thead>
    <tr>
     
      <th scope="col">Blood Type</th>
      <th scope="col">unit</th>
      <th scope="col">Hospital Name</th>

      <?php if(isset($_SESSION['login'])){ ?>
      <th scope="col">Phone Number</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <?php } ?>

      <th scope="col">Order For Sample</th>
    </tr>
  </thead>
  <tbody>

  <?php   while($row = $result->fetch_assoc()) {  ?>

    <tr>   
      <td><?php echo $row['bloodType']; ?></td>
      <td><?php echo $row['unit']; ?></td>
      <td> <?php echo $row['name']; ?></td>
      
      <?php if(isset($_SESSION['login'])){ ?>
      <td>   <?php echo $row['phone']; ?></td>
   
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['street']; ?>,<?php echo $row['city']; ?>,<?php echo $row['state']; ?></td>
      <?php } ?>

      <td> 

      <?php if(isset($_SESSION['login'])){  ?>
        <a href="orderPage.php?id=<?php echo $row['id']; ?>&email=<?php echo $row['email']; ?>" class="btn btn-primary"><i class="fas fa-tint"></i> Request Sample <i class="fas fa-tint"></i></a>

      <?php }else{ ?>
        <a href="process.php?login=1" class="btn btn-warning"><i class="fas fa-tint"></i> Order Sample Blood <i class="fas fa-tint"></i></a>
      <?php } ?>
      
      </td>
      </form>
    </tr>

<?php } ?>


  </tbody>
</table>

<?php }else{ ?> 

<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
    <strong>No Blood Sample Added Yet</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

 <?php } }else{
   echo mysqli_error($conn);
 } ?> 

</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>