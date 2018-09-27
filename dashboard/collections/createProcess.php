<?php

  echo "Name: " . $_GET["name"] . "<br />";

  $words = json_decode($_GET["words"]);

  for($i = 0; $i < count($words); $i++) {

    echo $words[$i][0] . "-" . $words[$i][1];
    echo "<br />";

  }

 ?>
