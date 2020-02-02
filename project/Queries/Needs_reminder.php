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
		<th>ISBN</th>
		<th>Title</th>
		<th>Copy Number</th>
		<th>Date of Borrowing</th>
		<th>Date of Reminder</th>
		<th>Due Date</th>
	  </tr>
	  <?php
	    $conn = new mysqli("localhost", "root", "", "final_project");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT M.memid, M.memlastname, M.memfirstname, B.ISBN, B.title, C.copynr, BR.date_of_borrowing, R.date_of_reminder, BR.due_date
		        FROM member M
				  INNER JOIN borrows BR ON BR.memid=M.memid
				  INNER JOIN book B ON B.ISBN=BR.ISBN
				  INNER JOIN copy C ON C.ISBN=B.ISBN 
				  LEFT JOIN reminder R ON R.memid=M.memid    
				WHERE BR.date_of_return IS NULL
				GROUP BY M.memlastname";
		$result = $conn->query($sql);
		if ($result->num_rows>0) {
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>". $row["memid"]. "</td><td>". $row["memlastname"]. "</td><td>". $row["memfirstname"].
					 "</td><td>". $row["ISBN"]. "</td><td>". $row["title"]. "</td><td>". $row["copynr"]. 
					 "</td><td>". $row["date_of_borrowing"]. "</td><td>". $row["date_of_reminder"]. 
					 "</td><td>". $row["due_date"]. "</td></tr>";
			}
		}
	  ?>
	</table>
  </body>
</html>