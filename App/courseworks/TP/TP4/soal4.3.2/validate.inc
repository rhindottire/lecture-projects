<?php
  function validateName($field_list, $field_name, &$errors = []) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) == '') {
        $errors[$field_name] = "Field $field_name harus diisi.";
        return false;
    }

    $pattern = "/^[a-zA-Z'-]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = "Field $field_name hanya boleh mengandung huruf.";
        return false;
    }
    return true;
  }
?>