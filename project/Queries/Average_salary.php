<!DOCTYPE html>
<html>
  <head>
  <title>Available books</title>
  <link rel="stylesheet" type="text/css" href="Queries-Layout.css">
  </head>
  <body>
    <table>
	  <tr>
	    <th>Permanent Employee Average Salary</th>
		<th>Temporary Employee Average Salary</th>
	  </tr>
	  <?php
	    $conn = new mysqli("localhost", "root", "", "final_project");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql1 = "SELECT AVG(E.salary) AS average1
		        FROM employee AS E, permanent AS P
				WHERE E.empid=P.empid";
		$sql2 = "SELECT AVG(E.salary) AS average2
		        FROM employee AS E, temporary AS T
				WHERE E.empid=T.empid";
		$result1 = $conn->query($sql1);
		$result2 = $conn->query($sql2);
		if ($result1->num_rows>0) {
			while ($row = $result1->fetch_assoc()) {
				echo "<tr><td>". $row["average1"]. "</td>";
			}
		}
		if ($result2->num_rows>0) {
			while ($row = $result2->fetch_assoc()) {
				echo "<td>". $row["average2"]. "</td></tr>";
			}
		} 
	  ?>
	</table>
  </body>
</html>