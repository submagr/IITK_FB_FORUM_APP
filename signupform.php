<!DOCTYPE html>
<html>
<head>
  <title> Sign up form</title>
  <style>
  .error {color: blue;}
  </style>
</head>
<?php
$firstNameErr = $lastNameErr = $usernameErr =  $emailErr = $passwordErr = $rePasswordErr = $sexErr ="" ;
$firstName = $lastName = $username = $email = $password = $rePassword = $sex ="" ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["firstName"])) {
     $firstNameErr = "Name is required";
   } else {
     $firstName = test_input($_POST["firstName"]) ;
      $firstNameErr = "" ;
   }
   if (empty($_POST["lastName"])) {
     $lastNameErr = "Name is required";
   } else {
     $lastName = test_input($_POST["lastName"]);
     $lastNameErr ="" ;
   }
    if (empty($_POST["username"])) {
     $usernameErr = "Name is required";
   } else {
     $username = test_input($_POST["username"]);
     $usernameErr ="";
   }
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     $emailErr ="" ;
   }
     
   if (empty($_POST["password"])) {
     $passwordErr = "Password is Required";
   } else {
     $password = test_input($_POST["password"]);
     $rePasswordErr = "" ; 
   }


   if (empty($_POST["rePassword"])) {
     $rePasswordErr = "Required password";
   } else {
     $rePassword = test_input($_POST["rePassword"]);
     $rePasswordErr = "" ;
   }

   if (empty($_POST["sex"])) {
     $sexErr = "Gender is required";
   } else {
     $sex = test_input($_POST["sex"]);
     $sexErr = ""  ;
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
  <h1>FORUM  SIGN-UP FORM </h1>
  <p><span class="error"> * REQUIRED FIELD</span> </p>
  <form action= "middle.php" method="post" name="signUpForm">
    <p>
      <label for="1">First Name :</label> 
      <input type="text" id="1" name="firstName">
      <span class="error">* <?php echo $firstNameErr ; ?></span>
    </p>
    <p>
      <label for="2"> Last Name :</label>
      <input type="text" id="2" name="lastName">
      <span class="error">* <?php echo $lastNameErr ; ?></span>
    </p>
     <p>
      <label for="9">  UserName :</label>
      <input type="text" id="9" name="username">
      <span class="error">* <?php echo $usernameErr ; ?></span>
    </p>
    <p>
      <label for="3"> E-mail :</label>
      <input type="email" id="3" name="email">
      <span class="error">* <?php echo $emailErr ; ?></span>
    </p>
    <p>
      <label for="4"> Password :</label>
      <input type="password" id="4" name="password">
      <span class="error">* <?php echo $passwordErr ; ?></span>
    </p>
    <p>
      <label for="5"> Re-enter password :</label>
      <input type="password" id="5" name="rePassword">
      <span class="error">* <?php echo $rePasswordErr ; ?></span>
    </p>
    <p>
      <label for="6"> Date of Birth :</label>
      <input type="date" id="6" name="dateOfBirth">
    </p>
    <p>
      <label for="7"> MALE </label>
      <input type="radio" id="7" name="sex" value="male">
      <span class="error">* <?php echo $sexErr ; ?></span>
    </p>
    <p>
      <label for="8"> FEMALE </label>
      <input type="radio" id="8" name="sex" value="female">
      <span class="error">* <?php echo $sexErr ; ?></span>
    </p>
    <input type="submit" name="SUBMIT"><br>
  </form>
</body>
</html>




