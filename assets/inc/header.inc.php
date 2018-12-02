<?php

  require 'config.inc.php';

  session_start();

  require 'classes/User.php';
  $userObj = new User();

  if(isset($game)) {

    require 'classes/Collection.php';
    require 'classes/Game.php';

    $collectionObj = new Collection();
    $gameObj = new Game();

  }

  if($userObj->isLoggedIn() && $page == "Home") {

    header("Location: dashboard/");
    die();

  }

  if($userObj->isLoggedIn() && ($page == "Register" || $page == "Login")) {

    header("Location: index.php");
    die();

  }

  if($page == "Dashboard" && !($userObj->isLoggedIn())) {

    header("Location: " . SITE_URL . "/dashboard/login.php");
    die();

  }

  if(isset($_GET["logout"])) {

    $userObj->logOut();

  }

 ?>

<!doctype html>
<html>

  <head>

    <title><?php echo SITE_NAME ?> · <?php echo $page ?></title>

    <link rel="shortcut icon" type="image/png" href="<?php echo SITE_URL ?>/assets/img/icon.png"/>

    <script src="<?php echo SITE_URL ?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo SITE_URL ?>/assets/js/main.js"></script>
    <script src="<?php echo SITE_URL ?>/assets/js/scroll.js"></script>
    <script src="<?php echo SITE_URL ?>/assets/js/smoothscroll.js"></script>
    <script src="<?php echo SITE_URL ?>/assets/js/scrolltop.js"></script>
    <script src="<?php echo SITE_URL ?>/assets/js/notifications.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/assets/css/notifications.css" />
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/assets/css/animate.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <?php

      if($page == "Dashboard" || $page == "Login" || $page == "Register") {

        echo '

          <link rel="stylesheet" href="' . SITE_URL . '/assets/css/dashboard.css" />
          <link href="' . SITE_URL . '/assets/css/jquery.skeleton.css" rel="stylesheet">
          <script src="' . SITE_URL . '/assets/js/jquery.scheletrone.js"></script>

        ';

      }

      if(isset($game)) {

        echo '<link rel="stylesheet" href="' . SITE_URL . '/assets/css/game.css" />
        <script src="' .  SITE_URL . '/assets/js/game.js"></script>';

      }

     ?>


    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#6f2cd3">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="description" content="<?php echo SITE_DESCRIPTION ?>">

    <?php echo "<!--Website made by Marton. Copyright (c) " . date("Y") . "-->"; ?>

  </head>

  <body onload="loadBody()">

    <?php

      if(!isset($game)) {

    ?>

    <div class="loading-line"><div id="loadingContainer" class="container"></div></div>

    <?php

      }

     ?>
