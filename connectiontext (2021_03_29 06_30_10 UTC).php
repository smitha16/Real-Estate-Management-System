<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "real_estate";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn === false) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['name'])) {
  $name = $_POST['name'];
}
if (isset($_POST['username'])) {
  $uname = $_POST['username'];
}
if (isset($_POST['password'])) {
  $pass = $_POST['password'];
}
if (isset($_POST['confirm_password'])) {
  $cpass = $_POST['confirm_password'];
}
if (isset($_POST['email'])) {
  $email = $_POST['email'];
}
if (isset($_POST['phone'])) {
  $ph = $_POST['phone'];
}
  
$s = "select * from user where username = '$uname'";
$res = mysqli_query($conn, $s);
$n = mysqli_num_rows($res);

$s1 = "select * from user where email = '$email'";
$res1 = mysqli_query($conn, $s1);
$n1 = mysqli_num_rows($res1);

$s2 = "select * from user where phone = '$ph'";
$res2 = mysqli_query($conn, $s2);
$n2 = mysqli_num_rows($res2);

if( $n == 1){ ?>
  <script type="text/javascript">
        alert("Username already taken"); 
        window.history.back();
   </script> 
<?php }  
elseif ($n1 == 1 || $n2 == 1) { ?>
  <script type="text/javascript">
        alert("email or phone already exists, kindly login."); 
        window.history.back();
   </script> 
<?php }
elseif(strlen($ph) != 10){ ?>
  <script type="text/javascript">
        alert("Enter a 10 digit phone number."); 
        window.history.back();
   </script> 
<?php
}
else {
  if($pass != $cpass){ ?>
   <script type="text/javascript">
        alert("Passwords do not match"); 
        window.history.back();
   </script>
  <?php }
  else{
    //$sql = "INSERT INTO user (name, username, password, email, phone) VALUES ('$name', '$uname', '$pass', '$email', '$ph')";
    $sql6 = "CALL insertuser('$name', '$uname', '$pass', '$email', '$ph')";
    mysqli_query($conn, $sql6);
    ?> <script> 
    alert("Successfully inserted");
    window.location.replace("loginpage.php"); </script> <?php
  }
}
die();
mysqli_close($conn);
?>

