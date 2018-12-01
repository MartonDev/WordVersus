<?php

  $page = "Play";
  $game = true;

  require '../../assets/inc/header.inc.php';

  if(!isset($_GET["game_code"])) {

    header("Location: ../index.php");
    die();

  }else if(!$gameObj->exists($_GET["game_code"])) {

    header("Location: ../index.php");
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

 <div class="teams-stats">



 </div>

<?php

  require '../../assets/inc/footer.inc.php';

 ?>
