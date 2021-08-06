<html>

<head>
    <!--<link rel="stylesheet" href="stylelogin" type = "text/css">-->
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        background-image: url("pexels-chris-goodwin-32870.jpg");
        background-size: cover;
    }
    
    .loginbox form[id=form1] {
        width: 400px;
        height: auto;
        background-color: Black;
        color: White;
        top: 80%;
        left: 50%;
        margin-bottom: 50px;
        position: absolute;
        box-sizing: border-box;
        transform: translate(-50%, -50%);
        padding: 10px 30px;
        background: linear-gradient() ;
        border-style: solid;
    }
    
    .leas {
        display: none;
    }
    .res {
        display: none;
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
           font-weight: bolder;
        }
        .loginbox p {
            margin: 0;
            width: auto;
            margin-bottom: 5px;
            padding: 7px 0;
            font-weight: bolder;
            position: center;
            background-color: black;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        .loginbox input[type="submit"] {
            margin: 2% 30%;
            border: none;
            width: 40%;
            padding: 0;
            background: SteelBlue;
            font-size: 20px;
            position: relative;
            color: White;
            border-radius: 20px;
        }
        
        .loginbox input[type="submit"]:hover {
            cursor: pointer;
            background: Orange;
            color: Black;
        }
        
</style>
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

if(!isset($_SESSION["uname"]))
{
    header("location: loginpage.php");
}
$uname = $_SESSION["uname"];
$s1 = "select * from user where username = '$uname'";
$res1 = mysqli_query($conn, $s1);
$row = mysqli_fetch_array($res1, MYSQLI_ASSOC);
$name = $row["name"];
?>
<body>
    <div class = "header">
        <div class = "innerheader">
            <div class = "cont">
            <h1>REAL ESTATE</h1><h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ADD PROPERTY</h1>
            </div>
            <ul class = "nav">
            <a><li>Logged in as <?php echo $name ?></li></a><br>
            <a href = "sellerpage.php"> <li>back</li></a>
            </ul>
        </div>
    </div>
    <div class="loginbox">
        <form id="form1" method="POST" action="estateupdate.php" onsubmit = "validation()">
            <h2>Enter the property detials here: </h2>
            <p> Select property type: </p>
            <select id="estate" name="type" onclick="myFunct3()">
                <option value="land">Land</option>
                <option value="residential">Residential</option>
                <option value="commercial">Commercial</option>
            </select>
            <br>
            <div class="res" id="resi">
                <p>Property details:</p>
                <p>Enter the type of house:</p>
                <select name="toh" id="toh">
                    <option value="flat">Flat</option>
                    <option value="independent_house">Independent House</option>
                </select>
                <p>Enter the number of bedrooms:</p>
                <input type="number" name="bhk" placeholder="number of bedrooms" pattern = "^[0-9]+$">
                <p>Furnished type:</p>
                <select name="furnished" id="furnished">
                    <option value="unfurnished">unfurnished</option>
                    <option value="semi-furnished">semi-furnished</option>
                    <option value="fully-furnished">fully-furnished</option>
                </select>
            </div>
            <p> Select contract type: </p>
            <input type="radio" id="sale" name="contract" value="lease" onclick="myFunct()" required>
            <label for="cont">Lease/rent</label><br>
            <input type="radio" id="sale" name="contract" value="sale" onclick="myFunct2()">
            <label for="cont">For sale</label><br>
            <div class="leas" id="l">
                    <p>Enter the duration of the lease in years: </p>
                    <input type="text" name="dur" placeholder="Enter duration in years" id = "lease" pattern = "^[0-9]+$">
            </div>
            <p> Location details: </p>
                    <p>Full address:</p>
                    <textarea name="address" rows="5" cols="30" form="form1">
                    </textarea><br>
                    <p>Enter the city: </p>
                    <input type="text" name="city" placeholder="Enter city" pattern = "^[A-Z][a-z]+$" required>
                    <p>Enter pincode: </p>
                    <input type="text" name="pincode" placeholder="Enter pincode" pattern = "^[0-9]+$" required>
                    <p> Property specifications : </p>
                    <p>Enter the carpet area of the real estate in square feet: </p>
                    <input type="text" name="area" placeholder="Enter area in sqft" pattern = "^[0-9]+$" required>
                    <p>Enter the price in Rupees: </p>
                    <input type="text" name="price" placeholder="Enter price in rupees" pattern = "^[0-9]+$" required><br><br>
                   <!-- <p> Insert the picture: </p>
                    <input type = "file" value = "img" name = "pic"><br><br>-->
                    <input type="submit" value="Add" id="button1" name = ""> <br>
        </form>
    </div>
</body>
<script>
    /*function validation(){
        var x = document.forms["form1"]["type"].value;
        if(x == "residential")
        {
           var y = document.forms["form1"]["bhk"].value;
           if(y == ""){
                alert("Enter the number of rooms");
                return false;
           }
        }
        var z = document.forms["form1"]["contract"].value;
        if(z == "lease")
        {
           var y = document.forms["form1"]["dur"].value;
           if(y == ""){
                alert("Enter the duration of lease");
                return false;
           }
        }

    }*/
    function myFunct() {
        document.getElementById("l").style.display = "block";
    }

    function myFunct2() {
        document.getElementById("l").style.display = "none";
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

</html>