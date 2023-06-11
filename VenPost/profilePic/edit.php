<?php
    include('../connect/connect.php');
    session_start();
    $user_id = $_SESSION['user_id'];
    
    if(isset($_POST['insert_image'])){
        // accessing images
        $image_prof=$_FILES['image_prof']['name'];

        $select_user = mysqli_query($con, "SELECT * FROM `user` WHERE id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_user) > 0){
           $fetch_user = mysqli_fetch_assoc($select_user);
        };
        $image = $fetch_user['image'];
        // accessing image tmp name
        $image_temp=$_FILES['image_prof']['tmp_name'];
        if($image_prof ==''){
            echo"<script>alert('Please fill all the available fields')</script>";
            exit();
        }else{
            move_uploaded_file( $image_temp,"./images/$image_prof");

            $newimg = mysqli_query($con, "UPDATE `user` SET  image='$image_prof' WHERE id = '$user_id'") or die('query failed');
            $postimg = mysqli_query($con, "UPDATE `post` SET  `image`='$image_prof' WHERE user_id = '$user_id'") or die('query failed');
            $commentimg = mysqli_query($con, "UPDATE `comment` SET  `image`='$image_prof' WHERE user_id = '$user_id'") or die('query failed');
            header("location:../venpost.php?profile");
        }
    }

    if(isset($_POST['insert_pass'])){


        $pass_old = mysqli_real_escape_string($con, md5($_POST['old_pass']));
        $pass_new = mysqli_real_escape_string($con, md5($_POST['new_pass']));

        $select_user = mysqli_query($con, "SELECT * FROM `user` WHERE id = '$user_id' AND password='$pass_old'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
        $passwordchange = mysqli_query($con, "UPDATE `user` SET  password='$pass_new' WHERE id = '$user_id'") or die('query failed');
        header("location:../login.php");
      }
      else{
        echo"<script>alert('Password is not the same')</script>";
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VenPost</title>
    <!-- Icon -->
    <link rel="shortcut icon" href="https://res.cloudinary.com/dhkp0ob9v/image/upload/v1686251364/logo-sale_ip3zkn.png" type="image/x-icon">
    <!-- CSS Link -->
    <link rel="stylesheet" href="../style/style.css?<?php echo time(); ?>">
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
<div style="height:50px"></div>
<div class="container ">
<a href="../venpost.php?profile"><i class="fa-solid fa-circle-left exit-icon" style="color: #b622f1;"></i></a>
<br>
<div class="text-center">
<div style="height:50px"></div>
<h1 class="edit-banner">Edit Profile</h1>
<form action="" method="post" enctype="multipart/form-data">
    <!-- Image 1 -->
    <div class="form-outline mb-4 w-50 m-auto">
                <label for="prof-image" class="form-label" style="font-size: 20px;color:#a8c2ab;margin-top:100px;">Add Profile Image</label>
                <input type="file" name="image_prof" id="product_image1" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_image" class="btn submit_profile_pic mb-3 px-3" value="Change Profile Picture">
            </div>
</form>
<div class="container backedit">
<form action="" method="post" enctype="multipart/form-data">
    <!-- Image 1 -->
    <div style="height:50px"></div>
    <div class="container">
<h1 class="edit-banner">Edit PASSWORD</h1>
    <div class="form-outline mb-4 w-50 m-auto">
                <label for="prof-image" class="form-label" style="font-size: 20px;color:#a8c2ab;margin-top:100px;">Old Password</label>
                <input type="password" name="old_pass" id="product_dimensions" class="form-control form-change" placeholder="Enter Old Password" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="prof-image" class="form-label" style="font-size: 20px;color:#a8c2ab;margin-top:100px;">New Password</label>
                <input type="password" name="new_pass" id="product_dimensions" class="form-control form-change" placeholder="Enter New Password" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_pass" class="btn submit_profile_pic mb-3 px-3" value="Change Password">
            </div>
</form>
</div>
</div>
<div style="height:100px"></div>

<script src="../js/script.js"></script>
</body>
</html>