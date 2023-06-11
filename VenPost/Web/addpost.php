<?php
$user_id = $_SESSION['user_id'];
if(isset($_POST['insert_post'])){


    $select_user = mysqli_query($con, "SELECT * FROM `user` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
      $name = $fetch_user['name'];
      $image = $fetch_user['image'];
    $descriptions=$_POST['description'];
    $tag=$_POST['tag'];

    // accessing images
    $image_post1=$_FILES['image_post1']['name'];

   
    // accessing image tmp name
    $temp_image1=$_FILES['image_post1']['tmp_name'];


    //checking empty condition
    if($descriptions==''){
       
    }else{
        move_uploaded_file( $temp_image1,"./post/$image_post1");
 

        // insert query
        $insert_products="insert into `post` (user_id,image1,text,date,name,image,tags)
        values ('$user_id','$image_post1','$descriptions',NOW(),'$name','$image','$tag')";
        $result_query=mysqli_query($con,$insert_products);
        if($result_query){
            echo"<script>alert('Successfully Added Journey')</script>";
        }
    }
}

?>

<div style="height:50px"></div>
<div class="container ">
<div class="text-center">
    <div style="height:50px"></div>
    <h1 class="edit-banner">Add your journey</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <!-- Image 1 -->
    <div class="form-outline mb-4 w-50 m-auto">
        <label for="prof-image" class="form-label" style="font-size: 20px;color:#a8c2ab;margin-top:100px;margin-bottom:20px;">Add Image Journey</label>
        <input type="file" name="image_post1" id="product_image1" class="form-control">
    </div>
    <div class="form-outline mb-4 w-50 m-auto">
                <label for="prof-image" class="form-label" style="font-size: 20px;color:#a8c2ab;margin-top:100px;">Add Tag</label>
                <input type="text" name="tag" id="product_dimensions" class="form-control form-change" placeholder="Enter Tag" autocomplete="off" required="required">
            </div>
    <label for="prof-image" class="form-label" style="font-size: 20px;color:#a8c2ab;margin-top:100px;margin-bottom:20px;">Add Experience</label><br>
        <textarea name="description" id="comments" rows="10" cols="50" required="required"></textarea>
       
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_post" class="btn submit_profile_pic mb-3 px-3" value="Add Post">
            </div>
</form>
</div>
<div style="height:100px"></div>