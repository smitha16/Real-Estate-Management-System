<html>
    <head>
        <style>
            body {
            margin: 0;
            padding: 0;
            background-image: url("pexels-chris-goodwin-32870.jpg");
            background-size: cover;
        }
        
.loginbox form[id = "form1"] {
            width: 350px;
            height: auto;
            background-color: Black;
            color: White;
            top: 20%;
            left: 35%;
            position: absolute;
            box-sizing: border-box;
            /*transform: translate(-50%, -50%);*/
            padding: 10px 30px;
        }
        
        .header{
            width: 100%;
            height: 70px;
            display: block;
            background-color: steelblue;
            position: fixed;
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
        .loginbox h1 {
            text-align: center;
            text-decoration: bolder;
            padding: 5px, 2px;
            margin: 0 auto;
            font-size: 25px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: White;

        }
        .loginbox a {
            text-align: center;
            text-decoration: bolder;
            padding: 2px, 2px;
            margin: 50 auto;
            font-size: 20px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: white;
        }
        .loginbox a:hover {
            cursor: pointer;
            color: Orange;
        }
        .top_thing{
            background-color: steelblue;
            width: 400px;
        }
        .button input [type = submit]{
            background: Black;
            font-weight: bold;
            padding: 2px, 2px;
            margin: 50 auto;
            font-size: 10px;
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif';
            color: white;
        }
        
        </style>
    </head>
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
    if(!isset($_SESSION["uname"]))
    {
    header("location: loginpage.php");
    }
    $uname = $_SESSION["uname"];
    $s1 = "select * from user where username = '$uname'";
    $res = mysqli_query($conn, $s1);
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $name = $row["name"];
?>
    <body>
        <div class = "header">
            <div class = "innerheader">
                <div class = "cont">
                    <h1>REAL ESTATE</h1> <h1> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Purchase Detials</h1>
                </div>
                <ul class = "nav">
                <a><li>Logged in as <?php echo $name ?></li></a><br>
                <a href = "buyerpage.php"><li>back</li></a>
                <a href = "cart.php"> <li>My Cart</li></a>
                </ul>
            </div>
        </div>
       <br>
       <br>
       <br>
       <br>
       <br>
  
    </body>
   <?php
    if(isset($_POST["id"]))
    {
        $realid = $_POST["id"];
    }
    $s2 = "select * from estate where estate_id = '$realid'";
    $res1 = mysqli_query($conn, $s2);
    $n = mysqli_num_rows($res1);

    
    if($n == 0) 
    {?>
    <script type="text/javascript">
        alert("Real estate does not exist"); 
        window.location.replace("buyerpage.php");
    </script><?php
    }   



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
</tr>";
  $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
  $na = $row1['username'];
  $sql1 = "select * from user where username = '$na'";
  $row2 = mysqli_fetch_array(mysqli_query($conn, $sql1), MYSQLI_ASSOC);
  echo "<tr>";
  echo "<td>" . "<b>" . $row1["estate_id"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2["name"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2["email"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row2["phone"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["address"] . "</b>" .  "</td>";
  echo "<td>" . "<b>" . $row1["city"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["pincode"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["price"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["sqfoot"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["category"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row1["contract"] . "</b>" . "</td>";
  echo "</tr>";

echo "</table>";
echo "<br>";


$s3 = "select estate_id from estate where estate_id = '$realid' and contract = 'lease'";
$res3 = mysqli_query($conn, $s3);
$row3 = mysqli_fetch_array($res3, MYSQLI_ASSOC);
echo "<table border='3' align = 'center' display = 'block' bgcolor = '#85C1E9' width = '10px' id = 'lt' class = 'lt'>
<tr>
    <th>Estate ID</th>
    <th>Lease duration</th>
</tr>";

/*if($row3 =! mysqli_fetch_array($res3, MYSQLI_ASSOC))
{?>
<script>
    document.getElementById("lt").style.display = "none";</script><?php
}*/

/*if($row = mysqli_fetch_array($res3, MYSQLI_ASSOC))
{?>
<script>
    document.getElementById("lt").style.display = "block";</script><?php
}*/

    
  $id = $row3['estate_id'];
  $sql2 = "select * from lease where estate_id = '$id'";
  $row4 = mysqli_fetch_array(mysqli_query($conn, $sql2), MYSQLI_ASSOC);
  echo "<tr>";
  echo "<td>" . "<b>" .  $row4["estate_id"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row4["duration"] . "</b>" . "</td>";
  echo "</tr>";

echo "</table>";
echo "<br>";

if($row1["contract"] != "lease")
{?>
<script>
    document.getElementById("lt").style.display = "none";</script><?php
}

$s4 = "select * from estate where estate_id = '$realid' and category = 'residential'";
$res4 = mysqli_query($conn, $s4);
$row5 = mysqli_fetch_array($res4, MYSQLI_ASSOC);
echo "<table border='3' align = 'center' bgcolor = '#85C1E9' id = 'rt' class = 'rt'>
<tr>
    <th>Estate ID</th>
    <th>Rooms</th>
    <th>Furnished</th>
    <th>House Type</th>
</tr>";

/*if($row5 =! mysqli_fetch_array($res4, MYSQLI_ASSOC))
{?>
<script>
    document.getElementById("rt").style.display = "none";</script><?php
}

if($row5 = mysqli_fetch_array($res4, MYSQLI_ASSOC))
{?>
<script>
    document.getElementById("rt").style.display = "block";</script><?php
}*/

  
  $id1 = $row5['estate_id'];
  $sql3 = "select * from residential where estate_id = '$id1'";
  $row6 = mysqli_fetch_array(mysqli_query($conn, $sql3), MYSQLI_ASSOC);
  echo "<tr>";
  echo "<td>" . "<b>" .  $row6["estate_id"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row6["rooms"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row6["furnished"] . "</b>" . "</td>";
  echo "<td>" . "<b>" . $row6["Type"] . "</b>" . "</td>";
  echo "</tr>";

echo "</table>";

if($row1["category"] != "residential")
{?>
<script>
    document.getElementById("rt").style.display = "none";</script><?php
}
echo "<div class = 'button'>";
echo "<form method = 'POST' action = 'billing.php'>
<input type = 'hidden' name = 'realid' value = ".$row1['estate_id'].">
 <center><input type = 'submit' value = 'Confirm Purchase' name = 'cart'></center>
 </form>";
echo "</div>";

?>
   
</html>