<html>
<head>
</head>
<style>
.product_wrapper {
 float:left;
 padding: 10px;
 text-align: center;
 }
.product_wrapper:hover {
 box-shadow: 0 0 0 2px #e5e5e5;
 cursor:pointer;
 }
.product_wrapper .name {
 font-weight:bold;
 }
.product_wrapper .buy {
 text-transform: uppercase;
 background: #F68B1E;
 border: 1px solid #F68B1E;
 cursor: pointer;
 color: #fff;
 padding: 8px 40px;
 margin-top: 10px;
}
.product_wrapper .buy:hover {
 background: #f17e0a;
 border-color: #f17e0a;
}
.message_box .box{
 margin: 10px 0px;
 border: 1px solid #2b772e;
 text-align: center;
 font-weight: bold;
 color: #2b772e;
 }
.table td {
 border-bottom: #F0F0F0 1px solid;
 padding: 10px;
 }
.cart_div {
 float:right;
 font-weight:bold;
 position:relative;
 }
.cart_div a {
 color:#000;
 } 
.cart_div span {
 font-size: 12px;
 line-height: 14px;
 background: #F68B1E;
 padding: 2px;
 border: 2px solid #fff;
 border-radius: 50%;
 position: absolute;
 top: -1px;
 left: 13px;
 color: #fff;
 width: 20px;
 height: 20px;
 text-align: center;
 }
.cart .remove {
 background: none;
 border: none;
 color: #0067ab;
 cursor: pointer;
 padding: 0px;
 }
.cart .remove:hover {
 text-decoration:underline;
 }
 </style>



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

if(isset($_SESSION["uname"])){
    $uname = $_SESSION["uname"];
}

$n=0;
if (isset($_POST['id']) && $_POST['id']!=""){
$id = $_POST['id'];
$result = mysqli_query($conn, "SELECT * FROM estate WHERE estate_id ='$id'");
$row = mysqli_fetch_assoc($result);
$address = $row['address'];
$city = $row['city'];
$pin = $row['pincode'];
$con = $row['contract'];
$price = $row['price'];
$area = $row['sqfoot'];
$cat = $row['category'];
 
$cartArray = array(
 $id=>array(
 'address'=>$address,
 'estate_id'=>$id,
 'price'=>$price,
 'category'=>$cat,
 'contract'=>$con,
 'pincode'=>$pin,
 'city'=>$city,
 'area'=>$area,
 )
);

if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray; ?>
    <script> alert("Product is added to your cart!");
    window.location.replace("buyerupdate.php");</script><?php
} 
else{
    foreach($_SESSION["shopping_cart"] as $key => $values) {
        if($_POST["id"] == $values['estate_id']){
            $n = 1;
          ?><script> alert("Product already exists");
              window.location.replace("buyerupdate.php"); </script><?php
        }
    }
    /*$array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($id,$array_keys)) { ?>
        <script> alert("Product already exists in your cart!");
        window.location.replace("buyerupdate.php");</script><?php
    }
    else{*/
        if($n == 0){
        $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray); ?>
        <script> alert("Product is added to your cart!");
        window.location.replace("buyerupdate.php");</script><?php
        }
    //}
 
 }
}
//header("location: buyerupdate.php");
?>
</html>

