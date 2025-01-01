<?php 
  if (isset($_POST['surname'])) {
    require 'processData.php';
  }
?>

<form action="processData_form.php" method="POST">
  <label for="surname">Surname:</label><br>
  <input type="text" id="surname" name="surname"><br><br>
  <label for="email">Email Address:</label><br>
  <input type="email" id="email" name="email"><br><br>
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password"><br><br>
  <label for="street">Street Address:</label><br>
  <textarea id="street" name="street" rows="2" cols="20"></textarea><br><br>

  <label for="state">State:</label>
  <select id="state" name="state">
      <option value="Madura">Madura</option>
      <option value="Surabaya">Surabaya</option>
  </select><br><br>

  <!-- Hidden Country Field -->
  <input type="hidden" name="country" value="Indonesia">

  <label>Gender:</label>
  <input type="radio" id="cowok" name="gender" value="Cowok" checked>
  <label for="cowok">Cowok</label>
  <input type="radio" id="cewek" name="gender" value="Cewek">
  <label for="cewek">Cewek</label><br><br>

  <label>Hobi:</label>
  <input type="checkbox" id="music" name="hobi[]" value="Music" checked>
  <label for="music">Listening to music</label>
  <input type="checkbox" id="podcasts" name="hobi[]" value="Podcasts">
  <label for="podcasts">Listening to podcasts</label>
  <input type="checkbox" id="coding" name="hobi[]" value="Coding">
  <label for="coding">Coding</label><br><br>

  <input type="submit" value="Submit">
</form>