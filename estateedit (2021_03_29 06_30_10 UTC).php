<?php
session_start();
/*$address = "";
$room = "";
$price="";
$area="";
$pincode="";*/
$dur = "";
$rooms = "";
$fur = "";
$toh = "";
$id = $_SESSION["ids"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "real_estate";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn === false) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_SESSION["uname"]))
{
    $uname = $_SESSION["uname"];
}
  if (isset($_POST['address'])) {
    $address = $_POST['address'];
}
if (isset($_POST['pincode'])) {
    $pincode = $_POST['pincode'];
}
if (isset($_POST['city'])) {
    $city = $_POST['city'];
}
if (isset($_POST['area'])) {
    $area = $_POST['area'];
}
if (isset($_POST['price'])) {
    $price = $_POST['price'];
}
if (isset($_POST['category'])) {
    $cat = $_POST['category'];

}
if (isset($_POST['contract'])) {
    $con = $_POST['contract'];
}


if($cat == "residential" && ((!isset($_POST['bhk'])) || $_POST['bhk'] == NULL)){
    //if((!isset($_POST['bhk'])) && $_POST['bhk'] == NULL){
        ?> <script> alert("Enter the number of rooms"); 
        window.location.replace("modifyform.php"); </script><?php
    //}
}
else if($con == "lease" && ((!isset($_POST['dur'])) || $_POST['dur'] == 0)){
        ?> <script> alert("Enter the duration of lease"); 
        window.location.replace("modifyform.php"); </script><?php
}
else if($price == 0){
    ?> <script> alert("Please enter the amount greater than 0"); 
    window.history.back(); </script><?php
}
else if($area == 0){
    ?> <script> alert("Please enter the area greater than 0"); 
    window.history.back(); </script><?php
}
else{
    $sql4 = "UPDATE estate SET pincode = '$pincode', address ='$address', sqfoot = '$area', price = '$price', city = '$city' WHERE estate_id = '$id'";
    mysqli_query($conn, $sql4); 

    if (isset($_POST['dur'])) {
        $dur = $_POST['dur'];
        $sql = "UPDATE lease SET duration = '$dur' WHERE estate_id = '$id'";
        mysqli_query($conn, $sql);
    }
    
    if (isset($_POST['bhk']) && isset($_POST['furnished']) && isset($_POST['toh'])) {
        $rooms = $_POST['bhk'];
        $fur = $_POST['furnished'];
        $toh = $_POST['toh'];
        $sql2 = "UPDATE residential SET rooms = '$rooms', furnished = '$fur', Type = '$toh' WHERE estate_id = '$id'";
        mysqli_query($conn, $sql2);
    }
    if(isset($_SESSION["ids"]))
    {
        unset($_SESSION["ids"]);
    }
    ?>
    <script type="text/javascript">
    alert("Successfully updated"); 
    window.location.replace("viewestate.php");
    </script><?php
    //header("Location:sellerpage.php");
}
?>