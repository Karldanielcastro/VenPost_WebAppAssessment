<?php


//signup page
 function sigup(){
     if(isset($_POST['submit'])){
         global $con;


         $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $pass = mysqli_real_escape_string($con, md5($_POST['password']));
        $cpass = mysqli_real_escape_string($con, md5($_POST['cpassword']));
     
        if ($pass == $cpass){
            $select = mysqli_query($con, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass' AND name = '$name'") or die('query failed');
     
         if(mysqli_num_rows($select) > 0){
            $message[] = 'user already exist!';
         }else{
            mysqli_query($con, "INSERT INTO `user`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
            $message[] = 'registered successfully!';
           header('location:login.php');
         }
        }else{

         $message[] = 'password does not match';
        }
     
      }
      if(isset($message)){
        foreach($message as $message){
           echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
        }
     }
 }


 // Login Page
 function login(){

   global $con;
   if(isset($_POST['submit'])){

      $email = mysqli_real_escape_string($con, $_POST['email']);
      $pass = mysqli_real_escape_string($con, md5($_POST['password']));
   
      $select = mysqli_query($con, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   
      if(mysqli_num_rows($select) > 0){
         $row = mysqli_fetch_assoc($select);
         $_SESSION['user_id'] = $row['id'];
         header('location:venpost.php?post');
      }else{
         $message[] = 'incorrect password or email!';
      }
   
   }
   
 }
 if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}

// USER NAME
function user_name(){
   global $con,$user_id;

   $select_user = mysqli_query($con, "SELECT * FROM `user` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
      $name = $fetch_user['name'];
      echo"$name";
}

//PROFILE IMAGE 
function profile_image(){
   global $con,$user_id;
   $select_user = mysqli_query($con, "SELECT * FROM `user` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
      $name = $fetch_user['image'];
   
   if($name==""){
      echo"<img class=' roundend-circle profile-image image mx-auto d-block'src='https://res.cloudinary.com/dhkp0ob9v/image/upload/v1686338580/OIP_udmm42.jpg'>";
   }
   else{
      echo"<img class=' roundend-circle profile-image image mx-auto d-block'src='./profilePic/images/$name'>";
   }
}


//POST MAIN

function post_main(){
   global $con,$user_id;

   $select_query="Select * from `post` order by rand()";
    $result_query=mysqli_query($con,$select_query);
    while($row=mysqli_fetch_assoc($result_query)){
      $post=$row['id'];
      $text=$row['text'];
      $post_image1=$row['image1'];
      $date=$row['date'];
      $id=$row['user_id'];
      $profile_name=$row['name'];
      $profile_image=$row['image'];
      $add=$row['added'];
      $tag=$row['tags'];
      //check lIke
      $select_like = mysqli_query($con, "SELECT * FROM `likes` WHERE  post_id = '$post' AND user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_like) > 0){
         $fetch_like = mysqli_fetch_assoc($select_like);
      };
      $check_like = $fetch_like['check_like'];

      if($check_like== '1'){
         $icon ='solid';
      }
      else{
         $icon ='regular';
      }


      if ($post_image1 == ""){
         if ($profile_image == ""){
            echo"<div class='row justify-content-center'>
            <div class='col-md-6 ' style='margin-bottom:100px'>
               <!-- Card Start -->
               <div class='card cardprod'>
                  <!-- Name and Profile  -->
                  <h3 class='card-title name-tag'><img class='rounded-circle' style='height:60px;width:60px;margin-left:30px;margin-right:30px;'src='https://res.cloudinary.com/dhkp0ob9v/image/upload/v1686338580/OIP_udmm42.jpg'>$profile_name</h3>
                  <!-- Name and Profile end -->
                  <!-- Card Description -->
                  <div class='card-body body-prod'>
                  <h5 class='card-text ' style='margin-top: 10px; color: #a8c2ab; font-size: 15px;'>$date</h5>
                  <br>
                  <h5 class='card-text card-texts'>$text</h5>
                  <i class='fa-solid fa-hashtag float-start' style='color: #a8c2ab ;font-size:15px;margin-top:60px;margin-right:10px'> $tag</i>
                  <a href='com_post.php?post_id=$post'class='btn float-end cart'><i class='fa-solid fa-comment' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></a>
                  <form action='' method='post'>
                  <button name='subject' type='submit' value='$post' class='btn float-end cart'><i class='fa-$icon fa-heart' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></button>
               </form> 
                  </div>
                  <!-- Card Des End -->
               </div>
            </div>
         </div>";
         }else{
         echo"<div class='row justify-content-center'>
         <div class='col-md-6 ' style='margin-bottom:100px'>
            <!-- Card Start -->
            <div class='card cardprod'>
               <!-- Name and Profile  -->
               <h3 class='card-title name-tag'><img class='rounded-circle' style='height:60px;width:60px;margin-left:30px;margin-right:30px;' src='./profilePic/images/$profile_image'>$profile_name</h3>
               <!-- Name and Profile end -->
               <!-- Card Description -->
               <div class='card-body body-prod'>
               <h5 class='card-text ' style='margin-top: 10px; color: #a8c2ab; font-size: 15px;'>$date</h5>
               <br>
               <h5 class='card-text card-texts'>$text</h5>
               <i class='fa-solid fa-hashtag float-start' style='color: #a8c2ab ;font-size:15px;margin-top:60px;margin-right:10px'> $tag</i>
               <a href='com_post.php?post_id=$post'class='btn float-end cart'><i class='fa-solid fa-comment' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></a> 
               <form action='' method='post'>
               <button name='subject' type='submit' value='$post' class='btn float-end cart'><i class='fa-$icon fa-heart' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></button>
            </form>
               </div>
               <!-- Card Des End -->
            </div>
         </div>
      </div>";
         }
      }
      else{
         if ($profile_image == ""){
            echo"<div class='row justify-content-center'>
                <div class='col-md-6 ' style='margin-bottom:100px'>
                   <!-- Card Start -->
                   <div class='card cardprod'>
                      <!-- Name and Profile  -->
                      <h3 class='card-title name-tag'><img class='rounded-circle' style='height:60px;width:60px;margin-left:30px;margin-right:30px;'src='https://res.cloudinary.com/dhkp0ob9v/image/upload/v1686338580/OIP_udmm42.jpg'>$profile_name</h3>
                      <!-- Name and Profile end -->
                      <!-- Image Slider -->
                      <div id='carouselExampleIndicators' class='carousel slide'>
                      <div class='carousel-inner'>
                         <div class='carousel-item active'>
                            <img src='post/$post_image1' class='d-block w-100 card-img-size' alt='...'>
                         </div>
                      </div>
                      </div>
                      <!-- Image slider End -->
                      <!-- Card Description -->
                      <div class='card-body body-prod'>
                      <h5 class='card-text ' style='margin-top: 10px; color: #a8c2ab; font-size: 15px;'>$date</h5>
                      <br>
                      <h5 class='card-text card-texts'>$text</h5>
                      <i class='fa-solid fa-hashtag float-start' style='color: #a8c2ab ;font-size:15px;margin-top:60px;margin-right:10px'> $tag</i>
                      <a href='com_post.php?post_id=$post'class='btn float-end cart'><i class='fa-solid fa-comment' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></a> 
                      <form action='' method='post'>
                      <button name='subject' type='submit' value='$post' class='btn float-end cart'><i class='fa-$icon fa-heart' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></button>
                   </form>
                      </div>
                      <!-- Card Des End -->
                   </div>
                </div>
             </div>";
         }
         else{
      echo"<div class='row justify-content-center'>
                <div class='col-md-6 ' style='margin-bottom:100px'>
                   <!-- Card Start -->
                   <div class='card cardprod'>
                      <!-- Name and Profile  -->
                      <h3 class='card-title name-tag'><img class='rounded-circle' style='height:60px;width:60px;margin-left:30px;margin-right:30px;' src='./profilePic/images/$profile_image'>$profile_name</h3>
                      <!-- Name and Profile end -->
                      <!-- Image Slider -->
                      <div id='carouselExampleIndicators' class='carousel slide'>
                      <div class='carousel-inner'>
                         <div class='carousel-item active'>
                            <img src='post/$post_image1' class='d-block w-100 card-img-size' alt='...'>
                         </div>
                      </div>
                      </div>
                      <!-- Image slider End -->
                      <!-- Card Description -->
                      <div class='card-body body-prod'>
                      <h5 class='card-text ' style='margin-top: 10px; color: #a8c2ab; font-size: 15px;'>$date</h5>
                      <br>
                      <h5 class='card-text card-texts'>$text</h5>
                      <i class='fa-solid fa-hashtag float-start' style='color: #a8c2ab ;font-size:15px;margin-top:60px;margin-right:10px'> $tag</i>
                      <a href='com_post.php?post_id=$post'class='btn float-end cart'><i class='fa-solid fa-comment' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></a> 
                      <form action='' method='post'>
                        <button name='subject' type='submit' value='$post' class='btn float-end cart'><i class='fa-$icon fa-heart' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></button>
                     </form>
                      </div>
                      <!-- Card Des End -->
                   </div>
                </div>
             </div>";
         }
      }
    }
   }

   // POST PROFILE
   function post_profile(){
      global $con,$user_id;
   
      $select_query="Select * from `post` where user_id = '$user_id'";
       $result_query=mysqli_query($con,$select_query);
       while($row=mysqli_fetch_assoc($result_query)){
         $post=$row['id'];
         $text=$row['text'];
         $post_image1=$row['image1'];
         $date=$row['date'];
         $id=$row['user_id'];
         $profile_name=$row['name'];
         $profile_image=$row['image'];
         $add=$row['added'];
         $tag=$row['tags'];
      //check lIke
      $select_like = mysqli_query($con, "SELECT * FROM `likes` WHERE  post_id = '$post' AND user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_like) > 0){
         $fetch_like = mysqli_fetch_assoc($select_like);
      };
      $check_like = $fetch_like['check_like'];

      if($check_like== '1'){
         $icon ='solid';
      }
      else{
         $icon ='regular';
      }
   
         if ($post_image1 == ""){
            if ($profile_image == ""){
               echo"<div class='row justify-content-center'>
               <div class='col-md-6 ' style='margin-bottom:100px'>
                  <!-- Card Start -->
                  <div class='card cardprod'>
                     <!-- Name and Profile  -->
                     <h3 class='card-title name-tag'><img class='rounded-circle' style='height:60px;width:60px;margin-left:30px;margin-right:30px;'src='https://res.cloudinary.com/dhkp0ob9v/image/upload/v1686338580/OIP_udmm42.jpg'>$profile_name</h3>
                     <!-- Name and Profile end -->
                     <!-- Card Description -->
                     <div class='card-body body-prod'>
                     <h5 class='card-text ' style='margin-top: 10px; color: #a8c2ab; font-size: 15px;'>$date</h5>
                     <br>
                     <h5 class='card-text card-texts'>$text</h5>
                     <i class='fa-solid fa-hashtag float-start' style='color: #a8c2ab ;font-size:15px;margin-top:60px;margin-right:10px'> $tag</i>
                     <a href='com_post.php?post_id=$post'class='btn float-end cart'><i class='fa-solid fa-comment' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></a> 
                     <form action='' method='post'>
                     <button name='subject' type='submit' value='$post' class='btn float-end cart'><i class='fa-$icon fa-heart' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></button>
                  </form>
                     </div>
                     <!-- Card Des End -->
                  </div>
               </div>
            </div>";
            }else{
            echo"<div class='row justify-content-center'>
            <div class='col-md-6 ' style='margin-bottom:100px'>
               <!-- Card Start -->
               <div class='card cardprod'>
                  <!-- Name and Profile  -->
                  <h3 class='card-title name-tag'><img class='rounded-circle' style='height:60px;width:60px;margin-left:30px;margin-right:30px;' src='./profilePic/images/$profile_image'>$profile_name</h3>
                  <!-- Name and Profile end -->
                  <!-- Card Description -->
                  <div class='card-body body-prod'>
                  <h5 class='card-text ' style='margin-top: 10px; color: #a8c2ab; font-size: 15px;'>$date</h5>
                  <br>
                  <h5 class='card-text card-texts'>$text</h5>
                  <i class='fa-solid fa-hashtag float-start' style='color: #a8c2ab ;font-size:15px;margin-top:60px;margin-right:10px'> $tag</i>
                  <a href='com_post.php?post_id=$post'class='btn float-end cart'><i class='fa-solid fa-comment' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></a> 
                  <form action='' method='post'>
                  <button name='subject' type='submit' value='$post' class='btn float-end cart'><i class='fa-$icon fa-heart' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></button>
               </form>
                  </div>
                  <!-- Card Des End -->
               </div>
            </div>
         </div>";
            }
         }
         else{
            if ($profile_image == ""){
               echo"<div class='row justify-content-center'>
                   <div class='col-md-6 ' style='margin-bottom:100px'>
                      <!-- Card Start -->
                      <div class='card cardprod'>
                         <!-- Name and Profile  -->
                         <h3 class='card-title name-tag'><img class='rounded-circle' style='height:60px;width:60px;margin-left:30px;margin-right:30px;'src='https://res.cloudinary.com/dhkp0ob9v/image/upload/v1686338580/OIP_udmm42.jpg'>$profile_name</h3>
                         <!-- Name and Profile end -->
                         <!-- Image Slider -->
                         <div id='carouselExampleIndicators' class='carousel slide'>
                         <div class='carousel-inner'>
                            <div class='carousel-item active'>
                               <img src='post/$post_image1' class='d-block w-100 card-img-size' alt='...'>
                            </div>
                         </div>
                         </div>
                         <!-- Image slider End -->
                         <!-- Card Description -->
                         <div class='card-body body-prod'>
                         <h5 class='card-text ' style='margin-top: 10px; color: #a8c2ab; font-size: 15px;'>$date</h5>
                         <br>
                         <h5 class='card-text card-texts'>$text</h5>
                         <i class='fa-solid fa-hashtag float-start' style='color: #a8c2ab ;font-size:15px;margin-top:60px;margin-right:10px'> $tag</i>
                         <a href='com_post.php?post_id=$post'class='btn float-end cart'><i class='fa-solid fa-comment' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></a> 
                         <form action='' method='post'>
                         <button name='subject' type='submit' value='$post' class='btn float-end cart'><i class='fa-$icon fa-heart' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></button>
                      </form>
                         </div>
                         <!-- Card Des End -->
                      </div>
                   </div>
                </div>";
            }
            else{
         echo"<div class='row justify-content-center'>
                   <div class='col-md-6 ' style='margin-bottom:100px'>
                      <!-- Card Start -->
                      <div class='card cardprod'>
                         <!-- Name and Profile  -->
                         <h3 class='card-title name-tag'><img class='rounded-circle' style='height:60px;width:60px;margin-left:30px;margin-right:30px;' src='./profilePic/images/$profile_image'>$profile_name</h3>
                         <!-- Name and Profile end -->
                         <!-- Image Slider -->
                         <div id='carouselExampleIndicators' class='carousel slide'>
                         <div class='carousel-inner'>
                            <div class='carousel-item active'>
                               <img src='post/$post_image1' class='d-block w-100 card-img-size' alt='...'>
                            </div>
                         </div>
                         </div>
                         <!-- Image slider End -->
                         <!-- Card Description -->
                         <div class='card-body body-prod'>
                         <h5 class='card-text ' style='margin-top: 10px; color: #a8c2ab; font-size: 15px;'>$date</h5>
                         <br>
                         <h5 class='card-text card-texts'>$text</h5>
                         <i class='fa-solid fa-hashtag float-start' style='color: #a8c2ab ;font-size:15px;margin-top:60px;margin-right:10px'> $tag</i>
                         <a href='com_post.php?post_id=$post'class='btn float-end cart'><i class='fa-solid fa-comment' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></a> 
                         <form action='' method='post'>
                         <button name='subject' type='submit' value='$post' class='btn float-end cart'><i class='fa-$icon fa-heart' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></button>
                      </form>
                         </div>
                         <!-- Card Des End -->
                      </div>
                   </div>
                </div>";
            }
         }
       }
      }

      //Comment Page
      function comment_main(){

         global $con,$user_id;

         $post_id = $_GET['post_id'];

         $select_query="Select * from `post` where id = '$post_id '";
       $result_query=mysqli_query($con,$select_query);
       while($row=mysqli_fetch_assoc($result_query)){
         $post=$row['id'];
         $text=$row['text'];
         $post_image1=$row['image1'];
         $date=$row['date'];
         $id=$row['user_id'];
         $profile_name=$row['name'];
         $profile_image=$row['image'];
         $add=$row['added'];
         $tag=$row['tags'];
      //check lIke
      $select_like = mysqli_query($con, "SELECT * FROM `likes` WHERE  post_id = '$post' AND user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_like) > 0){
         $fetch_like = mysqli_fetch_assoc($select_like);
      };
      $check_like = $fetch_like['check_like'];

      if($check_like== '1'){
         $icon ='solid';
      }
      else{
         $icon ='regular';
      }
   
         if ($post_image1 == ""){
            if ($profile_image == ""){
               echo"<div class='row justify-content-center'>
               <div class='col-md-6 ' style='margin-bottom:100px'>
                  <!-- Card Start -->
                  <div class='card cardprod'>
                     <!-- Name and Profile  -->
                     <h3 class='card-title name-tag'><img class='rounded-circle' style='height:60px;width:60px;margin-left:30px;margin-right:30px;'src='https://res.cloudinary.com/dhkp0ob9v/image/upload/v1686338580/OIP_udmm42.jpg'>$profile_name</h3>
                     <!-- Name and Profile end -->
                     <!-- Card Description -->
                     <div class='card-body body-prod'>
                     <h5 class='card-text ' style='margin-top: 10px; color: #a8c2ab; font-size: 15px;'>$date</h5>
                     <br>
                     <h5 class='card-text card-texts'>$text</h5>
                     <i class='fa-solid fa-hashtag float-start' style='color: #a8c2ab ;font-size:15px;margin-top:60px;margin-right:10px'> $tag</i>
                     <a href='#'class='btn float-end cart'><i class='fa-solid fa-comment' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></a> 
                     <form action='' method='post'>
                     <button name='subject' type='submit' value='$post' class='btn float-end cart'><i class='fa-$icon fa-heart' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></button>
                  </form>
                     </div>
                     <!-- Card Des End -->
                  </div>
               </div>
            </div>";
            }else{
            echo"<div class='row justify-content-center'>
            <div class='col-md-6 ' style='margin-bottom:100px'>
               <!-- Card Start -->
               <div class='card cardprod'>
                  <!-- Name and Profile  -->
                  <h3 class='card-title name-tag'><img class='rounded-circle' style='height:60px;width:60px;margin-left:30px;margin-right:30px;' src='./profilePic/images/$profile_image'>$profile_name</h3>
                  <!-- Name and Profile end -->
                  <!-- Card Description -->
                  <div class='card-body body-prod'>
                  <h5 class='card-text ' style='margin-top: 10px; color: #a8c2ab; font-size: 15px;'>$date</h5>
                  <br>
                  <h5 class='card-text card-texts'>$text</h5>
                  <i class='fa-solid fa-hashtag float-start' style='color: #a8c2ab ;font-size:15px;margin-top:60px;margin-right:10px'> $tag</i>
                  <a href='#'class='btn float-end cart'><i class='fa-solid fa-comment' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></a> 
                  <form action='' method='post'>
                  <button name='subject' type='submit' value='$post' class='btn float-end cart'><i class='fa-$icon fa-heart' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></button>
               </form>
                  </div>
                  <!-- Card Des End -->
               </div>
            </div>
         </div>";
            }
         }
         else{
            if ($profile_image == ""){
               echo"<div class='row justify-content-center'>
                   <div class='col-md-6 ' style='margin-bottom:100px'>
                      <!-- Card Start -->
                      <div class='card cardprod'>
                         <!-- Name and Profile  -->
                         <h3 class='card-title name-tag'><img class='rounded-circle' style='height:60px;width:60px;margin-left:30px;margin-right:30px;'src='https://res.cloudinary.com/dhkp0ob9v/image/upload/v1686338580/OIP_udmm42.jpg'>$profile_name</h3>
                         <!-- Name and Profile end -->
                         <!-- Image Slider -->
                         <div id='carouselExampleIndicators' class='carousel slide'>
                         <div class='carousel-inner'>
                            <div class='carousel-item active'>
                               <img src='post/$post_image1' class='d-block w-100 card-img-size' alt='...'>
                            </div>
                         </div>
                         </div>
                         <!-- Image slider End -->
                         <!-- Card Description -->
                         <div class='card-body body-prod'>
                         <h5 class='card-text ' style='margin-top: 10px; color: #a8c2ab; font-size: 15px;'>$date</h5>
                         <br>
                         <h5 class='card-text card-texts'>$text</h5>
                         <i class='fa-solid fa-hashtag float-start' style='color: #a8c2ab ;font-size:15px;margin-top:60px;margin-right:10px'> $tag</i>
                         <a href='#'class='btn float-end cart'><i class='fa-solid fa-comment' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></a> 
                         <form action='' method='post'>
                         <button name='subject' type='submit' value='$post' class='btn float-end cart'><i class='fa-$icon fa-heart' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></button>
                      </form>
                         </div>
                         <!-- Card Des End -->
                      </div>
                   </div>
                </div>";
            }
            else{
         echo"<div class='row justify-content-center'>
                   <div class='col-md-6 ' style='margin-bottom:100px'>
                      <!-- Card Start -->
                      <div class='card cardprod'>
                         <!-- Name and Profile  -->
                         <h3 class='card-title name-tag'><img class='rounded-circle' style='height:60px;width:60px;margin-left:30px;margin-right:30px;' src='./profilePic/images/$profile_image'>$profile_name</h3>
                         <!-- Name and Profile end -->
                         <!-- Image Slider -->
                         <div id='carouselExampleIndicators' class='carousel slide'>
                         <div class='carousel-inner'>
                            <div class='carousel-item active'>
                               <img src='post/$post_image1' class='d-block w-100 card-img-size' alt='...'>
                            </div>
                         </div>
                         </div>
                         <!-- Image slider End -->
                         <!-- Card Description -->
                         <div class='card-body body-prod'>
                         <h5 class='card-text ' style='margin-top: 10px; color: #a8c2ab; font-size: 15px;'>$date</h5>
                         <br>
                         <h5 class='card-text card-texts'>$text</h5>
                         <i class='fa-solid fa-hashtag float-start' style='color: #a8c2ab ;font-size:15px;margin-top:60px;margin-right:10px'> $tag</i>
                         <a href='#'class='btn float-end cart'><i class='fa-solid fa-comment' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></a> 
                         <form action='' method='post'>
                         <button name='subject' type='submit' value='$post' class='btn float-end cart'><i class='fa-$icon fa-heart' style='color: #e4d9d7;font-size:20px;margin-top:50px;margin-right:10px'></i></button>
                      </form>
                         </div>
                         <!-- Card Des End -->
                      </div>
                   </div>
                </div>";
            }
         }
       }
      }
   
  //Comment
  
  function show_comment(){
   global $con;

   $comment_id = $_GET['post_id'];

   $select_query="Select * from `comment` where post_id = '$comment_id '";
   $result_query=mysqli_query($con,$select_query);
   while($row=mysqli_fetch_assoc($result_query)){
      $name=$row['name'];
      $image=$row['image'];
      $comment=$row['comment'];

      if($image ==""){
         echo" <div class='comment'>
      <h3 class='card-title name-tag-search'><img class='rounded-circle image-search' src='https://res.cloudinary.com/dhkp0ob9v/image/upload/v1686338580/OIP_udmm42.jpg'>$name</h3>
      <br>
      <p class='comment_p'>$comment</p>
  </div>";
      }else{
         echo" <div class='comment'>
      <h3 class='card-title name-tag-search'><img class='rounded-circle image-search' src='profilePic/images/$image'>$name</h3>
      <br>
      <p class='comment_p'>$comment</p>
  </div>";
      }
      
  }
  }

?>