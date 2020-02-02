<!DOCTYPE html>
<html>
  <body>
    <h2>Insert New Copy into Database</h2>
	
	<form action="Insert_copy_backend.php" method="post">
	  Book ISBN: <input type="text" name="isbn"/><br><br>
	  Copy Number: <input type="text" name="copynr"/><br><br>
	  Shelf Number: <input type="text" name="shelf"/><br><br>
	  <input type="submit" value="Insert Copy"/>
    </form>
  </body>
</html>