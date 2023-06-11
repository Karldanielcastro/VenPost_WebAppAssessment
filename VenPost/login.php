<?php
include('./connect/connect.php');
include('./functions/functions.php');

session_start();
login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <!-- Icon -->
    <link rel="shortcut icon" href="https://res.cloudinary.com/dhkp0ob9v/image/upload/v1686251364/logo-sale_ip3zkn.png" type="image/x-icon">
    <!-- CSS Link -->
    <link rel="stylesheet" href="./style/style.css?<?php echo time(); ?>">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Bootstrap JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
     <!--Font awsome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
     <!-- Cursor -->
<div id="cursor"></div>
   <!-- Form -->
   <div class="container-fluid color " style="height: 720px;">
        <div class="row">
            <div class="col-5 text-center">
                <form action="" method="post">
                    <div class="text-center" style="margin-bottom:10px; margin-top: 90px;">
                    <img src="https://res.cloudinary.com/dhkp0ob9v/image/upload/v1686251364/logo-sale_ip3zkn.png" alt="" class="logo_signup">
                    <br>
                    <h3 class="headtext text-center">LogIn</h3>
                    </div>
                    <i class="fa-solid fa-envelope" style="color: #b622f1;"></i>
                    <input class="inp" type="email" name="email" required placeholder="Enter Email" class="box">
                    <br>
                    <i class="fa-solid fa-key" style="color: #b622f1;"></i>
                    <input class="inp" type="password" name="password" required placeholder="Enter Password" class="box">
                    <br>
                    <input class ="sub"type="submit" name="submit" class="btn" value="Join">
                    <br>
                    <p style="padding-top: 20px;color: #e4d9d7;">don't have an account? <a href="signup.php" class="linkcol">register now</a></p>
                    <br>
                </form>
            </div>
            <div class="col-7 backimg2">
                <h1 class="text-head">WELCOME BACK ADVENTURER</h1>
            </div>
        </div>

    </div>
<!-- <div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" required placeholder="enter email" class="box">
      <input type="password" name="password" required placeholder="enter password" class="box">
      <input type="submit" name="submit" class="btn" value="login now">
      <p>don't have an account? <a href="signup.php">register now</a></p>
   </form>

</div> -->

<script src="./js/script.js"></script>
</body>
</html>