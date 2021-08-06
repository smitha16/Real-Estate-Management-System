<html>
<head>
<style>
        body {
          background-image: url("pexels-chris-goodwin-32870.jpg");
        }
        
        table {
            border-style: groove;
            /*padding: 5px;
            margin-bottom: 30px;*/
            align-content: center;
            text-align: center;
        }
        .loginbox form[id = "form1"] {
          width: 300px;
          height: auto;
          background-color: Black;
          color: White;
          top: 100%;
          left: 38%;
          margin-bottom: 50px;
          position: relative;
          box-sizing: border-box;
          padding: 10px 30px;
          background: linear-gradient() ;
          border-style: solid;
        }
        .loginbox p {
            margin: 0;
            width: auto;
            margin-bottom: 5px;
            padding: 0,5px;
            font-weight: bolder;
            position: center;
            background-color: black;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        .loginbox h2,
        h3 {
            text-align: center;
            text-decoration: bolder;
            padding: 0 0 20px;
            margin: 0;
            font-size: 20px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:White;
            top: 60%;
        } 
          .loginbox a {
              position:relative;
              top: 1px;
              float: top;
              font-size: 20px;
              font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
              font-weight: bolder;
              color: White;
        } 
        .header{
            width: 100%;
            height: 70px;
            display: block;
            background-color: steelblue;
            
        }
        .innerheader{
            width: 800px;
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
            margin: 0 auto;
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
           display:table-cell;
           padding:3px 15px;
           vertical-align: center;
           font-weight: bold;
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

?>
<body>
        <div class = "header">
            <div class = "innerheader">
                <div class = "cont">
                    <h1>REAL ESTATE</h1> <h1> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; My Purchase </h1>
                </div>
                <ul class = "nav">
                <a><li>Logged in as <?php echo $name ?></li></a><br>
                <a href = "buyerpage.php"><li>back</li></a>
                <a href = "logout.php"> <li>Logout</li></a>
                </ul>
            </div>
        </div>
       <br>
       <br>
       <br>
       <br>
       <br>
  
    </body> <?php

$s2 = "select estate_id from purchase where buyername = '$uname'";
$res2 = mysqli_query($conn, $s2);
$n = mysqli_num_rows($res2);

if($n == 0) 
{?>
    <script type="text/javascript">
        alert("Please make a purchase"); 
        window.location.replace("buyerpage.php");
    </script><?php
}

echo "<h1 align = 'center'>" . "Real Estate and Seller Details. Residential and Lease Details if Applicable: " . "</h1>";

echo "<table border='3' align = 'center' bgcolor = '#85C1E9' width = 100>
<tr>
    <th>Estate ID</th>
    <th>Seller Name</th>
    <th>Seller email</th>
    <th>Seller phone</th>
    <th>Address</th>
    <th>City</th>
    <th>Pincode</th>
    <th>Price in RS</th> 
    <th>Area in sqft</th> 
    <th>Category</th>
    <th>contract</th>
    <th>status</th>
</tr>";

while($row1 = mysqli_fetch_array($res2, MYSQLI_ASSOC))
{
    $id = $row1["estate_id"];
    $sqla = "select * from estate where estate_id = '$id'";
    $row2a = mysqli_fetch_array(mysqli_query($conn, $sqla), MYSQLI_ASSOC);
  $un = $row2a["username"];
  $sql = "select * from user where username = '$un'";
  $row2 = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC);
  echo "<tr>";
  echo "<td>" . "<b>" . $row2a["estate_id"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2["name"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2["email"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2["phone"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2a["address"] . "</b>" .  "</td>";
  echo "<td>" . "<b>" . $row2a["city"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2a["pincode"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2a["price"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2a["sqfoot"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2a["category"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2a["contract"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2a["status"] . "</b>" . "</td>";
  echo "</tr>";
}
echo "</table>";
echo "<br>";
$res2 = mysqli_query($conn, $s2);
echo "<table border='3' align = 'center' bgcolor = '#85C1E9' width = 130 id = 'rt'>
<tr>
    <th>Estate ID</th>
    <th>Lease duration</th>
</tr>";
while($row2 = mysqli_fetch_array($res2, MYSQLI_ASSOC)){
    $id = $row2['estate_id'];
    $s3 = "select * from estate where estate_id = '$id' and contract = 'lease'";
    $res3 = mysqli_query($conn, $s3);
    $n = mysqli_num_rows($res3); 
    if($n == 0){
        ?>
    <script>
    document.getElementById("rt").style.display = "none";</script><?php
    } else{?>
        <script>
        document.getElementById("rt").style.display = "block";</script><?php
    }
}
$res2 = mysqli_query($conn, $s2);
while($row3 = mysqli_fetch_array($res2, MYSQLI_ASSOC))
{
  $id = $row3['estate_id'];
  $sql2 = "select * from lease where estate_id = '$id'";
  $row4 = mysqli_fetch_array(mysqli_query($conn, $sql2), MYSQLI_ASSOC);
  echo "<tr>";
  echo "<td>" . "<b>" . $row4["estate_id"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row4["duration"] . "</b>" . "</td>";
  echo "</tr>";
}
echo "</table>";
echo "<br>";

//$s4 = "select estate_id from purchase where buyername = '$uname' and category = 'residential'";
$res4 = mysqli_query($conn, $s2);
echo "<table border='3' align = 'center' bgcolor = '#85C1E9' width = 300 id = 'res'>
<tr>
    <th>Estate ID</th>
    <th>Rooms</th>
    <th>Furnished</th>
    <th>House Type</th>
</tr>";
while($row2 = mysqli_fetch_array($res4, MYSQLI_ASSOC)){
    $id = $row2['estate_id'];
    $s3 = "select * from estate where estate_id = '$id' and category = 'residential'";
    $res5 = mysqli_query($conn, $s3);
    $n = mysqli_num_rows($res5); 
    if($n == 0){?>
        <script>
        document.getElementById("res").style.display = "none";
        </script><?php
    } else{?>
        <script>
        document.getElementById("res").style.display = "block";
        </script><?php
    }
}
$res2 = mysqli_query($conn, $s2);
while($row5 = mysqli_fetch_array($res2, MYSQLI_ASSOC))
{
  $id1 = $row5['estate_id'];
  $sql3 = "select * from residential where estate_id = '$id1'";
  $row6 = mysqli_fetch_array(mysqli_query($conn, $sql3), MYSQLI_ASSOC);
  echo "<tr>";
  echo "<td>" . "<b>" . $row6["estate_id"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row6["rooms"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row6["furnished"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row6["Type"] . "</b>" . "</td>";
  echo "</tr>";
}
echo "</table>";
   ?>
</body>
</head>
</html>