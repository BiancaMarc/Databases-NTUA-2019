<!DOCTYPE html>
<html>
  <head>
  <title>Available books</title>
  <link rel="stylesheet" type="text/css" href="Queries-Layout.css">
  </head>
  <body>
    <table>
	  <tr>
	    <th>Number of Members</th>
	  </tr>
	  <?php
	    $conn = new mysqli("localhost", "root", "", "final_project");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT COUNT(*) AS Total_Members
		        FROM member";
		$result = $conn->query($sql);
		if ($result->num_rows>0) {
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>". $row["Total_Members"]. "</td></tr>";
			}
		}
	  ?>
	</table>
  </body>
</html>