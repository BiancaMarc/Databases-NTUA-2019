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
      if (isset($_POST['copynumber'])) {
	    $sql="INSERT INTO `copy_view`
		      VALUES('$_POST[ISBN]', '$_POST[copynumber]')";
	    if (!$conn->query($sql)) {
		  die('Error: Could not insert into view');
        }
	    echo "record inserted";
      }
      else if (isset($_POST['copynumber_upd'])) {
        $sql="UPDATE `copy_view`
		      SET copynr='$_POST[copynumber_upd]'
		      WHERE ISBN='$_POST[ISBN]' AND copynr='$_POST[copynumber_old]'";
        if (!$conn->query($sql)) {
          die('Error: Could not update view');
        }
        echo "record updated";
      }
      else {
        $sql="DELETE FROM `copy_view`
                WHERE ISBN='$_POST[ISBN]' AND copynr='$_POST[copynumber_del]'";
        if (!$conn->query($sql)) {
          die('Error: Could not delete from view');
        }
        echo "record deleted";
      }
      $conn->close();
    ?>
  </body>
</html>