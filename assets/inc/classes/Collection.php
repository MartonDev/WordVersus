<?php

  class Collection {

    public function getCollections() {

      $collections = array();
      $userObj = new User();

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("SELECT `id` FROM `collections` ORDER BY `id` DESC LIMIT 1");
      $exc->execute();
      $exc->bind_result($best_id);
      $exc->fetch();
      $exc->close();

      $collection = $mysqli->prepare("SELECT `user_id` FROM `collections` WHERE `id`=?");

      for($i = 0; $i < $best_id; $i++) {

        $j = $i + 1;

        $collection->bind_param("i", $j);
        $collection->execute();
        $collection->bind_result($currCollectionUserID);
        $collection->fetch();

        if($currCollectionUserID == $userObj->getUserId()) {

          array_push($collections, $j);

        }

      }

      return $collections;

    }

    public function getCollection($collection_id) {

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("SELECT `name` FROM `collections` WHERE `id`=?");
      $exc->bind_param("i", $collection_id);
      $exc->execute();
      $exc->bind_result($collection_name);
      $exc->fetch();
      $exc->close();

      return $collection_name;

    }

  }

 ?>
