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
      if (isset($_POST['isbn'])) {
	    if(isset($_POST['copynr'])) {
		  $sql = "DELETE FROM `copy`
			      WHERE ISBN='$_POST[isbn]' AND copynr='$_POST[copynr]'";
		  if (!$conn->query($sql)) {
			die('Error: Could not delete Copy');
		  }
		}
		else {
		  $sql="DELETE FROM book
			    WHERE ISBN='$_POST[isbn]'";
		  if (!$conn->query($sql)) {
			die('Error: Could not delete Book');
		  }
	    }
      };
      if(isset($_POST['lastname'])) {
	    $sql="DELETE FROM author
		      WHERE authlastname='$_POST[lastname]' AND authfirstname='$_POST[firstname]'";
	    if (!$conn->query($sql)) {
		  die('Error: Could not delete Author');
	    }
      };
      if(isset($_POST['pubname'])) {
        $sql="DELETE FROM publisher
              WHERE pubname='$_POST[pubname]'";
        if (!$conn->query($sql)) {
          die('Error: Could not delete Publisher');
        }
      };
      echo "records deleted";
      $conn->close();
    ?>
  </body>
</html>