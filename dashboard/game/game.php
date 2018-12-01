<?php

  $page = "Play";
  $game = true;

  require '../../assets/inc/header.inc.php';

  if(isset($_GET["game_code"])) {

    $players = $gameObj->getPlayersForGame($_GET["game_code"]);

    if(is_null($players)) {

      if(in_array($userObj->getUserId(), $players)) {

        //verified that user is in this game

      }else {

        header("Location: join.php");
        die();

      }

    }else {

      header("Location: join.php");
      die();

    }

  }else {

    header("Location: join.php");
    die();

  }

 ?>

 <div class="loading" id="game-loading">

   <div class="container">

     <h1 class="title">Loading game...</h1>

     <div class="line">

       <div class="fill" id="fillline"></div>

     </div>

   </div>

 </div>

<?php

  require '../../assets/inc/footer.inc.php';

 ?>
