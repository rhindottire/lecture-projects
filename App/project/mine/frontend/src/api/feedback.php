<?php
  function getFeedbacks($token) {
    $url = 'http://localhost:3000/api/getFeedbacks';
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

  function createFeedback($token, $request) {
    $url = 'http://localhost:3000/api/createFeedback';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json',
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

  function getFeedbackById($token, $id) {
    $url = 'http://localhost:3000/api/getFeedback/' . $id;
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

  function adminReply($token, $id) {
    $url = 'http://localhost:3000/api/adminReply/' . $id;
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