<?php

  class Quizlet {

    public function getWordsForSet($set_url) {

      $set_id = str_replace("/", "", str_replace("https://", "", str_replace("quizlet.com/", "", $set_url)));

      $apiUrl = 'https://api.quizlet.com/2.0/sets/' . $set_id . '/terms?client_id=' . QUIZLET_CLIENT_ID;

      $curl = curl_init();
      curl_setopt_array($curl, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => $apiUrl,
          CURLOPT_USERAGENT => 'Codular Sample cURL Request'
      ));
      $result = curl_exec($curl);
      curl_close($curl);

      if ($result) {

        $set = json_decode($result);

      	return $set;

      }else {

        return "Unknown error!";

      }

    }

  }

 ?>
