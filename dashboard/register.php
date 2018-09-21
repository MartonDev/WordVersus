<?php

  $page = "Register";

  require '../assets/inc/header.inc.php';

 ?>

 <div class="login">

   <div class="container">

     <h1 class="title">Sign Up</h1>

     <img src="../assets/img/login.png" class="login-image" />

     <form action="" method="post">

       <input class="text-input usernameinput" type="text" placeholder="Username..." required />
       <input class="text-input emailinput" type="password" placeholder="Email..." required />
       <input class="text-input passwordinput" type="password" placeholder="Password..." required />
       <input class="text-input passwordinput" type="password" placeholder="Password again..." required />

       <input class="submit-button" type="submit" value="Go!" />

     </form>

   </div>

 </div>

<?php

  require '../assets/inc/footer.inc.php';

 ?>
