<?php
  require 'validate.inc';

  $errors = [];
  if (validateName($_POST, 'surname', $errors)) {
    echo 'Data OK!';
  } else {
    echo 'Data invalid! <br>' .  $errors['surname'];
  }

  // if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //     $surname = htmlspecialchars($_POST['surname']);
  //     $email = htmlspecialchars($_POST['email']);
  //     $password = htmlspecialchars($_POST['password']);
  //     $street = htmlspecialchars($_POST['street']);
  //     $state = htmlspecialchars($_POST['state']);
  //     $country = htmlspecialchars($_POST['country']);
  //     $gender = htmlspecialchars($_POST['gender']);
  //     $hobi = isset($_POST['hobi']) ? implode(", ", $_POST['hobi']) : 'No hobi selected';

  //     // echo "<h2>Data Pribadi:</h2>";
  //     // echo "Username: $surname<br>";
  //     // echo "Email: $email<br>";
  //     // echo "Password: $password<br>";
  //     // echo "Street Address: $street<br>";
  //     // echo "State: $state<br>";
  //     // echo "Country: $country<br>";
  //     // echo "Gender: $gender<br>";
  //     // echo "Hobi: $hobi<br>";
  // }
?>