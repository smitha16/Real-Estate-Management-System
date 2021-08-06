<?php

session_start();

$luname = "";
$lpass = "";
$radio = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "real_estate";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn === false) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['lusername'])) {
    $luname = $_POST['lusername'];
  }
if (isset($_POST['lpassword'])) {
    $lpass = $_POST['lpassword']; 
  }
  if (isset($_POST['usertype'])) {
    $radio = $_POST['usertype']; 
  }
  
  $s1 = "select * from user where username = '$luname' && password = '$lpass'";
  $res = mysqli_query($conn, $s1);
  $n = mysqli_num_rows($res);
  if($n == 0){ ?>
    <script type="text/javascript">
    alert("Incorrect login ID or password"); 
    window.history.back();
    </script>
  <?php }
  else{
    $_SESSION["uname"] = $luname;
    if($radio == "seller")
      header("location: sellerpage.php");
    else{
      header("location: buyerpage.php");
    }
  }

?>