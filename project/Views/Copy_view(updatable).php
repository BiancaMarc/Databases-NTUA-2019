<!DOCTYPE html>
<html>
  <head>
  <title>Copy view</title>
  <link rel="stylesheet" type="text/css" href="Views-Layout.css">
  </head>
  <body>
    <table>
	  <tr>
	    <th>ISBN</th>
		<th>Copy Number</th>
	  </tr>
	  <?php
	    $conn = new mysqli("localhost", "root", "", "final_project");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM `copy_view`";
		$result = $conn->query($sql);
		if ($result->num_rows>0) {
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>". $row["ISBN"]. "</td><td>". $row["copynr"]. "</td></tr>";
			}
		}
	  ?>
	</table>
  </body>
</html>