<?php

  $page = "Dashboard";

  require '../assets/inc/header.inc.php';

  if(isset($_POST["email-change"])) {

    $result = $userObj->changeEmail($_POST["email"]);

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

       <form action="" method="post">

         <label class="fileContainer"><span class="fileText">Upload an image</span><input class="fileinput" type="file" accept=".png, .jpg, .jpeg, .gif" required /></label>
         <img src="../assets/img/loading.gif" class="imageElement" />
         <input class="submit-button" type="submit" value="Set!" />

       </form>

       <h1>Change email</h1>

       <form action="" method="post">

         <input class="text-input" type="email" name="email" placeholder="New email..." required />
         <input class="submit-button" type="submit" name="email-change" value="Go!" />

       </form>

       <h1>Change password</h1>

       <form action="" method="post">

         <input class="text-input" type="password" placeholder="Old password..." required />
         <input class="text-input" type="password" placeholder="New password..." required />
         <input class="text-input" type="password" placeholder="New password again..." required />
         <input class="submit-button" type="submit" value="Go!" />

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
