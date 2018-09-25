<?php

  $page = "Dashboard";

  require '../assets/inc/header.inc.php';

  echo $userObj->getProfilePicture($userObj->getUsername());

  require '../assets/inc/footer.inc.php';

?>
