<html>
<head>
<style>
 body {
          background-image: url("pexels-chris-goodwin-32870.jpg");
        }
    .header{
            width: 100%;
            height: 70px;
            display: block;
            background-color: steelblue;
        }
        .innerheader{
            width: 700px;
            margin: 0 auto;
            height: 100%;
            display: block;
            background-color: steelblue;
            
        }
        .cont{
            height: 100%;
            display: table;
            float: left;
          
        }
        .cont h1{
            height: 100%;
            margin: 0;
            display: table-cell;
            vertical-align: middle;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 32px;
            
        }
        .nav{
           float: right;
           height: 100%;
            
        }
        .nav a{
           float: left;
           display: table-cell;
           padding:1px 5px;
           vertical-align: center;
        }
.table td {
  border: 1px solid White;
 padding: 10px;
 }
.cart .remove {
 background: none;
 border: none;
 color: Orange;
 cursor: pointer;
 padding: 0px;
 text-decoration: underline;
 }
.cart .remove:hover {
 color: Steelblue;
 }
.table{
  border-style: solid;
            width: 60%;
            padding: 5px;
            margin-bottom: 30px;
            align-content: center;
            text-align: center;
 color: White;
 font-weight: bolder;
 background : black;
 background: linear-gradient() ;

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
$s1 = "select * from user where username = '$uname'";
$res = mysqli_query($conn, $s1);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
$name = $row["name"];

/*$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["id"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
      $status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
      }
      if(empty($_SESSION["shopping_cart"]))
      unset($_SESSION["shopping_cart"]);
      } 
}
}*/
 
/*if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['estate_id'] === $_POST["id"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}  
}*/
?>
<body>
<div class = "header">
        <div class = "innerheader">
            <div class = "cont">
            <h1>REAL ESTATE</h1> <h1> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CART </h1>
            </div>
            <ul class = "nav">
            <a><li>Logged in as <?php echo $name ?></li></a><br>
            <a href = "buyerpage.php"> <li>back</li></a>
            </ul>
        </div>
    </div>
<div class="cart">
<?php
if(!isset($_SESSION["shopping_cart"])){
  ?><script>Nothing added yet</script><?php
}
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?> 
<center> <table class="table">
<tbody>
<tr>
<td>Address</td>
<td>city</td>
<td>pincode</td>
<td>Carpet Area</td>
<td>Price</td>
<td>Contract</td>
<td>Category</td>
<td>remove</td>
<td>View more detials and purchase</td>


</tr> 
<?php 
foreach ($_SESSION["shopping_cart"] as $estate){
?>
<tr>
<td><?php echo $estate["address"]; ?></td>
<td><?php echo $estate["city"]; ?></td>
<td><?php echo $estate["pincode"]; ?></td>
<td><?php echo $estate["area"] . " sqft"; ?></td>
<td><?php echo $estate["price"] . " Rs"; ?></td>
<td><?php echo $estate["contract"]; ?></td>
<td><?php echo $estate["category"]; ?></td>
<td>
<form method='post' action='removecart.php'>
<input type='hidden' name='id' value="<?php echo $estate['estate_id']; ?>" >
<!--<input type='hidden' name='action' value="remove" />-->
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action='finalpurchase.php'>
<input type='hidden' name='id' value="<?php echo $estate['estate_id']; ?>" >
<!--<input type='hidden' name='action' value="remove" />-->
<button type='submit' class='remove'>View details/purchase</button>
</form>
</td>
</tr>
<?php
$total_price += ($estate["price"]);
}
?>
<tr>
<td colspan="5" align="left">
<strong><center>TOTAL: <?php echo "Rs ".$total_price; ?></strong></center>
</td>
</tr>
</tbody>
</table> </center>
  <?php
}else{
 ?> <script> alert("Cart is empty"); 
    window.location.replace("buyerpage.php"); </script><?php
 }
?>
</div>


</body>
</head>
</html>
