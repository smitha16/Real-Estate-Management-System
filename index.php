<html>
<head>
    <link rel="stylesheet" href="stylelogin" type = "text/css">
</head>
<body>
    <div class = "header">
        <div class = "innerheader">
            <div class = "cont">
            <h1>REAL ESTATE MANAGEMENT SYSTEM</h1>
            </div>
        </div>
    </div>
    <div class="loginbox">
            <form id="form1" method="POST" action="Lvalidation.php">
                <h2>LOGIN DETAILS</h2>
                <label for="buyer">USERNAME</label><br>
                <input type="text" name="lusername" placeholder="Enter the username" required>
                <label for="buyer">PASSWORD</label><br>
                <input type="password" name="lpassword" placeholder="Enter the password" required>
                <label for="buyer">Login as:</label><br>
                <input type="radio" id="seller" name="usertype" value="seller" required>
                <label for="buyer">Seller  </label><br>
                <input type="radio" id="buyer" name="usertype" value="buyer">
                <label for="buyer"> Buyer          </label><br>
                <input type="submit" value="Login" id="button1" ><br>
                <a href="#">Forgot password?</a><br>
                <label for="sign">Don't have an account?</label>
                <a href="signup.php">Sign Up</a>
            </form>
    </div>
</body>
</html>