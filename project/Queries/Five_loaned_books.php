<!DOCTYPE html>
<html>
  <head>
  <title>Available books</title>
  <link rel="stylesheet" type="text/css" href="Queries-Layout.css">
  </head>
  <body>
    <table>
	  <tr>
	    <th>Member ID</th>
		<th>Member Last Name</th>
		<th>Member First Name</th>
	  </tr>
	  <?php
	    $conn = new mysqli("localhost", "root", "", "final_project");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT M.memid, M.memlastname, M.memfirstname
		        FROM member AS M, borrows AS B
				WHERE M.memid=B.memid AND B.date_of_return IS NULL
				GROUP BY memid
				HAVING COUNT(*)=5
				ORDER BY memlastname";
		$result = $conn->query($sql);
		if ($result->num_rows>0) {
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>". $row["memid"]. "</td><td>". $row["memlastname"]. "</td><td>". $row["memfirstname"]. 
				     "</td></tr>";
			}
		}
	  ?>
	</table>
  </body>
</html>