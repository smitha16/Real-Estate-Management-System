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


    if(isset($_POST["realid"]) && $_POST["realid"] != ""){
      if(!empty($_SESSION["shopping_cart"])) {
          foreach($_SESSION["shopping_cart"] as $key => $values) {
            if($_POST["realid"] == $values['estate_id']){
              unset($_SESSION["shopping_cart"][$key]);
            }
            if(empty($_SESSION["shopping_cart"])){
              unset($_SESSION["shopping_cart"]);
            }
          }
        }
      }
        
    if(isset($_POST["realid"]))
    {
        $realid = $_POST["realid"];
    }
    if(!isset($_SESSION["uname"]))
    {
    header("location: loginpage.php");
    }
    $uname = $_SESSION["uname"];
    $billid = str_pad($realid, 7, "0", STR_PAD_LEFT);
    
    $sql = "INSERT INTO purchase (billing_id, estate_id, buyername) VALUES ('$billid', '$realid', '$uname')";
    mysqli_query($conn, $sql);
    ?>
    <script>
    var x = '<?php echo $billid ?>';
    alert("Yout purchase is confirmed. Your billing ID is : " + x);
    window.location.replace("buyerpage.php");
    </script>
    <?php
    //header("location: buyerpage.php");
    ?>

