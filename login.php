<?php
//This script will handle login
session_start(); //start session

// check if the user is already logged in (registered)
if(isset($_SESSION['username'])) //if it exists
{
    header("location: welcome.php"); //redirect to welcome.php
    exit;
}

$error=0;
//if username not logged in
require_once "config.php"; //require configuration is made with database and server

$username = $password = "";  //vars to store username and password
$err = ""; //error message

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){ //if POST request is generated  
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password']))) //username and password fields are not empty
    {
        $err = "Please enter username + password";
    }
    else{
        //trim to remove extra spaces from start and end
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err)) //if no error (err field empty)
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?"; //prepare a select statement
    $stmt = mysqli_prepare($conn, $sql); //make connection statement
    mysqli_stmt_bind_param($stmt, "s", $param_username); //bind a string with username
    $param_username = $username; //set this parameter as entered username
    
    
    // Try to execute this statement (if stsmt executes) //connection is there
    if(mysqli_stmt_execute($stmt)){
        $error=0;
        mysqli_stmt_store_result($stmt); //store result
        if(mysqli_stmt_num_rows($stmt) == 1) //check if username exists 
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password); //bind result with sql query

                    //fetch the stmt (if it returns something (true))
                    if(mysqli_stmt_fetch($stmt))
                    {
                        //verify Password
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is correct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;
                            $error=0;

                            //Redirect user to welcome page
                            header("location: welcome.php");  
                        }else{
                            $error=1;
                        }
                    }

                }

    }
}    
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>myLibrary-Login</title>
  <!--Bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./styles.css">
  <!--Font Linking-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
  <!--Font Awesome-->
  <script src="https://kit.fontawesome.com/a4b361ce10.js" crossorigin="anonymous"></script>
  <style>
    .formerror{
    color:red;
    font-style: italic;
}
  </style>
</head>
<body>

  <section id="form-nav">
  <div class="container-fluid">

    <!-- Nav Bar -->
  
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand" href="">Login</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
       </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#footer">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./register.php">Signup</a>
          </li>
        </ul>
      </div>
    </nav>

    
   <!--Form-->
   <form action="" method="post" name="myForm" onsubmit="return validateForm()" class="row g-3" style="color:black; font-weight: lighter;">
    
    <div class="col-md-6" id="name">
      <label for="Username" class="form-label" style="margin: 40px 0px 5px 0px;">Username</label><br>
      <input type="text" class="form-control" name="username" id="Username">
      <span class="formerror"> </span>
    </div>
    <br> 
    <div class="col-md-6" id="password">
      <label for="Password" class="form-label" style="margin: 40px 0px 5px 0px;">Password</label><br>
      <input type="password" class="form-control" name="password" id="Password">
      <span class="formerror"> </span>
      <?php
        if($error === 1){
        echo "<p class='formerror'>Wrong Password, please try again!!</p>";
        }?>
    </div>
    <br>
  <div class="col-12">
    <button type="submit" class="btn btn-primary" style="margin: 40px 0px 5px 0px;">Login</button>
  </div>
</form>


 
    <!--Footer-->
    <footer id="form-footer">
        <table>
          <tbody>
          <tr>
            <td><a href=""><i class="fab fa-twitter fa-2x"></i></a></td>
            <td><a href=""><i class="fab fa-facebook-f fa-2x"></i></a></td>
            <td><a href=""><i class="fab fa-instagram fa-2x"></i></a></td>
            <td><a href=""><i class="fas fa-envelope fa-2x"></i></a></td>
          </tr>
        </tbody>
        </table>
        <p>© Copyright myLibrary</p>
    
      </footer>
  </section>
</body>
<script src="./loginError.js"></script>
</html>