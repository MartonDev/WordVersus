<?php

  $page = "Dashboard";

  require '../assets/inc/header.inc.php';

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

       <h1 class="title">Profile</h1>

       <div class="profile-container">

         <img src="../assets/img/user.png" />

         <div class="userinfo">

           <h1 class="username">Username</h1>
           <h1 class="email">email@user.com</h1>

         </div>

       </div>

       <br />

       <h1 class="title">Stats</h1>

       <div class="table">

         <table class="stats">

           <tr>

             <td>Wins</td>
             <td class="value">10</td>

           </tr>

           <tr>

             <td>Correct words</td>
             <td class="value">10000</td>

           </tr>

           <tr>

             <td>Wrong words</td>
             <td class="value">1000</td>

           </tr>

         </table>

       </div>

     </div>

   </div>

 </div>

<?php

  require '../assets/inc/footer.inc.php';

 ?>
