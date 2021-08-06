<html>
<head>
<style>
        body {
          background-image: url("pexels-chris-goodwin-32870.jpg");
        }
        
        table {
            border-style: groove;
            width: 60%;
            padding: 5px;
            margin-bottom: 30px;
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
$s2 = "select * from estate where username = '$uname'";
$res2 = mysqli_query($conn, $s2);
$n = mysqli_num_rows($res2);

$su = "select * from user where username = '$uname'";
$resu = mysqli_query($conn, $su);
$rowu = mysqli_fetch_array($resu, MYSQLI_ASSOC);
$name = $rowu["name"];


if($n == 0) 
{?>
    <script type="text/javascript">
        alert("Please enter a real estate"); 
        window.location.replace("sellerpage.php");
    </script><?php
} 
?>

<body>
<div class = "header">
        <div class = "innerheader">
            <div class = "cont">
            <h1>REAL ESTATE</h1> <h1> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MY ENTRIES</h1>
            </div>
            <ul class = "nav">
            <a><li>Logged in as <?php echo $name ?></li></a>
            <!--<a href = "viewestate.php"><li>My cart</li></a>-->
            <a href = "sellerpage.php"><li>back</li></a>
            <a href = "logout.php"> <li>Logout</li></a>
            </ul>
        </div>
        
    </div>
</body>
<?php

echo "<table border='3' align = 'center' bgcolor = '#85C1E9' width = 100>
<tr>
    <th>Estate ID</th>
    <th>Seller Name</th>
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
  $sql = "select name from user where username = '$uname'";
  $row2 = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC);
  echo "<tr>";
  echo "<td>" . "<b>" . $row1["estate_id"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2["name"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["address"] . "</b>" .  "</td>";
  echo "<td>" . "<b>" . $row1["city"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["pincode"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["price"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["sqfoot"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["category"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["contract"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["status"] . "</b>" . "</td>";
  echo "</tr>";
}
echo "</table>";
echo "<br>";
$s3 = "select estate_id from estate where username = '$uname' and contract = 'lease'";
$res3 = mysqli_query($conn, $s3);
echo "<table border='3' align = 'center' bgcolor = '#85C1E9' width = '10px' id = 't2'>
<tr>
    <th>Estate ID</th>
    <th>Lease duration</th>
</tr>";

while($row3 = mysqli_fetch_array($res3, MYSQLI_ASSOC))
{
  $id = $row3['estate_id'];
  $sql2 = "select * from lease where estate_id = '$id'";
  $row4 = mysqli_fetch_array(mysqli_query($conn, $sql2), MYSQLI_ASSOC);
  echo "<tr>";
  echo "<td>" . "<b>" .  $row4["estate_id"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row4["duration"] . "</b>" . "</td>";
  echo "</tr>";
}
echo "</table>";

/*while($rowt2 = mysqli_fetch_array($res3, MYSQLI_ASSOC)){
  $id = $rowt2['estate_id'];
  $st2 = "select * from estate where estate_id = '$id' and contract = 'lease'";
  $rest2 = mysqli_query($conn, $st2);
  $nt2 = mysqli_num_rows($rest2); 
  if($nt2 == 0){
      ?>
  <script>
  document.getElementById("t2").style.display = "none";</script><?php
  }
}*/

echo "<br>";
$s4 = "select estate_id from estate where username = '$uname' and category = 'residential'";
$res4 = mysqli_query($conn, $s4);
echo "<table border='3' align = 'center' bgcolor = '#85C1E9' id = 't3'>
<tr>
    <th>Estate ID</th>
    <th>Rooms</th>
    <th>Furnished</th>
    <th>House Type</th>
</tr>";
/*while($rowt3 = mysqli_fetch_array($res4, MYSQLI_ASSOC)){
  $idt3 = $rowt3['estate_id'];
  $st3 = "select * from estate where estate_id = '$idt3' and category = 'residential'";
  $rest3 = mysqli_query($conn, $st3);
  $nt3 = mysqli_num_rows($rest3); 
  if($nt3 == 0){?>
    <script>
    document.getElementById("t3").style.display = "none";
    </script><?php
  }
}*/
while($row5 = mysqli_fetch_array($res4, MYSQLI_ASSOC))
{
  $id1 = $row5['estate_id'];
  $sql3 = "select * from residential where estate_id = '$id1'";
  $row6 = mysqli_fetch_array(mysqli_query($conn, $sql3), MYSQLI_ASSOC);
  echo "<tr>";
  echo "<td>" . "<b>" .  $row6["estate_id"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row6["rooms"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row6["furnished"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row6["Type"] . "</b>" . "</td>";
  echo "</tr>";
}

echo "</table>";


?>
   
<body>
  <div class = "loginbox">
    
    <form id = "form1" method="POST" action="modifyform.php" align="center">
        <h2> Modify your detials:</h2>
      <p> Enter the Estate_ID of the real estate you want to modify: </p>
      <input type="text" id="id" name="estateid" placeholder= "Enter an estate ID " required>
      <input type="submit" value="Modify" id="button1" ><br>
    </form>
    <br>

    <form id = "form1" method="POST" action="deleteestate.php">
    <h2>Delete a database: </h2>
      <p> Enter the Estate_ID of the real estate you want to Delete: </p>
      <input type="text" id="id" name="estateid2" placeholder= "Enter an estate ID " required>
      <input type="submit" value="Delete" id="button1" ><br>
    </form>
  </div>
</body>
</head>
</html>