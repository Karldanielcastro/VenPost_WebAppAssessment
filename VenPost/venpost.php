<?php ini_set('display_errors', 0); ?>
<?php
include('./connect/connect.php');
include('./functions/functions.php');

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};
if(isset($_GET['logout'])){
  unset($user_id);
  session_destroy();
  header('location:login.php');
};


if(isset($_POST['subject'])){

  $post_id=$_POST['subject'];

  $select_like = mysqli_query($con, "SELECT * FROM `likes` WHERE user_id = '$user_id' AND post_id = '$post_id'") or die('query failed');
      if(mysqli_num_rows($select_like) > 0){
         $fetch_like = mysqli_fetch_assoc($select_like);
      };
      $check_like = $fetch_like['check_like'];
      //remove like

      if ($check_like == '1'){
        $rem_like = mysqli_query($con, "UPDATE `likes` SET  check_like='2' WHERE user_id = '$user_id' AND post_id = '$post_id'") or die('query failed');

        







      }
      //add like
       else  if ($check_like == '2'){
        $add_like = mysqli_query($con, "UPDATE `likes` SET  check_like='1' WHERE user_id = '$user_id' AND post_id = '$post_id'") or die('query failed');
    




      }
      else{

        $insert_products="insert into `likes` (user_id,post_id,check_like)
        values ('$user_id','$post_id','1')";
        $result_query=mysqli_query($con,$insert_products);
      }


      // $selectrem_like = mysqli_query($con, "SELECT * FROM `post` WHERE id = '$post_id'") or die('query failed');
      // if(mysqli_num_rows($selectrem_like) > 0){
      //    $remad_like = mysqli_fetch_assoc($select_like);
      // };

      // $addlike = $remad_like['added'];
      // $addlike --;
      // $rem_likec = mysqli_query($con, "UPDATE `post` SET  added = '$addlike' WHERE user_id = '$user_id' AND id = '$post_id'") or die('query failed');
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
    <link rel="stylesheet" href="style/style.css?<?php echo time(); ?>">
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


<nav class="navbar fixed-bottom navbar-expand-lg navcol">
  <div class="container-fluid justify-content-center">
    <a class="navbar-brand nav-start" href="venpost.php?post"><i class="fa-solid fa-icons nav-icon-small"></i></a>
    <a class="navbar-brand nav-start" href="venpost.php?likes"><i class="fa-solid fa-heart nav-icon-small"></i></a>
    <a class="navbar-brand nav-start" href="venpost.php?addpost"><i class="fa-solid fa-square-plus nav-icon-mid"></i></a>
    <a class="navbar-brand nav-start" href="venpost.php?profile"><i class="fa-solid fa-user nav-icon-small" ></i></a>
    <a class="navbar-brand nav-start" href="venpost.php?logout=<?php echo $user_id; ?>" onclick="return confirm('are your sure you want to logout?');"  ><i class="fa-solid fa-right-from-bracket nav-icon-small"></i></a>
  </div>
</nav>

<?php
        if(isset($_GET['post'])){
            include ('./Web/post.php');
        }
        if(isset($_GET['profile'])){
          include ('./Web/profile.php');
      }
    if(isset($_GET['addpost'])){
      include ('./Web/addpost.php');
  }
  if(isset($_GET['likes'])){
    include ('./Web/likes.php');
}
        ?>
<script src="./js/script.js"></script>
</body>
</html>