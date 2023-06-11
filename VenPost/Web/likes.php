
<div style="height:100px"></div>
<div class="text-center">
<h1 class="edit-banner">My Likes <i class="fa-solid fa-heart"></i></h1>
</div>
<div style="height:100px"></div>
<div class="container-fluid top_prod">
  <?php
  $num=1;
  $array = [];
  $add=0;
  $store=0;
    $select_querys="Select * from `likes` where user_id = '$user_id' AND check_like = $num";
    $result_querys=mysqli_query($con,$select_querys);
    while($row=mysqli_fetch_assoc($result_querys)){
      $post=$row['post_id'];

      $array[] = $post;
    

}


$select_query="Select * from `post`";
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
if(in_array($post, $array)){
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
  ?>

  </div> 

  
    <div style="height:100px"></div>


