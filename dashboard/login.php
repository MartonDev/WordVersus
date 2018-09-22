<?php

  $page = "Login";

  require '../assets/inc/header.inc.php';

  if(isset($_POST["login-submit"])) {

    if($userObj->logIn($_POST["username"], $_POST["password"])) {

      header("Location: index.php");
      die();

    }else {

      echo "no";

    }

  }

 ?>

 <div class="login">

   <div class="container">

     <h1 class="title">Log In</h1>

     <img src="../assets/img/login.png" class="login-image" />

     <form action="" method="post">

       <input class="text-input usernameinput" name="username" type="text" placeholder="Username..." required />
       <input class="text-input passwordinput" name="password" type="password" placeholder="Password..." required />

       <input class="submit-button" name="login-submit" type="submit" value="Go!" />

       <a href="register.php">Sign Up</a> or <a href="#">Forgotten password</a>

     </form>

   </div>

 </div>

<?php

  require '../assets/inc/footer.inc.php';

 ?>
