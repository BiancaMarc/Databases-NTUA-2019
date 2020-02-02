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
      //In case of New Publisher
      if (!empty($_POST['publishername'])) {
        $sql = "INSERT INTO publisher(pubname, estyear, pubstreet, pubnumber, pubpostcode)
                VALUES('$_POST[publishername]', '$_POST[estyear]', '$_POST[strname]', '$_POST[strnum]', '$_POST[postcode]')";
        if (!$conn->query($sql)) {
          die('Error: new publisher\n');
	    }
	    $_POST['pubname']=$_POST['publishername'];	//pubname is Add New, we must change it to the new pubname value
      };
      //In case of New Author
      if (!empty($_POST['authlastname'])) {
        $sql = "INSERT INTO author(authlastname, authfirstname, authbirthdate)
                VALUES('$_POST[authlastname]', '$_POST[authfirstname]', '$_POST[authbirthdate]')";
        if (!$conn->query($sql)) {
          die('Error: new author\n');
	    }
	    $_POST['authname']=$_POST['authlastname']." ".$_POST['authfirstname'];	//authname is now Add New, we have to change it to the new name
      };
      $sql = "INSERT INTO book (ISBN, title, numpages, pubyear, pubname)
	          VALUES('$_POST[isbn]','$_POST[title]', '$_POST[nrofpages]', '$_POST[pubyear]', '$_POST[pubname]')";
      if (!$conn->query($sql)) {
        die('Error: book\n');
      }
      //echo "$_POST[isbn]";
      $sql = "INSERT INTO `copy` (ISBN, copynr, shelf)
	          VALUES('$_POST[isbn]', (SELECT COUNT(copynr)
			  FROM `copy` AS C, `book` AS B
			  WHERE B.ISBN='$_POST[isbn]' AND C.ISBN=B.ISBN)+1, '$_POST[shelf]')";
	  if (!$conn->query($sql)) {
        die('Error: copy');
	  }
	  $name = explode(" ", "$_POST[authname]");
      //echo $name[0];
      $sql = "INSERT INTO written_by(ISBN, authid)
	          VALUES('$_POST[isbn]', (SELECT authid
			  FROM author
			  WHERE authlastname='$name[0]' AND authfirstname='$name[1]'))";
      if (!$conn->query($sql)) {
        die('Error: written_by');
      }
      echo "records added";
      $conn->close();
    ?>
  </body>
</html>