<?php
session_start();
$server="localhost";
$user="root";
$password="";
$dbname="stud";
$lentele="pratyboms";

$conn = new mysqli($server, $user, $password, $dbname);
   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

if($_POST !=null){
       //$LLLL = $_POST['siuntejas'];
	   $LLLL = $_SESSION['user']; 
       $MMMM =$_POST['gavejas'];
       $NNNN = $_POST['IIII'];

      $sql = "INSERT INTO $lentele (siuntejas, gavejas, zinute) 
             VALUES ('$LLLL', '$MMMM','$NNNN')";
      if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
		{header("Location:skaitau.php");exit;} 
      //echo "Įrašyta";
}
$conn->close();
?>