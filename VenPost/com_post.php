<?php ini_set('display_errors', 0); ?>
<?php
include('./connect/connect.php');
include('./functions/functions.php');

session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['insert_comment'])){
    $select_user = mysqli_query($con, "SELECT * FROM `user` WHERE id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($select_user) > 0){
       $fetch_user = mysqli_fetch_assoc($select_user);
    };
    $name = $fetch_user['name'];
    $image = $fetch_user['image'];
    $post_id = $_GET['post_id'];
    $comment=$_POST['comment'];
    if($comment==''){
        echo"<script>alert('Please fill all the available fields')</script>";
    }else{
 

        // insert query
        $insert_products="insert into `comment` (user_id, post_id, name, image,comment)
        values ('$user_id','$post_id','$name','$image','$comment')";
        $result_query=mysqli_query($con,$insert_products);
        if($result_query){
            echo"<script>alert('Successfully Added Comment')</script>";
        }
    }
}

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
  
          $select_post_rem="Select * from `post` WHERE id = '$post_id'";
          $result_query_rem=mysqli_query($con,$select_post_rem);
          $row=mysqli_fetch_assoc($result_query_rem);
  
            $post=$row['id'];
            $added=$row['added'];
            if ($added==0){
              $remove = mysqli_query($con, "UPDATE `post` SET  added='0' WHERE id = '$post_id'") or die('query failed');
            }
            else{
              $remove = mysqli_query($con, "UPDATE `post` SET  added=$added-1 WHERE id = '$post_id'") or die('query failed');
            }
   
          
  
  
          
  
  
  
  
  
  
  
        }
        //add like
         else  if ($check_like == '2'){
          $add_like = mysqli_query($con, "UPDATE `likes` SET  check_like='1' WHERE user_id = '$user_id' AND post_id = '$post_id'") or die('query failed');
      
  
          $select_post_add="Select * from `post` WHERE id = '$post_id'";
          $result_query_add=mysqli_query($con,$select_post_add);
          $row=mysqli_fetch_assoc($result_query_add);
  
            $post1=$row['id'];
            $added1=$row['added'];
  
            $remove = mysqli_query($con, "UPDATE `post` SET  added=$added1+1 WHERE id = '$post_id'") or die('query failed');
          
        
  
  
  
  
  
  
  
        }
        else{
  
          $insert_products="insert into `likes` (user_id,post_id,check_like)
          values ('$user_id','$post_id','1')";
          $result_query=mysqli_query($con,$insert_products);
          if($result_query){
              echo"<script>alert('Successfully Added Liked')</script>";
          }
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
<div style="height:50px"></div>

<a href="venpost.php?post" style="margin-left:100px;"><i class="fa-solid fa-circle-left exit-icon" style="color: #b622f1;"></i></a>

<?php
comment_main();
?>
<div class="text-center">
<h1 class="edit-banner">Comments: </h1>
</div>
<div style="height:50px"></div>

<div class="container com_top">
    <?php
    show_comment();
    ?>
</div>

<div class="container">
<div class="text-center">
<label for="prof-image" class="form-label" style="font-size: 20px;color:#a8c2ab;margin-top:100px;margin-bottom:20px;">Add Comment</label><br>
<form action="" method="post" enctype="multipart/form-data">
<textarea name="comment" id="comments" rows="10" cols="100" required="required"></textarea>
       
       <div class="form-outline mb-4 w-50 m-auto">
           <input type="submit" name="insert_comment" class="btn submit_profile_pic sub_com mb-3 px-3" value="Add Comment">
       </div>
</form>
</div>
        
</div>
<div style="height:100px"></div>
<script src="./js/script.js"></script>
</body>
</html>