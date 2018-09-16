<?php

  $page = "Home";

  require 'assets/inc/header.inc.php';

 ?>

 <div class="landing" id="landing">

   <div class="nav" id="nav">

     <a href="#" class="logo"><?php echo SITE_NAME ?></a>

     <div class="nav-menu">

       <a href="#landing">Home</a>
       <a href="#features">Features</a>
       <a href="#integrations">More</a>
       <a href="dashboard/">Sign In</a>

     </div>

     <a href="javascript:void(0);" class="burger" onclick="openNav()"><div id="burger-icon" class="burger-icon"><div class="bar bar1"></div><div class="bar bar2"></div><div class="bar bar3"></div></div></a>

   </div>

   <div class="container">

     <h1 class="slogan"><?php echo SITE_DESCRIPTION ?></h1>
     <a href="#features" class="bordered-button">Get Started</a>

   </div>

   <div class="bottom-wave"></div>

 </div>

 <div class="features" id="features">

   <h1 class="section-title">Useful Features<span></span></h1>

   <p>

     <div class="feature">

       <div class="feature-icon">

         <i class="fas fa-dollar-sign"></i>

       </div>

       <h1 class="feature-title">Free</h1>
       <h1 class="feature-description">WordVersus is a free for all service. Register an account, comfirm it by your email, and you can create your own, customized game!</h1>

     </div>

     <div class="feature">

       <div class="feature-icon">

         <i class="fas fa-project-diagram"></i>

       </div>

       <h1 class="feature-title">Modern user interface</h1>
       <h1 class="feature-description">WordVersus has it's own, custom coded frontend. Take the lead with the easy to use, clean and modern dashboard!</h1>

     </div>

     <div class="feature">

       <div class="feature-icon">

         <i class="fas fa-user-friends"></i>

       </div>

       <h1 class="feature-title">Measure your skills</h1>
       <h1 class="feature-description">WordVersus provides you a private server, where you can play with your friends, anywhere, anyime. Just generate a game-code, and you are ready go!</h1>

     </div>

     <div class="feature">

       <div class="feature-icon">

         <i class="fas fa-hourglass-start"></i>

       </div>

       <h1 class="feature-title">Play smart</h1>
       <h1 class="feature-description">If you choose the wrong word, your score will be reseted. Always think twice before giving the answer!</h1>

     </div>

     <div class="feature">

       <div class="feature-icon">

         <i class="fas fa-bolt"></i>

       </div>

       <h1 class="feature-title">Be fast</h1>
       <h1 class="feature-description">There is no time limit, but the first team to finish, wins the game. Be quick and beat your opponents!</h1>

     </div>

   </p>

 </div>

 <div class="bottom-wave-2"></div>

 <div class="integrations" id="integrations">

   <p>

     <div class="integration">

       <h1 class="integration-title">Best for teachers<br /><span></span></h1>
       <h1 class="integration-description">Teach words, in the fun way! WordVersus is designed for learning words as fast as possible and to make fun at once. Using our site, you can bring more content, and education to your lessons.</h1>

     </div>

     <img class="integration-icon" src="assets/img/teacher.png">

     <div class="space"></div>

     <img class="integration-icon" src="assets/img/student.png">

     <div class="integration">

       <h1 class="integration-title">Made for students<br /><span></span></h1>
       <h1 class="integration-description">No more boring word learning. Use WordVersus to play with your friends and have fun, while memorizing the words, for tomorrow's test.</h1>

     </div>

   </p>

 </div>

 <div class="signup-line">

   <h1>Join the WordVersus community today!</h1>
   <a href="dashboard/" class="bordered-button">Sign Up</a>

 </div>

 <div class="footer">

   <div class="left">

     <h1 class="title">WordVersus<br /><span></span></h1>

     <a href="#landing">Home</a>
     <a href="#features">Features</a>
     <a href="#integrations">More</a>
     <a href="dashboard/">Sign In</a>

   </div>

   <div class="right">

     <h1 class="author">Made with ♥ by Marton. Copyright (c) <?php echo date("Y") ?></h1>

   </div>

 </div>

 <div class="scrollTop animated faster" id="scrollTop">

   <a href="#landing"><i class="fas fa-arrow-up"></i></a>

 </div>

<?php

  require 'assets/inc/footer.inc.php';

 ?>
