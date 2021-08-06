<?php

session_start();
$uname = "";
$servername = "localhost";
$username = "root";
$password = "";
$id2 = "";
$dbname = "real_estate";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn === false) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_SESSION["uname"]))
{
    $uname = $_SESSION["uname"];
}

if (isset($_POST['estateid2'])) {
    $id2 = $_POST['estateid2'];
}

$s2 = "select * from estate where username = '$uname' and estate_id = '$id2'";
$row2 = mysqli_fetch_array(mysqli_query($conn, $s2));
if($row2["status"] == "sold")
    {
        ?>
        <script type="text/javascript">
        alert("Property already sold"); 
        window.location.replace("viewestate.php");
        </script><?php
    }
else if ($id2 != $row2["estate_id"]){?>
        <script type="text/javascript">
        alert("Incorrect estate ID"); 
        window.location.replace("viewestate.php");
        </script><?php
}
else{
  $sql6 = "CALL deletedata('$id2')";
  mysqli_query($conn, $sql6); ?>

<script type="text/javascript">
        var x = alert("Your real estate is deleted");
        if(x == true){
        window.location.replace("viewestate.php");
        }
        else {
            window.history.back();
        }
</script><?php
}
//$sql6 = "DELETE FROM estate WHERE estate_id = '$id2'";

//header("Location:sellerpage.php");

?>