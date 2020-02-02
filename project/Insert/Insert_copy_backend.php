<!DOCTYPE html>
<html>
  <body>
    <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "final_project";
      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $sql = "INSERT INTO copy(ISBN, copynr, shelf)
	          VALUES('$_POST[isbn]', '$_POST[copynr]', '$_POST[shelf]')";
      if (!$conn->query($sql)) {
        die('Error: copy');
      }
      echo "records added";
      $conn->close();
    ?>
  </body>
</html>