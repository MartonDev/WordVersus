<?php

  $page = "Dashboard";

  require '../../assets/inc/header.inc.php';
  require '../../assets/inc/classes/Collection.php';
  require '../../assets/inc/classes/Quizlet.php';

  $collectionObj = new Collection();
  $quizletObj = new Quizlet();

  if(isset($_POST["collectionName"]) && isset($_POST["setURL"])) {

    if(strpos($_POST["setURL"], "quizlet.com/") !== false) {

      if(strpos($_POST["setURL"], "-flash-cards") !== false) {

        $result = "Invalid URL format!";

      }else {

        $set = $quizletObj->getWordsForSet($_POST["setURL"]);
        $collectionToPush = array();

        for($i = 0; $i < count($set); $i++) {

          $currTerm = json_decode(json_encode($set[$i]), true)["term"];
          $currDefinition = json_decode(json_encode($set[$i]), true)["definition"];
          $wordToPush = array($currTerm, $currDefinition);

          array_push($collectionToPush, $wordToPush);

        }

        $collectionObj->createCollection($_POST["collectionName"], json_encode($collectionToPush));

      }

    }else {

      $result = "Invalid URL!";

    }

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

       <h1 class="title"><a onclick="history.go(-1);" href="#" class="back-button"><i class="fas fa-chevron-left"></i></a> Import collection</h1>
       <h1>We need some information to import your <a href="https://quizlet.com/" target="_blank">quizlet</a> set</h1>

       <form action="" method="post">

         <input class="text-input collection-name-input" name="collectionName" type="text" placeholder="Enter the name of your new collection..." required />
         <input class="text-input collection-name-input" name="setURL" type="text" placeholder="Paste the quizlet set URL here..." required />

         <h1>The set URL format should be like this:</h1>
         <img src="../../assets/img/quizletquide.gif" />

         <button class="add-btn" style="display: block;"><i class="fas fa-paper-plane"></i> Import</button>

        </form>

     </div>

   </div>

 </div>

 <?php if(isset($result)) { ?>

   <script>notifyUser("Info", "<?php echo $result; ?>", 5000);</script>

 <?php } ?>

<?php

  require '../../assets/inc/footer.inc.php';

 ?>
