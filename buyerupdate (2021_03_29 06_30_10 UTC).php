<html>
<head>
<style>
 body {
            margin: 0;
            padding: 0;
            background-image: url("pexels-chris-goodwin-32870.jpg");
            background-size: cover;
        }
     a {
            text-decoration: bolder;
            font-size: 20px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: white;
        }
        .loginbox a:hover {
            cursor: pointer;
            color: Orange;
        }
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', 'sans-serif';
            background-color: Black;
            color: White;
        }
        label[for = "header"]{
            height:auto;
            width: 70px;
            background: Black;
            color: White;
            Padding: 0 0 20px;
            font-size:25px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight:bold;
            position: relative;

        }
        
        .price {
            color: White;
            font-size: 22px;
        }
        table {
            border-style: groove;
            width: 60%;
            padding: 5px;
            margin-bottom: 30px;
            align-content: center;
            text-align: center;
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
           padding:1px 3px;
           /*vertical-align: center;*/
           font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
           font-size: 15px;

        }
        
        /*.card button {
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
        
        .card button:hover {
            opacity: 0.7;
        }*/
        .card input [type = "submit"]{
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color: Steelblue;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
        .card input [type = "submit"]:hover {
            opacity: 0.7;
        }
    </style>
</head>
<body>
<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "real_estate";
$dur = "";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn === false) {
  die("Connection failed: " . $conn->connect_error);
}


if(isset($_SESSION["uname"]))
{
    $uname = $_SESSION["uname"];
}
$s = "select * from user where username = '$uname'";
$res = mysqli_query($conn, $s);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
$name = $row["name"];

$s1 = "SELECT * FROM estate where (status = 'not_sold' and username != '$uname')";
if (isset($_POST['type'])){
    $cat = $_POST['type'];
    $_SESSION['type'] = $cat;
}

if (isset($_SESSION['type'])) {
    $cat = $_SESSION['type'];
    $s1 .= " AND category = '$cat'";
}

if (isset($_POST['contract']) && $_POST['contract'] != NULL){
    $con = $_POST['contract'];
    $_SESSION['contract'] = $con;  
}
if (isset($_SESSION['contract'])) {
    $con = $_SESSION['contract'];
    $s1 .= " AND contract = '$con'"; 
}

if (isset($_POST['address']) && $_POST['address'] != NULL) {
    $address = $_POST['address'];
    $_SESSION['address'] = $address;
}
if (isset($_SESSION['address'])) {
    $address = $_SESSION['address'];
}

if (isset($_POST['pincode']) && $_POST['pincode'] != NULL) {
    $pincode = $_POST['pincode'];
    $_SESSION['pincode'] = $pincode; 
}
if (isset($_SESSION['pincode'])) {
    $pincode = $_SESSION['pincode'];
    $s1 .= " AND pincode ='$pincode'";
}
if (isset($_POST['city']) && $_POST['city'] != NULL) {
    $city = $_POST['city'];
    $_SESSION['city'] = $city;
}
if (isset($_SESSION['city'])) {
    $city = $_SESSION['city'];
    $s1 .= " AND city ='$city'";
}

if (isset($_POST['sq']) && $_POST['sq'] != NULL) {
    $area = $_POST['sq'];
    $_SESSION['sq'] = $area;
}
if (isset($_SESSION['sq'])) {
    $area = $_SESSION['sq'];
    $s1 .= " AND sqfoot between 0 and '$area'";
}

if (isset($_POST['pr']) && $_POST['pr'] != NULL) {
    $price = $_POST['pr'];
    $_SESSION['pr'] = $price;
}
if (isset($_SESSION['pr'])) {
    $price = $_SESSION['pr'];
    $s1 .= " AND price between 0 and '$price'";
}

?>
<body>
    <div class = "header">
        <div class = "innerheader">
            <div class = "cont">
            <h1>REAL ESTATE</h1> <h1> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Real Estate Entries:</h1>
            </div>
            <ul class = "nav">
            <a><li>Logged in as <?php echo $name ?></li></a><br>
            <a href = "buyerpage.php"> <li>back</li></a>
            </ul>
        </div>
    </div>
</body>
<?php

$res1 = mysqli_query($conn, $s1);
$n1 = mysqli_num_rows($res1);
if($n1 == 0) 
{?>
    <script type="text/javascript">
        alert("No Match"); 
        window.location.replace("buyerpage.php");
    </script><?php
}

while($row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC)){ 
    $id = $row1['estate_id'];
    $username = $row1['username'];
    $_SESSION["id"] = $id;
    echo "<div class='card'>";
    //echo "<img src='/w3images/jeans3.jpg' style='width:100%'>";
    echo "<h1>" . "<center>" . $row1["category"] . " for " . $row1["contract"]  . "</center>" . "</h1>";
    echo "<p class='price'>". $row1["price"] . " Rs   " . $row1["sqfoot"] . " sqft " . "</p>";
    if($row1['contract'] == "lease"){
        $q = "SELECT duration from lease where estate_id = '$id'";
        $row2 = mysqli_fetch_array(mysqli_query($conn, $q), MYSQLI_ASSOC);
        echo "<p>" . "Lease Duration: ".  $row2["duration"] . "</p>";
    }
    if($row1['category'] == "residential"){
        $q = "SELECT * from residential where estate_id = '$id'";
        $row2 = mysqli_fetch_array(mysqli_query($conn, $q), MYSQLI_ASSOC);
        echo "<p>" . "Number of Rooms: ".  $row2["rooms"] . ",  Furnished: ".  $row2["furnished"] . ",  Type of House: ".  $row2["Type"] . "</p>";
    }
    echo "<p>" . "Address: ".  $row1["address"] . "</p>";
    echo "<p>" . "City: ".  $row1["city"] . "  Pincode: ".  $row1["pincode"] . "</p>";

    $quser = "SELECT * from user where username = '$username'";
    $rowuser = mysqli_fetch_array(mysqli_query($conn, $quser), MYSQLI_ASSOC);
    echo "<p>" . "Seller details:" . "</p>";
    echo "<p>" . "Seller Name: ". $rowuser["name"] . ",    Phone Number: ".  $rowuser["phone"] . ",    Email address: ".  $rowuser["email"] . "</p>";
    
    echo "<form method = 'POST' action = 'indexcart.php'>
    <input type = 'hidden' name = 'id' value = ".$row1['estate_id'].">
    <input type = 'submit' value = 'Add to Cart' name = 'submit'>
     </form>";
    echo "</div>";
    echo "<br>";
}
?>

   <!-- <div class="card">
    <img src="/w3images/jeans3.jpg" style="width:100%">
    <h1><?php //$row1["category"] ?> for <?php //$row1["contract"] ?> </h1>
    <p class="price"> <?php //$row1["price"] ?>Rs <?php //$row1["area"] ?>sqft</p>
    <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
    <p><button>Add to Cart</button></p>
  </div>-->
  </body>
  </html>
