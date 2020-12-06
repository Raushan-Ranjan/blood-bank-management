
<?php 

  include_once 'config.php';
  session_start();

if(isset($_POST['rname'])){
  

$rname = trim($_POST['rname']);
$type = trim($_POST['type']);
$email = trim($_POST['email']);
$bloodType = trim($_POST['bloodType']);
$phone = trim($_POST['phone']);
$street = trim($_POST['street']);
$city = trim($_POST['city']);
$state = trim($_POST['state']);
$pin = trim($_POST['pin']);
$password = $_POST['password'];
$hash = password_hash($password,PASSWORD_BCRYPT);

$sql = "INSERT INTO `register`(`name`,`type`,`bloodType`, `email`, `phone`,`street`,`city`,`state`,`pin`,`password`) VALUES ('$rname','$type','$bloodType','$email','$phone','$street','$city','$state','$pin','$hash')";

if ($conn->query($sql) === TRUE) {

  unset($_SESSION['error']);
  $_SESSION['success'] = "Successfully Register,Login Here!";
  header('Location:index.php');

} else {
    $_SESSION['error'] = "Email Id already EXIST,Try with Other to Register.";

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
</head>
<body>

<div class="container mt-5 pt-5">

<?php  if(isset($_SESSION['error'])){   ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><?php echo $_SESSION['error']; ?> </strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>

  <h2 class="text-center text-info mb-5"><i class="fas fa-heartbeat"></i> Registration Form For Blood Receiver <i class="fas fa-heartbeat"></i></h2>

<form class="needs-validation" action="receiver.php" method="POST" novalidate>

      <div class="row">
        <div class="form-group col-6">
            <label for="exampleInputEmail1">Receiver Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="rname" placeholder="Enter Your Name" required>
            <div class="invalid-feedback">Name Field is required.</div>
         </div>

        <div class="form-group col-6">
            <label for="exampleInputEmail1">Register as Receiver</label>
      <select name="type" id="exampleInputEmail1" class="custom-select">
        <option value="receiver">Receiver</option>
      </select>
      </div>

  </div>

      <div class="row">
            <div class="form-group col-6">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter Email Id" required>
            <div class="invalid-feedback">Please Enter Valid Email.</div>
          </div>

          <div class="form-group col-6">
            <label for="exampleInputEmail1">Phone Number</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="phone" minlength="10" maxlength="10" placeholder="Enter 10 digit Phone Number" required>
            <div class="invalid-feedback">Enter Valid 10 Digit Phone Number.</div>
          </div>
      </div>

      <div class="row">
        <div class="form-group col-6">
            <label for="exampleInputEmail1">Street Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="street" placeholder="Enter Street Name" required>
            <div class="invalid-feedback">Street Field is required.</div>
      </div>

      <div class="form-group col-6">
        <label for="exampleInputEmail1">City Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="city" placeholder="Enter City Name" required>
        <div class="invalid-feedback">City Field is required.</div>
      </div>
  </div>

  <div class="row">
    <div class="form-group col-6">
        <label for="exampleInputEmail1">State Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="state" placeholder="Enter State Name" required>
        <div class="invalid-feedback">State Field is required.</div>
  </div>

  <div class="form-group col-6">
    <label for="exampleInputEmail1">Pin Code</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="pin" placeholder="Enter Pin Code" required>
    <div class="invalid-feedback">Pin Code Field is required.</div>
  </div>
</div>


<div class="row">
    <div class="form-group col-6">
    <label for="exampleInputEmail1">Your Blood Group</label>
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
  <div class="form-group col-6">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
      <div class="invalid-feedback">Password Can't be empty</div>
    </div>
</div>

<div class="row">
     <div class="col-md-12 col-xl-6 mb-3">
    <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
     </div>

     <div class="col-md-12 col-xl-6 mb-3">
     <a href="process.php?login=1" class="btn btn-secondary btn-lg btn-block"><i class="fas fa-backward"></i>   Already have account,Login Here</a>
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
