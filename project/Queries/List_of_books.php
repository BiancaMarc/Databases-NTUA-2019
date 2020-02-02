<!DOCTYPE html>
<html>
  <head>
  <title>List of books</title>
  <link rel="stylesheet" type="text/css" href="Queries-Layout.css">
  </head>
  <body>
    <table>
	  <tr>
	    <th>ISBN</th>
		<th>Title</th>
		<th>Copy Number</th>
		<th>Publish Year</th>
		<th>Number of Pages</th>
		<th>Author Last Name</th>
		<th>Author First Name</th>
		<th>Publisher Name</th>
		<th>Category Name</th>
	  </tr>
	  <?php
	    $conn = new mysqli("localhost", "root", "", "final_project");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT B.ISBN, B.title, C.copynr, B.pubyear, B.numpages, A.authlastname, A.authfirstname, B.pubname, Cat.catname
		        FROM book B
				  INNER JOIN copy C ON C.ISBN=B.ISBN 
				  INNER JOIN belongs_to BT ON BT.ISBN=C.ISBN
				  INNER JOIN category Cat ON Cat.catname=BT.catname
				  INNER JOIN written_by WB ON WB.ISBN=B.ISBN
				  INNER JOIN author A ON A.authid=WB.authid
				ORDER BY B.title";
		$result = $conn->query($sql);
		if ($result->num_rows>0) {
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>". $row["ISBN"]. "</td><td>". $row["title"]. "</td><td>". $row["copynr"]. 
				     "</td><td>". $row["pubyear"]. "</td><td>". $row["numpages"]. "</td><td>". $row["authlastname"].
					 "</td><td>". $row["authfirstname"]. "</td><td>". $row["pubname"]. "</td><td>". $row["catname"].
					 "</td></tr>";
			}
		}
	  ?>
	</table>
  </body>
</html>