<?php
  function getSubscribes($token) {
    $url = 'http://localhost:3000/api/getSubscribes';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'X-API-TOKEN: ' . $token
    ]);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
      return null;
    }
    curl_close($ch);
    return json_decode($response, true);
  }
?>