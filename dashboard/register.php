<?php

  $page = "Register";

  require '../assets/inc/header.inc.php';

  if(isset($_POST["register-submit"])) {

    if($_POST["password1"] != $_POST["password2"]) {

      $result = "Passwords don't match";

    }else {

      $result = $userObj->signUp($_POST["username"], $_POST["email"], $_POST["password1"]);

    }

  }

 ?>

 <div class="login">

   <div class="container">

     <h1 class="title">Sign Up</h1>

     <img src="../assets/img/login.png" class="login-image" />

     <form action="" method="post">

       <input class="text-input usernameinput" type="text" name="username" placeholder="Username..." required />
       <input class="text-input emailinput" type="email" name="email" placeholder="Email..." required />
       <input class="text-input passwordinput check" type="password" name="password1" minWidth="5" placeholder="Password..." pattern=".{5,}" required />
       <input class="text-input passwordinput check" type="password" name="password2" minWidth="5" placeholder="Password again..." required />

       <input class="submit-button" type="submit" name="register-submit" value="Go!" />

       <a href="login.php">Log In</a>

     </form>

   </div>

    <?php if(isset($result)) { ?>

      <script>

       notifyUser("Info", '<?php echo $result; ?>', 12500);

      </script>

    <?php } ?>

 </div>

<?php

  require '../assets/inc/footer.inc.php';

 ?>
