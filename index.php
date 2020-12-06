<?php 

include 'config.php';

session_start();

if(isset($_POST['uname'])){
  
$uname = trim($_POST['uname']);
$type = $_POST['type'];
$password = $_POST['password'];


$sql = "SELECT * FROM `register` WHERE `email` = '$uname' AND `type` = '$type'";  
$result = $conn->query($sql);
if($result){
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();

  if(password_verify($password, $row['password'])){

    $_SESSION['name'] = $row['name'];
    $_SESSION['success'] = "Welcome";
    
    if($type === "hospital"){
    
     $_SESSION['type'] = $type;
     $_SESSION['email'] = $row['email'];
     
  
     header('Location:hospitalDashboard.php');
  
    }else{
      
      $_SESSION['bloodType'] = $row['bloodType'];
      $_SESSION['login'] = true;
      $_SESSION['email_'] = $row['email'];
      
     header('Location:bloodSample.php');
  
    }
  }else {
    $_SESSION['success'] = "Invalid UserName OR Password";
}

}else{
  $_SESSION['success'] = "Invalid UserName OR Password";
}
}else{
  $_SESSION['success'] = "Internal Error Occured";

}


$conn->close();
}

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
.view{
top:5px;
right:5px;
}
</style>
</head>
<body>

<div class="d-flex flex-row-reverse bd-highlight">
  <a href="bloodSample.php" class="btn btn-outline-dark mt-4 mr-4"><i class="fas fa-hand-holding-water"></i> See Available Blood Sample <i class="fas fa-hand-holding-water"></i> <i class="fas fa-hand-holding-water"></i></a>
</div>


<div class="container mt-5 pt-5">

<?php  if(isset($_SESSION['success'])){   ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><?php echo $_SESSION['success']; ?> </strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>

  <h2 class="text-center text-info mb-5"><i class="fas fa-sign-in-alt"></i> Login As</h2>

<form class="needs-validation" action="index.php" method="POST" novalidate>

  
        <div class="form-group">
            <label for="exampleInputEmail1">User Name</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="uname" placeholder="Enter Email Id as User Name" required>
            <div class="invalid-feedback">Please Enter Valid Email.</div>
         </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Login as</label>
      <select name="type" id="exampleInputEmail1" class="custom-select">
        <option value="hospital">Hospital</option>
        <option value="receiver">Receiver</option>
      </select>
      </div>

      <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" class="form-control" id="exampleInputEmail1" name="password" placeholder="Enter Password" required>
            <div class="invalid-feedback">Password Can't Be Empty</div>
         </div>

   <div class="row">
     <div class="col-md-12 col-xl-4 mb-3">
    <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
     </div>

     <div class="col-md-12 col-xl-4 mb-3">
    <a href="process.php?hospital=1" class="btn btn-secondary btn-lg btn-block">New One, Register as a Hospital</a>
     </div>

     <div class="col-md-12 col-xl-4 mb-3">
    <a href="process.php?receiver=1" class="btn btn-secondary btn-lg btn-block">New One, Register as a Receiver</a>
     </div>

   </div>

   
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
