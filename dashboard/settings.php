<?php

  $page = "Dashboard";

  require '../assets/inc/header.inc.php';

  if(isset($_POST["email-change"])) {

    $result = $userObj->changeEmail($_POST["email"]);

  }

  if(isset($_POST["password-change"])) {

    if($_POST["new-password"] == $_POST["new-password-again"]) {

      $result = $userObj->changePassword($_POST["old-password"], $_POST["new-password"]);

    }else {

      $result = "New passwords are not the same!";

    }

  }

  if(isset($_POST["avatar-submit"])) {

    if(!empty($_FILES['avatar'])) {

      $dir = realpath(__DIR__ . '/..') . "/assets/img/avatars/";

      $name = $_FILES["avatar"]["name"];
      $extArray = explode(".", $name);
      $ext = $extArray[count($extArray) - 1];

      if($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif") {

        $path = $dir . $userObj->getUsername() . "." . $ext;

        if(move_uploaded_file($_FILES['avatar']['tmp_name'], $path)) {

          $result = "Successfuly changed your profile picture!";

        }else {

          $result = "There was an error uploading your image, please try again!";

        }

      }else {

        $result = "Your avatar can only have a .png, .jpg, .jpeg or .gif extension!";

      }

    }

  }

 ?>

 <div class="dashboard">

   <div class="sidenav">

     <div class="menu">

       <a href="index.php"><i class="fas fa-home"></i></a>
       <a href="profile.php"><i class="fas fa-user"></i></a>
       <a href="settings.php"><i class="fas fa-cog"></i></a>
       <a href="?logout=1"><i class="fas fa-sign-out-alt"></i></a>

       <img class="logo" src="../assets/img/icon.png" />

     </div>

   </div>

   <div class="container">

     <div class="main">

       <h1 class="title">Settings</h1>

       <h1>Change avatar</h1>

       <form enctype="multipart/form-data" action="" method="post">

         <label class="fileContainer"><span class="fileText">Upload an image</span><input class="fileinput" type="file" accept=".png, .jpg, .jpeg, .gif" name="avatar" required /></label>
         <img src="../assets/img/loading.gif" class="imageElement" />
         <input class="submit-button" type="submit" name="avatar-submit" value="Set!" />

       </form>

       <h1>Change email</h1>

       <form action="" method="post">

         <input class="text-input" type="email" name="email" placeholder="New email..." required />
         <input class="submit-button" type="submit" name="email-change" value="Go!" />

       </form>

       <h1>Change password</h1>

       <form action="" method="post">

         <input class="text-input" type="password" name="old-password" placeholder="Old password..." required />
         <input class="text-input" type="password" name="new-password" placeholder="New password..." pattern=".{7,}" required />
         <input class="text-input" type="password" name="new-password-again" placeholder="New password again..." pattern=".{7,}" required />
         <input class="submit-button" type="submit" name="password-change" value="Go!" />

       </form>

     </div>

   </div>

 </div>

 <?php if(isset($result)) { ?>

   <script>

    notifyUser("Info", "<?php echo $result; ?>", 4000);

   </script>

 <?php } ?>

<?php

  require '../assets/inc/footer.inc.php';

 ?>
