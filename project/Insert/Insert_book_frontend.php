<!DOCTYPE html>
<html>
  <body>
    <h2>Insert New Book into Database</h2>
	
	<form action="Insert_book_backend.php" method="post">
      <fieldset>
        <legend> Book Information </legend>
		  ISBN: <input type="text" name="isbn"/><br><br>
		  Title: <input type="text" name="title"/><br><br>
		  Number of Pages: <input type="text" name="nrofpages"/><br><br>
		  Year of Publication: <input type="text" name="pubyear"/><br><br>
      </fieldset>
	  <fieldset>
	    <legend> Copy Information </legend>
		  Shelf Number: <input type="text" name="shelf"/><br><br>
	  </fieldset>
	  <fieldset> 
        <legend> Author Information </legend>
          Author Name: <select id="author" name='authname' onchange="myfunction1(this.value)">
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
                           $sql = "SELECT authlastname, authfirstname FROM author";
                           $result1 = $conn->query($sql);
                           if ($result1->num_rows > 0) {
                             while($row = $result1->fetch_assoc()) {
                               echo "<option>".
                               $row["authlastname"]." ".$row["authfirstname"]."<br><br>" ;
                               "<\option>";
                             }
                           }
                           //$conn->close();
                         ?>
                         <option>Add New</option>
                       </select>
        <div id="author-group"><br>
          Author Last Name: <input type="text" name="authlastname"/><br><br>
		  Author First Name: <input type="text" name="authfirstname"/><br><br>
		  Author Birthdate (yyyy-mm-dd): <input type="text" name="authbirthdate"/><br><br>
		</div>
      </fieldset>
	  <fieldset>
        <legend> Publisher Information </legend>
          Publisher: <select id="publisher" name='pubname' onchange="myfunction2(this.value)">
                       <?php
					     $sql = "SELECT pubname FROM publisher";
                         $result2 = $conn->query($sql);
                         if ($result2->num_rows > 0) {
	                       while($row = $result2->fetch_assoc()) {
		                     echo "<option>".
		                     $row["pubname"];
		                     "<\option>";
                           }
                         }
                         $conn->close();
					   ?>
                       <option>Add New</option>
                     </select>

        <div id="publisher-group"><br>
          Publisher Name: <input type="text" name="publishername"/><br><br>
		  Establishment Year: <input type="text" name="estyear"/><br><br>
		  
		  Publisher Address:<br>
		  
		  Street: <input type="text" name="strname"/><br>
		  Number: <input type="text" name="strnum"/><br>
		  Postal Code: <input type="text" name="postcode"/><br>
		</div>
	  </fieldset><br>
      <input type="submit" value="Insert Book"/>
    </form>
	<script src="conditional.js"> </script>
  </body>
</html>