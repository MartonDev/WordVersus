<?php

  $page = "Dashboard";

  require '../assets/inc/header.inc.php';
  require '../assets/inc/classes/Game.php';

  $gameObj = new Game();

  if(isset($_GET["loggedIn"])) {

    $result = "Welcome back, " . $userObj->getUsername() . "!";

  }

  if(isset($_GET["creategame"])) {

    $game_code = $gameObj->createGame();

    header("Location: game/create.php?game_code=" . $game_code);
    die();

  }

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

       <h1 class="title">Home</h1>
       <h1>Welcome, <?php echo $userObj->getUsername(); ?>!</h1>

       <br />

       <h1>Start or join a game!</h1>

       <a class="game-menu" href="?creategame=true"><h1><i class="fas fa-plus"></i><br />Create a new game</h1></a>
       <a class="game-menu" href="game/join.php"><h1><i class="fas fa-user"></i><br />Join with a code</h1></a>

       <h1>Your word collections</h1>

       <a class="game-menu" href="collections/create.php"><h1><i class="fas fa-plus"></i><br />Create new collection</h1></a>
       <a class="game-menu" href="collections/"><h1><i class="fas fa-list"></i><br />Manage your collections</h1></a>

     </div>

   </div>

 </div>

 <?php if(isset($result)) { ?>

   <script>

    notifyUser("Info", "<?php echo $result; ?>", 4000);

   </script>

 <?php } ?>

<?php

  require '../assets/inc/footer.inc.php';

 ?>
