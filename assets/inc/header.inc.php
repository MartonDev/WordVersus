<?php

  require 'config.inc.php';

 ?>

<!doctype html>
<html>

  <head>

    <title><?php echo SITE_NAME ?> · <?php echo $page ?></title>

    <link rel="shortcut icon" type="image/png" href="<?php echo SITE_URL ?>/assets/img/icon.png"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo SITE_URL ?>/assets/js/main.js"></script>
    <script src="<?php echo SITE_URL ?>/assets/js/scroll.js"></script>
    <script src="<?php echo SITE_URL ?>/assets/js/smoothscroll.js"></script>
    <script src="<?php echo SITE_URL ?>/assets/js/scrolltop.js"></script>

    <link rel="stylesheet" href="<?php echo SITE_URL ?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/assets/css/animate.css" />
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/assets/css/fonts/ProductSans.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <?php

      if($page == "Dashboard") {

        echo '<link rel="stylesheet" href="' . SITE_URL . '/assets/css/dashboard.css" />';

      }

     ?>


    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#6f2cd3">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="description" content="<?php echo SITE_DESCRIPTION ?>">

  </head>

  <body onload="loadBody()">

    <div class="loading-line"><div id="loadingContainer" class="container"></div></div>