<!DOCTYPE html>
<html>
  <head>
  <title>Available books</title>
  <link rel="stylesheet" type="text/css" href="Queries-Layout.css">
  </head>
  <body>
    <table>
	  <tr>
	    <th>Employee ID</th>
		<th>Employee Last Name</th>
		<th>Employee First Name</th>
	  </tr>
	  <?php
	    $conn = new mysqli("localhost", "root", "", "final_project");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT empid, emplastname, empfirstname
		        FROM employee
				WHERE salary<1500 AND empid NOT IN (SELECT DISTINCT empid
				                                    FROM reminder)";
		$result = $conn->query($sql);
		if ($result->num_rows>0) {
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>". $row["empid"]. "</td><td>". $row["emplastname"]. "</td><td>". $row["empfirstname"].
					 "</td><td>". "</td></tr>";
			}
		}
	  ?>
	</table>
  </body>
</html>