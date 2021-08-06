<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "real_estate";
$cat="";
$uname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn === false) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_SESSION["uname"]))
{
   // header("location = sellerpage.php");
    $uname = $_SESSION["uname"];
}

if (isset($_POST['contract'])){
    $con = $_POST['contract'];
}
if (isset($_POST['type'])){
    $cat = $_POST['type'];
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
   
   /* if(isset($_POST["add"])){
        $targetDir = "real_esatate";
        $filename = $_FILES["pic"]["name"]; 
   // $tempname = $_FILES["pic"]["tmp_name"];     
   // $folder = "image/".$filename; 
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
         if(isset($_POST["add"]) && !empty($_FILES["file"]["name"])){
            $allowTypes = array('jpg','png','jpeg');
            if(!in_array($fileType, $allowTypes)){ ?>
                <script>
                alert("Wrong file type");
                window.history.back();
                </script><?php
            }
        }  
    } */

    if($cat == "residential" && ((!isset($_POST['bhk'])) || $_POST['bhk'] == NULL)){
        //if((!isset($_POST['bhk'])) && $_POST['bhk'] == NULL){
            ?> <script> alert("Enter the number of bedrooms"); 
                        window.history.back(); </script><?php
        //}
    }
    else if($con == "lease" && ((!isset($_POST['dur'])) || $_POST['dur'] == 0)){
            ?> <script> alert("Enter the duration of lease greater than 0"); 
            window.history.back(); </script><?php
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
        $s = "SELECT * FROM estate WHERE address = '$address' and (city = '$city' and pincode = '$pincode')";
        $resa = mysqli_query($conn, $s);
        $na = mysqli_num_rows($resa);
        if($na == 1){
            ?> <script>
            alert("Real estate with this address already exists");
            window.location.replace("estateform.php");
            </script><?php
        }
        else{
            $sql3 = "INSERT INTO estate (address, pincode, sqfoot, price, category, username, contract, city) VALUES ('$address', '$pincode', '$area', '$price','$cat','$uname', '$con', '$city')";
            mysqli_query($conn, $sql3); 
            $id = mysqli_insert_id($conn);
    
            if($cat == "residential"){
                if (isset($_POST['bhk']) && isset($_POST['furnished']) && isset($_POST['toh'])) {
                $rooms = $_POST['bhk'];
                $fur = $_POST['furnished'];
                $toh = $_POST['toh'];
                $sql2 = "INSERT  INTO residential(Type, furnished, estate_id, rooms) VALUES ('$toh','$fur', '$id' ,'$rooms')";
                mysqli_query($conn, $sql2);
                }
            }
            if($con == "lease"){
                if(isset($_POST['dur'])){
                $dur = $_POST['dur'];
                $sqli = "INSERT INTO lease (duration, estate_id) VALUES ('$dur', '$id')";
                mysqli_query($conn, $sqli);
                }       
            }
            ?>
            <script type="text/javascript"> 
            alert("Successfully inserted")
            window.location.replace("sellerpage.php");
            </script> <?php
        }
    }
     ?>