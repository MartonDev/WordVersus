<?php

  $page = "Dashboard";

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

       <input class="text-input collection-name-input" id="collectionName" type="text" placeholder="Enter the name of your new collection..." value="New collection" required />

       <button class="add-btn" id="addWordCard"><i class="fas fa-plus"></i> Add another card</button>
       <button class="add-btn" id="submitNewCollection"><i class="fas fa-paper-plane"></i> Create collection</button>

       <div class="words" id="words"></div>

     </div>

   </div>

 </div>

 <script src="../../assets/js/words.js"></script>

 <script>

  addWordCard();

 </script>

<?php

  require '../../assets/inc/footer.inc.php';

 ?>
