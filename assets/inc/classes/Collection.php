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

    public function createCollection($collection_name, $words) {

      $userObj = new User();
      $userID = $userObj->getUserId();

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("INSERT INTO `collections`(`user_id`, `name`) VALUES (?,?)");
      $exc->bind_param("is", $userID, $collection_name);
      $exc->execute();
      $exc->close();
      $collection_id = mysqli_insert_id($mysqli);

      $words_decoded = json_decode($words);
      $exc = $mysqli->prepare("INSERT INTO `collection_words`(`collection_id`, `word`, `meaning`) VALUES (?,?,?)");

      for($i = 0; $i < count($words_decoded); $i++) {

        $word_to_push = $words_decoded[$i][0];
        $meaning_to_push = $words_decoded[$i][1];

        $exc->bind_param("iss", $collection_id, $word_to_push, $meaning_to_push);
        $exc->execute();

      }

      header("Location: index.php");
      die();

    }

    public function deleteCollection($collectionID) {

      $mysqli = new mysqli("localhost", MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

      $exc = $mysqli->prepare("DELETE FROM `collections` WHERE `id`=?");
      $exc->bind_param("i", $collectionID);
      $exc->execute();
      $exc->close();

      $exc = $mysqli->prepare("SELECT `id` FROM `collection_words` ORDER BY `id` DESC LIMIT 0,1");
      $exc->execute();
      $exc->bind_result($best_id);
      $exc->fetch();
      $exc->close();

      $exc = $mysqli->prepare("DELETE FROM `collection_words` WHERE `collection_id`=?");
      $exc->bind_param("i", $collectionID);
      $exc->execute();

    }

  }

 ?>
