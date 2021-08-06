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


if(!isset($_SESSION["uname"]))
{
    header("location: loginpage.php");
}
$uname = $_SESSION["uname"];
$s1 = "select * from user where username = '$uname'";
$res1 = mysqli_query($conn, $s1);
$row = mysqli_fetch_array($res1, MYSQLI_ASSOC);
$name = $row["name"];

$i=-1;
$count = -1;
$s2 = "select estate_id from estate where username = '$uname'";
$res2 = mysqli_query($conn, $s2);
while($row1 = mysqli_fetch_array($res2, MYSQLI_ASSOC))
  {
    $i = $i + 1;
    $arrayid[$i] = $row1["estate_id"];
  }

?>
<body>
<div class = "header">
        <div class = "innerheader">
            <div class = "cont">
            <h1>REAL ESTATE</h1>
            </div>
            <ul class = "nav">
            <a><li>Logged in as <?php echo $name ?></li></a><br>
            <a href = "viewestate.php"><li>My Properties</li></a>
            <a href = "logout.php"> <li>Logout</li></a>
            </ul>
        </div>
    </div>
  <div class = "loginbox">
  <form id="form1" method="POST" action="Lvalidation.php">
                <h1>WELCOME <?php echo $name ?></h1><br>
                <h1>DO YOU WANT TO SELL OR RENT A PROPERTY? </h1> <br>
                <center><a href="estateform.php">Add a property</a></center>
                <p> To view or edit your property detials, click on 'My 
                Properties' on the top right corner. </p>
            </form>
  </div>
  
</body>


</head>
</html>
