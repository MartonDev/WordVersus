<?php

  $page = "Dashboard";

  require '../../assets/inc/header.inc.php';
  require '../../assets/inc/classes/Collection.php';
  require '../../assets/inc/classes/Game.php';

  $gameObj = new Game();
  $collectionObj = new Collection();
  $collections = $collectionObj->getCollections();

  if(!isset($_GET["game_code"])) {

    header("Location: ../index.php");
    die();

  }else if(!$gameObj->exists($_GET["game_code"])) {

    header("Location: ../index.php");
    die();

  }

  if($gameObj->getHosterID($_GET["game_code"]) != $userObj->getUserId()) {

    header("Location: ../index.php");
    die();

  }

  if(count($collections) == 0) {

    header("Location: ../collections/index.php?result=Please create a collection, before starting a game!");
    die();

  }

  if($collectionObj->getWordCountForCollection($gameObj->getCollectionForGame($_GET["game_code"])) >= 12) {

    $found = false;

    for($i = 0; $i < count($collections); $i++) {

      if($collectionObj->getWordCountForCollection($collections[$i]) >= 12) {

        $gameObj->setCollection($_GET["game_code"], $collections[$i]);
        $found = true;
        break;

      }

    }

    if(!$found) {

      header("Location: ../collections/index.php?result=You need a collection with at least 12 words!");
      die();

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

       <h1 class="title">Create game</h1>
       <h1>Edit the details of your new game</h1>

       <h1>Select collection (you need at least 12 words in it)</h1>
       <select class="select" id="collectionSelect">

         <?php

            for($i = 0;$i < count($collections);$i++) {

              if($collectionObj->getWordCountForCollection($collections[$i]) >= 12) {

                if($gameObj->getCollectionForGame($_GET["game_code"]) == $collections[$i]) {

                  echo '<option value="' . $collections[$i] . '" selected>' . $collectionObj->getCollection($collections[$i]) . '</option>';

                }else {

                  echo '<option value="' . $collections[$i] . '">' . $collectionObj->getCollection($collections[$i]) . '</option>';

                }

              }else {

                echo '<option value="' . $collections[$i] . '" disabled>' . $collectionObj->getCollection($collections[$i]) . '</option>';

              }

            }

          ?>

       </select>

       <h1>Game code</h1>
       <h1 class="game-code-admin"><?php echo substr($_GET["game_code"], 0, 3) . "-" . substr($_GET["game_code"], 3, 5); ?></h1>
       <button class="add-btn" id="startGame"><i class="fas fa-paper-plane"></i> Start game</button>
       <button class="add-btn" id="shuffle"><i class="fas fa-sync"></i> Shuffle teams</button>

       <div id="playersDiv" class="playersDiv"></div>

     </div>

   </div>

 </div>

 <script>

    var players;

    $.get("../../assets/inc/lives/players.php", {game_code: <?php echo $_GET["game_code"]; ?>}, function(data) {

      players = data;
      <?php echo '$("#playersDiv").load("../../assets/inc/lives/players.php?game_code=' . $_GET["game_code"] . '");'; ?>

    });

    $.get("../../assets/inc/lives/setcollection.php", {game_code: <?php echo $_GET["game_code"]; ?>, id: $('#collectionSelect').val()});

    setInterval(function() {

      $.get("../../assets/inc/lives/players.php", {game_code: <?php echo $_GET["game_code"]; ?>}, function(data) {

        if(players != data) {

          players = data;
          <?php echo '$("#playersDiv").load("../../assets/inc/lives/players.php?game_code=' . $_GET["game_code"] . '");'; ?>

        }

      });

    }, 200);

    function kickUser(userID) {

      $.get("../../assets/inc/lives/kickuser.php", {id: userID, game_code: <?php echo $_GET["game_code"]; ?>});

    }

    $(document).on('change', '#collectionSelect', function() {

      $.get("../../assets/inc/lives/setcollection.php", {game_code: <?php echo $_GET["game_code"]; ?>, id: $('#collectionSelect').val()});

    });

    $("#startGame").click(function() {

      $.get("../../assets/inc/lives/playercount.php", {game_code: <?php echo $_GET["game_code"]; ?>}, function(data) {

        if(Number(data) < 4) {

          neededAmount = 4 - Number(data);
          notifyUser("Info", "You need " + neededAmount + " more players to start a game!", 4500);

        }else {

          window.location.href = "stats.php?game_code=<?php echo $_GET["game_code"]; ?>";

        }

      });

    });

    $("#shuffle").click(function() {

      $.get("../../assets/inc/lives/reorder.php", {game_code: <?php echo $_GET["game_code"]; ?>}, function(data) {

        notifyUser("Info", "Reordered teams!", 2300);

      });

    });

 </script>

<?php

  require '../../assets/inc/footer.inc.php';

 ?>
