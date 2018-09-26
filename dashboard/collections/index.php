<?php

  $page = "Dashboard";

  require '../../assets/inc/header.inc.php';
  require '../../assets/inc/classes/Collection.php';

  $collectionObj = new Collection();
  $collections = $collectionObj->getCollections();

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

       <h1 class="title">Manage collections</h1>
       <h1>Select or delete a collection</h1>

       <?php

        for($i = 0; $i < count($collections); $i++) {

          echo '

            <div class="collection">

              <a href="edit.php?id=' . $collections[$i] . '" class="collection-name">' . $collectionObj->getCollection($collections[$i]) . '</a>
              <a href="?delete=' . $collections[$i] . '" class="delete-collection"><i class="fas fa-trash"></i></a>

            </div>

          ';

        }

        ?>

     </div>

   </div>

 </div>

<?php

  require '../../assets/inc/footer.inc.php';

 ?>
