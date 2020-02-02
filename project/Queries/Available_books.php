<!DOCTYPE html>
<html>
  <head>
  <title>Available books</title>
  <link rel="stylesheet" type="text/css" href="Queries-Layout.css">
  </head>
  <body>
    <table>
	  <tr>
	    <th>ISBN</th>
		<th>Title</th>
		<th>Author Last Name</th>
		<th>Author First Name</th>
		<th>Publisher Name</th>
	  </tr>
	  <?php
	    $conn = new mysqli("localhost", "root", "", "final_project");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT C.ISBN, B.title, A.authlastname, A.authfirstname, B.pubname
		        FROM borrows AS BR, copy AS C, book AS B, author AS A, written_by AS W
		        WHERE B.ISBN=C.ISBN AND C.ISBN=BR.ISBN AND C.copynr=BR.copynr 
		              AND BR.date_of_return IS NOT NULL AND A.authid=W.authid 
		              AND W.ISBN=C.ISBN
		        GROUP BY B.title";
		$result = $conn->query($sql);
		if ($result->num_rows>0) {
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>". $row["ISBN"]. "</td><td>". $row["title"]. "</td><td>". $row["authlastname"].
					 "</td><td>". $row["authfirstname"]. "</td><td>". $row["pubname"]. "</td></tr>";
			}
		}
	  ?>
	</table>
  </body>
</html>