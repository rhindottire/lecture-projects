  <?php
  // Data input yang akan divalidasi
  $email = "DODO@gmail.com";
  $url = "https://www.instagram.com/rhindottire/";
  $floatValue = "17.11";
  $intValue = "10";
  $date = "2024-10-16"; // format YYYY-MM-DD
  $ipAddress = "192.168.1.1";
  $name = "   ACHMAD RIDHO FA'IZ   "; // Mengandung spasi di depan dan belakang
  $pattern = "/^[a-zA-Z\s]+$/"; // Regular expression hanya menerima huruf dan spasi

  // 1. Regular Expression (preg_match)
  if (preg_match($pattern, $name)) {
      echo "Nama valid.<br>";
  } else {
      echo "Nama tidak valid.<br>";
  }

  // 2. String Manipulation (trim, strtolower, strtoupper)
  $trimmedName = trim($name); // Menghilangkan spasi di awal dan akhir
  echo "Nama setelah trim: $trimmedName<br>";
  echo "Nama dalam huruf kecil: " . strtolower($trimmedName) . "<br>";
  echo "Nama dalam huruf besar: " . strtoupper($trimmedName) . "<br>";

  // 3. Filter (filter_var, filter_input, FILTER_VALIDATE_EMAIL, FILTER_VALIDATE_URL, FILTER_VALIDATE_IP, FILTER_VALIDATE_FLOAT)
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Email valid: $email<br>";
  } else {
      echo "Email tidak valid.<br>";
  }

  if (filter_var($url, FILTER_VALIDATE_URL)) {
      echo "URL valid: $url<br>";
  } else {
      echo "URL tidak valid.<br>";
  }

  if (filter_var($floatValue, FILTER_VALIDATE_FLOAT)) {
      echo "Float valid: $floatValue<br>";
  } else {
      echo "Float tidak valid.<br>";
  }

  if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
      echo "IP Address valid: $ipAddress<br>";
  } else {
      echo "IP Address tidak valid.<br>";
  }

  // 4. Type Testing (is_float, is_int, is_numeric, is_string)
  if (is_float((float)$floatValue)) {
      echo "Value is a float.<br>";
  } else {
      echo "Value is not a float.<br>";
  }

  if (is_int((int)$intValue)) {
      echo "Value is an integer.<br>";
  } else {
      echo "Value is not an integer.<br>";
  }

  if (is_numeric($intValue)) {
      echo "Value is numeric.<br>";
  } else {
      echo "Value is not numeric.<br>";
  }

  if (is_string($name)) {
      echo "Value is a string.<br>";
  } else {
      echo "Value is not a string.<br>";
  }

  // 5. Date (checkdate)
  $dateParts = explode('-', $date);
  $year = (int)$dateParts[0];
  $month = (int)$dateParts[1];
  $day = (int)$dateParts[2];

  if (checkdate($month, $day, $year)) {
      echo "Tanggal valid: $date<br>";
  } else {
      echo "Tanggal tidak valid.<br>";
  }
?>