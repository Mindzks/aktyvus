<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>pratyboms</title>
</head>
<body>
<form method='post' action='irasau.php'>
   	<?php
	include("include/nustatymai.php");
	$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
			$sql = "SELECT username "
            . "FROM " . TBL_USERS . " ORDER BY userlevel DESC,username";
			$result = mysqli_query($db, $sql);
			if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę users"; exit;}
	
		echo "<select name=\"gavejas\">";
while ($row = mysqli_fetch_assoc($result)) 
 {$user= $row['username'];
      echo "<option value=".$user.">".$user."</option>";
     }
echo "</select>";

	?>
	

     zinute: <textarea name='IIII'> </textarea><br><br>
    <input type='submit' name='ok' value='patvirtinti'>
</form>
<?php
echo "<br><br><a href=\"index.php\"><b>Grįžti į meniu<b></a>";
?>
</body>
</html>
