<?php

  $page = "Dashboard";

  require '../../assets/inc/header.inc.php';
  require '../../assets/inc/classes/Collection.php';

  $collectionObj = new Collection();
  $collections = $collectionObj->getCollections();

  if(isset($_GET["delete"])) {

    echo $collectionObj->deleteCollection($_GET["delete"]);
    header("Location: index.php?result=Deleted collection!");
    die();

  }

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

       <h1 class="title"><a onclick="history.go(-1);" href="#" class="back-button"><i class="fas fa-chevron-left"></i></a> Manage collections</h1>
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

        <a href="create.php">New collection</a>
        <br />
        <a href="import.php">Import a quizlet set</a>

     </div>

   </div>

 </div>

 <?php if(isset($_GET["result"])) { ?>

   <script>

    notifyUser("Info", "<?php echo $_GET["result"]; ?>", 5000);

   </script>

 <?php } ?>

<?php

  require '../../assets/inc/footer.inc.php';

 ?>
