<!DOCTYPE html>
<html>
  <body>
    <h2>Delete Copy By ISBN</h2>
	
	<form action="deletes_backend.php" method="post">
	  Book ISBN:<input type="text" name="isbn" /><br><br>
	  Copy Number:<input type="text" name="copynr" /><br><br>
	  <input type="submit" value="Delete Copy"/>
    </form>
  </body>
</html>