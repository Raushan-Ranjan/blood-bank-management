<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "bloodBank";
$port=3306;

$conn =  mysqli_connect($servername, $username, $password,$db,$port);

if (!$conn) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE table if not EXISTS register (name VARCHAR (100) , type varchar(10) ,bloodType varchar(4),email varchar(30) PRIMARY KEY , phone VARCHAR (13),street VARCHAR (255),city VARCHAR (50),state VARCHAR (50),pin VARCHAR (10),password VARCHAR (255))";

if($conn->query($sql)){
  $sql = "CREATE table if not EXISTS bloodInfo (id int(4) PRIMARY KEY AUTO_INCREMENT, name VARCHAR (100),bloodType varchar(10),unit varchar(5))";
  
  if($conn->query($sql)){

    $hidden_sql = "CREATE table if not EXISTS orderSample (id int(4) PRIMARY KEY,hospital_name VARCHAR (100),receiver_name VARCHAR (100),bloodType varchar(10),unit varchar(5),receiver_email varchar(100),hospital_email varchar(100))";
 
    if(!$conn->query($hidden_sql)){
      echo "table not  created successfully" . mysqli_error($conn);
    }
  
  }else{
    echo "table not  created successfully" . mysqli_error($conn);
    
  }

}else{
  echo "table not  created successfully" . mysqli_error($conn);
  
}

?>