<?php
require_once "config.php";   //require configuration

$username = $password = "";    
$username_err = $password_err = "";    //variables to store error info

$insert = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST"){    //if POST request is generated

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{ //if not empty
        $sql = "SELECT id FROM users WHERE username = ?"; //sql to select id of username
        $stmt = mysqli_prepare($conn, $sql);  //prepare connection and id for user
        
        //if stmt is true
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username); //bind the string (s) with param username

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                $insert = 0;
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken";
                    $insert = 1;

                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err))
{
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)"; //?? because we just need to prepare the statement
    $stmt = mysqli_prepare($conn, $sql); //prepare the staement 

    //if prepared properly without error
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password); //bind 2 strings (ss) this time with the stmt

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT); //converting password to hash(one-way) by default logic

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php"); //redirect header to login.php
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt); //close the statement
}
mysqli_close($conn); //close the connection
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>myLibrary-Signup</title>
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
      <a class="navbar-brand" href="">SignUp</a>
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
            <a class="nav-link" href="./login.php">Login</a>
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
    <?php
        if($insert === 1){
        echo "<p class='formerror'>Username already taken, please try again!!</p>";
        }?>
  </div>
  <br> 
  <div class="col-md-6" id="password">
    <label for="Password" class="form-label"style="margin: 40px 0px 5px 0px;">Password</label><br>
    <input type="password" class="form-control" name="password" id="Password">
    <span class="formerror"> </span>
  </div>
  <br>
  <div class="col-12" id="address">
    <label for="address" class="form-label"style="margin: 40px 0px 5px 0px;" >Address</label><br>
    <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St">
    <span class="formerror"> </span>
  </div>
  <br>
  <div class="col-md-6" id="city>
    <label for="city" class="form-label"style="margin: 40px 0px 5px 0px;">City</label><br>
    <input type="text" name ="city" class="form-control" id="city">
    <span class="formerror"> </span>
  </div>
  <br>
  <div class="col-md-6" id="phone">
    <label for="phone" class="form-label" style="margin: 40px 0px 5px 0px;">Phone</label>
    <input type="text" name="phone" class="form-control" id="phone">
    <span class="formerror"> </span>
  </div>
  <br>
  <div class="col-12">
    <button type="submit" class="btn btn-primary" style="margin: 40px 0px 5px 0px;">Sign up</button>
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
<script src="./registerError.js"></script>
</html>