<?php

  $page = "Dashboard";
  $words_page = true;

  require '../../assets/inc/header.inc.php';
  require '../../assets/inc/classes/Collection.php';

  $collectionObj = new Collection();

 ?>

 <div class="dashboard">

   <div class="sidenav">

     <div class="menu">

       <a href="../index.php"><i class="fas fa-home"></i></a>
       <a href="../profile.php"><i class="fas fa-user"></i></a>
       <a href="../settings.php"><i class="fas fa-cog"></i></a>
       <a href="?logout=1"><i class="fas fa-sign-out-alt"></i></a>

       <img class="logo" src="../../assets/img/icon.png" />

     </div>

   </div>

   <div class="container">

     <div class="main">

       <h1 class="title">Create collection</h1>
       <h1>Enter the details of your new collection</h1>

       <input class="text-input collection-name-input" type="text" placeholder="Enter the name of your new collection..." value="New collection" required />

       <div class="words" id="words">

         <div class="word-element">

           <h1>Word #1</h1>

           <input class="text-input" type="text" placeholder="Word" required />
           <input class="text-input" type="text" placeholder="Definition" required />

         </div>

       </div>

     </div>

   </div>

 </div>

<?php

  require '../../assets/inc/footer.inc.php';

 ?>
