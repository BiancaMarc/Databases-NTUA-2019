<!DOCTYPE html>
<html>
<body>

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
if(isset($_POST['isbn'])){
	if(isset($_POST['shelf'])){
		$sql="UPDATE `copy`
			SET shelf='$_POST[shelf]'
			WHERE ISBN='$_POST[isbn]' AND copynr='$_POST[copynr]'";
		if (!$conn->query($sql))
		{
			die('Error: Could not update Copy');
		}
	} else {
		$sql="UPDATE book
			SET title='$_POST[title]'
			WHERE ISBN='$_POST[isbn]'";
		if (!$conn->query($sql))
		{
			die('Error: Could not update Book Title');
		}
	}
};
if(isset($_POST['id'])){
	if(!empty($_POST['lastname'])){
		$sql="UPDATE author
			SET authlastname='$_POST[lastname]'
			WHERE authid='$_POST[id]'";
		if (!$conn->query($sql))
		{
			die('Error: Could not update Author last name');
		}
	};
	if(!empty($_POST['firstname'])){
                $sql="UPDATE author
                        SET authfirstname='$_POST[firstname]'
                        WHERE authid='$_POST[id]'";
                if (!$conn->query($sql))
                {
                        die('Error: Could not update Author first name');
                }
        };
};
if(isset($_POST['oldname'])){
        $sql="UPDATE publisher
		SET pubname='$_POST[newname]'
		WHERE pubname='$_POST[oldname]'";
        if (!$conn->query($sql))
        {
                die('Error: Could not update Publisher');
        }
};
echo "records updated";
$conn->close();
?>

</body>
</html>