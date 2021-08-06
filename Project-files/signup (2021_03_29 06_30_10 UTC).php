<html>
<head>
<link rel="stylesheet" type = "text/css" href="stylelogin">
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
            <form id="form2" method="POST" action="connectiontext.php">
                <h3>SIGNUP DETAILS</h3>
                Name: <input type="text" name="name" placeholder="Enter your full name" required> <br> 
                Username: <input type="text" name="username" placeholder="Enter the username" required> <br> 
                Password: <input type="password" name="password" placeholder="Enter the password" required><br> 
                Confirm password: <input type="password" name="confirm_password" placeholder="Confirm password" required> <br>
                E-mail: <input type="text" name="email" placeholder="Pattern: abc@example.com" pattern = "^[a-z0-9]+[@][a-z0-9]+[.][a-z]+$" required> <br> 
                Phone: <input type="text" name="phone" placeholder="Pattern: 10 digit phone number" pattern="[0-9]*" required> <br>
                <input type="submit" value="Submit" name="button"> <br>
                <label for="log">Already have an account?</label>
                <a href="loginpage.php">login</a>
            </form>
        </div>
</body>
</html>