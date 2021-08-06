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
            padding: 1px, 1px;
            margin: 10 auto;
            font-size: 20px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: white;
        }
        .loginbox a:hover {
            cursor: pointer;
            color: Orange;
        }
        .leas {
        display: none;
        } 
        .res {
        display: none;
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

if (isset($_SESSION['type'])) {
    unset($_SESSION['type']);
}
if (isset($_SESSION['contract'])) {
    unset($_SESSION['contract']);
}
if (isset($_SESSION['address'])) {
    unset($_SESSION['address']);
}
if (isset($_SESSION['pincode'])) {
    unset($_SESSION['pincode']);
}
if (isset($_SESSION['city'])) {
    unset($_SESSION['city']);
}
if (isset($_SESSION['sq'])) {
    unset($_SESSION['sq']);
}
if (isset($_SESSION['pr'])) {
    unset($_SESSION['pr']);
}
?>
<body>
<div class = "header">
        <div class = "innerheader">
            <div class = "cont">
            <h1>REAL ESTATE</h1>
            </div>
            <ul class = "nav">
            <a><li>Logged in as <?php echo $name ?></li></a>
            <!--<a href = "viewestate.php"><li>My cart</li></a>-->
            <a href = "mypurchase.php"><li>My purchase</li></a>
            <a href = "cart.php"><li>My cart</li></a>
            <a href = "logout.php"> <li>Logout</li></a>
            </ul>
        </div>
        
    </div>

    <div class="loginbox">
        <form id="form1" method="POST" action="buyerupdate.php">
            <h2>Search for a property: </h2>
            <p> Select property type: </p>
            <input type="radio" id="type1" name="type" value="land">
            <label for="cat">Land</label><br>
            <input type="radio" id="type2" name="type" value="residential">
            <label for="cat">residential</label><br>
            <input type="radio" id="type3" name="type" value="commercial">
            <label for="cat">commercial</label><br>
            <!--<select id="estate" name="type" onclick="myFunct3()">
                <option value="land">Land</option>
                <option value="residential">Residential</option>
                <option value="commercial">Commercial</option>
            </select><br>-->
            <p> Select contract type: </p>
            <input type="radio" id="lease" name="contract" value="lease">
            <label for="contract">Lease/rent</label><br>
            <input type="radio" id="sale" name="contract" value="sale">
            <label for="contract">For sale</label><br><br>
            <p> Location details:</p>
            <p>Enter the city: </p>
            <input type="text" name="city" placeholder="Bangalore, Mumbai etc.," pattern = "^[A-Z][a-z]+$">
            <p>Enter the pincode: </p>
            <input type="text" name="pincode" placeholder="Enter pincode">
            <p> Property specifications : </p>
            <p>Select the max range carpet area of the real estate in square feet: </p>
            <input type="text" name="sq" placeholder="Enter area" pattern = "^[0-9]+$">
            <p>Select the max range of price in Rupees: </p>
            <input type="text" name="pr" placeholder="Enter price" pattern="^[0-9]+$"> <br><br><br>
            <input type="submit" value="Search" id="button1">
            
            <!--<div class="res" id="resi">
                <p>Property details:</p>
                <p>Select type of house: </p>
                <select name="toh" id="toh">
                    <option value="flat">Flat</option>
                    <option value="independent_house">Independent House</option>
                </select>
                <p>Enter the number of bedrooms:</p>
                <input type="number" name="bhk" placeholder="number of bedrooms">
                <p>Select Furnished type:</p>
                <input type="radio" id="unfurnished" name="furnished" value="unfurnished">
                <label for="furnished">Unfurnished</label><br>
                <input type="radio" id="semi-furnished" name="furnished" value="semi-furnished">
                <label for="furnished">Semi-furnished</label><br>
                <input type="radio" id="fully-furnished" name="furnished" value="fully-furnished">
                <label for="furnished">Fully-furnished</label>
            </div>
            <p> Select contract type: </p>
            <input type="radio" id="lease" name="contract" value="lease" onclick="myFunct()" required>
            <label for="contract">Lease/rent</label><br>
            <input type="radio" id="sale" name="contract" value="sale" onclick="myFunct2()" >
            <label for="contract">For sale</label><br>
            <div class="leas" id="l">
                    <p>Enter the duration of the lease you're looking for in years: </p>
                    <input type="text" name="dur" placeholder="Enter duration in years">
            </div>
            <p>Enter the pincode: </p>
                    <input type="text" name="pincode" placeholder="Enter pincode">
                   
                    <p>Select the carpet area of the real estate in square feet: </p>
                    <div class="slidecontainer">
                        <input type="range" min="500" max="20000" value="3000" class="slider" id="sq" name = "sq">
                        <label id = "lol1"></label>
                    </div>
                   <div class="slidecontainer">
                <input type="range" min="10000" max="100000000" value="5000000" class="slider" id="pr" name = "pr">
                <label id = "lol"></label> 
            </div><br><br>
                    <input type="submit" value="Search" id="button1"> <br>-->
        </form>
    </div>
</body>
<script>
    var slider = document.getElementById("pr");
    var output = document.getElementById("lol");
    output.innerHTML = slider.value; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
    slider.oninput = function() {
    output.innerHTML = this.value;
}
var slider2 = document.getElementById("sq");
var output2 = document.getElementById("lol1");
output2.innerHTML = slider2.value; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
    slider2.oninput = function() {
  output2.innerHTML = this.value;
}
    function myFunct() {
        document.getElementById("l").style.display = "block";
    }

    function myFunct2() {
        document.getElementById("l").style.display = "none"
    }

    function myFunct3() {
        var x = document.getElementById("estate").value;
        if (x == "residential") {
            document.getElementById("resi").style.display = "block";
        } else {
            document.getElementById("resi").style.display = "none";
        }
    }
</script>
</head>
</html>