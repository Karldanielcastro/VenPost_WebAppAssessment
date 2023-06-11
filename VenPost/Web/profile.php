<div style="height:50px"></div>
<div class="container profile-banner">
    <?php profile_image()?>
    <h1 class="text-center profile-name"><?php user_name()?></h1>
    <div class="text-center">
    <a href="profilePic/edit.php" class="profile-edit"> <i class="fa-solid fa-pencil" style="color: #b622f1;"></i> Edit Profile</a>
    </div>
    
    <div style="height:100px"></div>

</div>
<div class="container-fluid top_prod">
  <?php
  post_profile();
  ?>

  </div>
  <div style="height:100px"></div>
</div>