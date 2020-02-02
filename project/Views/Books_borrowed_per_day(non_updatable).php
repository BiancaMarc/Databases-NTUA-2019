<!DOCTYPE html>
<html>
  <head>
  <title>Books Borrowed per day</title>
  <link rel="stylesheet" type="text/css" href="Views-Layout.css">
  </head>
  <body>
    <table>
	  <tr>
	    <th>Books Borrowed</th>
		<th>Date of Borrowing</th>
	  </tr>
	  <?php
	    $conn = new mysqli("localhost", "root", "", "final_project");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM `books_borrowed_per_day`";
		$result = $conn->query($sql);
		if ($result->num_rows>0) {
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>". $row["Books_Borrowed"]. "</td><td>". $row["date_of_borrowing"]. "</td></tr>";
			}
		}
	  ?>
	</table>
  </body>
</html>