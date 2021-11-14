<?php
include("scripts/config.php");
session_start();

if(isset($_SESSION['username'] ) ){
  header("Location:main.php");
}

if(isset($_POST['register'])){
  $registerusername = $_POST['registerusername'];
  $registerpassword = md5($_POST['registerpassword']);
  $already_account =mysqli_query($conn, "SELECT * FROM users WHERE username='$registerusername'");

  $rowcount=mysqli_num_rows($already_account);

  if($rowcount > 0){
    echo ("<script>alert('UserName Already Exist. Please Choose Another UserName')</script>");
  }
  else{
    $newUser = mysqli_query($conn, "INSERT INTO users(username,password) VALUES('$registerusername','$registerpassword')");
    if(!$newUser){
      echo ("<script>alert('User Not Created')</script>");
    }
    else{
      echo ("<script>alert('Account Created')</script>");
      $registerusername="";
      $_POST['registerpassword']="";
      header("Location:index.php");
    }

  }



}


 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>

    <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Ubuntu" rel="stylesheet">

  <!-- CSS Stylesheets -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">

  <!-- Font Awesome -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>



  <!-- Bootstrap Scripts -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  </head>
  <body>

    <div class="container">
      <div class="myCard">
        <div class="row">
          <div class="col-md-12 ">
            <div class="myLeftCtn">
              <form class="myForm text-center" action="" method="post">
                <header>CREATE NEW ACCOUNT</header>
                <div class="form-group">
                  <i class="fas fa-user"></i>
                  <input type="text" placeholder="Username" class="myInput" id="username" name="registerusername" required>
                </div>


                <div class="form-group">
                  <i class="fas fa-envelop"></i>
                  <input type="password" class="myInput" placeholder="Password" id="password" name="registerpassword" required>

                </div>

                <input type="submit" class="butt" value="signup" name="register">

              </form>

              <div class="register">
                <h7>Have an Account ? <a href="index.php">Login Here</a>
                </h7>

              </div>

            </div>
          </div>
        </div>

      </div>

    </div>


  </body>
</html>
