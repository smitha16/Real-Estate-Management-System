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
        top: 95%;
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
        display: block;
    }
    
    .res {
        display: block;
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
$cat="";
$uname = "";
$servername = "localhost";
$username = "root";
$password = "";
$id = "";
$dbname = "real_estate";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn === false) {
  die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['estateid'])) {
    $id = $_POST['estateid'];
    $_SESSION["ids"] = $id;
  }
  if(isset($_SESSION["ids"]))
  {
      $id = $_SESSION["ids"];
  }

if(isset($_SESSION["uname"]))
{
    $uname = $_SESSION["uname"];
    $s1 = "select * from estate where username = '$uname' and estate_id = '$id'";
    $res = mysqli_query($conn, $s1);
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
}
$s1 = "select * from user where username = '$uname'";
$resn = mysqli_query($conn, $s1);
$rown = mysqli_fetch_array($resn, MYSQLI_ASSOC);
$name = $rown["name"];

if($row["status"] == "sold")
    {
        ?>
        <script type="text/javascript">
        alert("Property already sold"); 
        window.location.replace("viewestate.php");
        </script><?php
         if(isset($_SESSION["ids"]))
         {
            unset($_SESSION["ids"]);
         }
    }
if ($id != $row["estate_id"]){?>
    <script type="text/javascript">
    alert("Incorrect estate ID"); 
    window.location.replace("viewestate.php");
    </script><?php
    if(isset($_SESSION["ids"]))
        {
            unset($_SESSION["ids"]);
        }

}

$s1 = "select * from lease where estate_id = '$id'";
$res1 = mysqli_query($conn, $s1);
$row2 = mysqli_fetch_array($res1, MYSQLI_ASSOC);

$s3 = "select * from residential where estate_id = '$id'";
$res3 = mysqli_query($conn, $s3);
$row3 = mysqli_fetch_array($res3, MYSQLI_ASSOC);

/*$s2 = "select estate_id, status from estate where username = '$uname'";
$res2 = mysqli_query($conn, $s2);*/

//while($row1 = mysqli_fetch_array($res, MYSQLI_ASSOC))


?>
<body onload = 'dis()'>
<div class = "header">
        <div class = "innerheader">
            <div class = "cont">
            <h1>REAL ESTATE</h1><h1> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Modify Detials</h1>
            </div>
            <ul class = "nav">
            <a><li>Logged in as <?php echo $name ?></li></a><br>
            <a href = "sellerpage.php"> <li>back</li></a>
            </ul>
        </div>
    </div>
    <div class="loginbox">
        <script>dis()</script>
            <form id="form1" method="POST" action="estateedit.php">
            <input type = "hidden" id = "cat" name = "category" value ="<?php echo $row['category'];?>">
            <input type = "hidden" id = "con" name = "contract" value ="<?php echo $row['contract'];?>">
            <h2>Enter the property detials here: </h2>
            <div class="res" id="resi">
                <p>Property details:</p>
                <p>Enter the type of house:</p>
                <select name="toh" id="toh" value = "<?php echo $row3['Type'];?>">
                    <option value="flat">Flat</option>
                    <option value="independent_house">Independent House</option>
                </select>
                <p>Enter the number of bedrooms:</p>
                <input type="number" name="bhk" placeholder="number of bedrooms" value = "<?php echo $row3['rooms'];?>" pattern = "^[0-9]+$">
                <p>Furnished type:</p>
                <select name="furnished" id="furnished">
                    <option value="unfurnished">unfurnished</option>
                    <option value="semi-furnished">semi-furnished</option>
                    <option value="fully-furnished">fully-furnished</option>
                </select>
            </div>
            <div class="leas" id="l">
                    <p>Enter the duration of the lease in years: </p>
                    <input type="text" name="dur" placeholder="Enter duration in years" pattern = "^[0-9]+$" value = "<?php echo $row2['duration'];?>">
            </div>
                <h2>Location details: </h2>
                <p>Full address:</p>
                <textarea name="address" rows="5" cols="30" form = "form1" required><?php echo $row['address']; ?>
                </textarea><br>
                <p>Enter city: </p>
                <input type= "text" name= "city" placeholder= "Enter city" value = "<?php echo $row['city'];?>" pattern = "^[A-Z][a-z]+$" required>
                <p>Enter pincode: </p>
                <input type= "text" name= "pincode" placeholder= "Enter pincode" value = "<?php echo $row['pincode'];?>" pattern = "^[0-9]+$" required>
                <p> Property specifications : </p>
                <p>Enter the carpet area of the real estate in square feet: </p>
                <input type = "text" name = "area" placeholder= "Enter area in sqft" value = "<?php echo $row['sqfoot'];?>" pattern = "^[0-9]+$" required>
                <p>Enter the price in Rupees: </p>
                <input type = "text" name = "price" placeholder= "Enter price in rupees" value = "<?php echo $row['price'];?>"  pattern = "^[0-9]+$" required><br>
                <br><input type="submit" value="Update" id="button2">
            </form>
    </div>
</body>
<script> 

    function dis(){
        var x = '<?php echo $row["category"]; ?>';
        var y = '<?php echo $row["contract"]; ?>';
        //var z = '<?php //echo $row3["furnsihed"]; ?>';
        if ( x == "residential") {
            document.getElementsById("resi").style.display = "block";
        } else {
            document.getElementById("resi").style.display = "none";
        }
        if (y == "lease") {
            document.getElementById("l").style.display = "block";
        } else {
            document.getElementById("l").style.display = "none";
        }
    }
    /*function validation(){
        var x = document.forms["form1"]["type"].value;
        if(x == "residential")
        {
           var y = document.forms["form1"]["bhk"].value;
           if(y == ""){
                alert("Enter the number of rooms");
                return false;
                window.history.back();
           }
        }
        var z = document.forms["form1"]["contract"].value;
        if(z == "lease")
        {
           var y = document.forms["form1"]["dur"].value;
           if(y == ""){
                alert("Enter the duration of lease");
                window.history.back();
                return false;
           }
        }

    }*/
</script>
</html>