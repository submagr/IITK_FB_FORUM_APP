<!DOCTYPE html>
<html>
<head>
  <title> Main login page</title>
  <style>
  .error {color: red ;}
  </style>
</head>
<?php
$usernameErr = $passwordErr = "" ;
$username = $password ="" ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["username"])) {
     $usernameErr = "UserName is required";
   } else {
     $username = test_input($_POST["username"]);
   }
   if (empty($_POST["password"])) {
     $passwordErr = "Password is Required";
   } else {
     $password = test_input($_POST["password"]);
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
<body>
  <p><span class="error"> * REQUIRED FIELD</span> </p>
  <form method="post" name="signInForm" action= "checkingwithdatabase.php">
  <div align="center">
  	<p>
      <label for="a"><h3>Username :</h3> </label>
      <input type="text" id="a" name="username">
      <span class="error">* <?php echo $usernameErr ; ?></span>
    </p>
    <p>
    <label for="b"><h3>Password :</h3></label>
    <input type="password" id="b" name="password">
    <span class="error">* <?php echo $passwordErr ; ?></span>
    </p>
    <input type="submit" name="SUBMIT"><br>
  <h4>Not a User ?
  <a href="signupform.php">
  	 CLICK HERE TO SIGN IN.
  </a></h4>
  </div>
  </form>
</body>
</html>
?>