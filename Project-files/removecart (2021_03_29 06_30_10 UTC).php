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


if(isset($_POST["id"]) && $_POST["id"] != ""){
if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $values) {
      if($_POST["id"] == $values['estate_id']){
        unset($_SESSION["shopping_cart"][$key]);
        ?><script> alert("Product is removed");
            window.location.replace("cart.php"); </script><?php
      }
      if(empty($_SESSION["shopping_cart"])){
      unset($_SESSION["shopping_cart"]);
      ?><script> alert("Cart is empty");
      window.location.replace("cart.php"); </script><?php
      } 
}
}
}
?>