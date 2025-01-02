<?php
  function getClients($token) {
    $url = 'http://localhost:3000/api/getClients';
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

  function getClientById($token, $id) {
    $url = 'http://localhost:3000/api/getClient/' . $id;
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

  function getClientDetails($token) {
    $url = 'http://localhost:3000/api/getClientDetails';
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