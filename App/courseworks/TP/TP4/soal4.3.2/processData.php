<?php
  require 'validate.inc';
  $errors = [];
  if (validateName($_POST, 'surname', $errors)) {
    echo "' Form submitted successfully with no errors '";
  } elseif ($errors['surname'] == 'Field surname harus diisi.') {
    echo '';
  } else {
    echo 'Data invalid! <br>' .  $errors['surname'];
  }
?>