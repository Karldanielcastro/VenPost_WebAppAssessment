<?php
    include('./connect/connect.php');
   include('./functions/functions.php');

    sigup();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
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
<div id="cursor-border"></div>

<!-- Form -->
    <div class="container-fluid color " style="height: 720px;">
        <div class="row">
            <div class="col-5 text-center" style="margin-top: 40px;">
                <form action="" method="post">
                    <div class="text-center">
                    <img src="https://res.cloudinary.com/dhkp0ob9v/image/upload/v1686251364/logo-sale_ip3zkn.png" alt="" class="logo_signup">
                    <br>
                    <h3 class="headtext text-center">register now</h3>
                    </div>
                    <i class="fa-solid fa-user" style="color: #b622f1;"></i>
                    <input class="inp" type="text" name="name" required placeholder="Enter Username" class="box">
                    <br>
                    <i class="fa-solid fa-envelope" style="color: #b622f1;"></i>
                    <input class="inp" type="email" name="email" required placeholder="Enter Email" class="box">
                    <br>
                    <i class="fa-solid fa-key" style="color: #b622f1;"></i>
                    <input class="inp" type="password" name="password" required placeholder="Enter Password" class="box">
                    <br>
                    <i class="fa-solid fa-lock" style="color: #b622f1;"></i>
                    <input class="inp" type="password" name="cpassword" required placeholder="Confirm Password" class="box">
                    <br>
                    <input class ="sub"type="submit" name="submit" class="btn" value="Register">
                    <br>
                    <p style="padding-top: 20px; color:#e4d9d7;">already have an account? <a href="login.php" class="linkcol">login now</a></p>
                    <br>
                </form>
            </div>
            <div class="col-7 backimg">
                <h1 class="text-head">START YOUR ADVENTURE</h1>
            </div>
        </div>

    </div>

    <script src="./js/script.js"></script>
</body>
</html>