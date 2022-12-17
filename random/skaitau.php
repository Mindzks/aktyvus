<?php
session_start(); 
$server="localhost";
$user="root";
$password="";
$dbname="stud";
$lentele="pratyboms";

include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole

echo $_SESSION['ulevel'];
echo ($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL]);
$exit = true;

if (($_SESSION['ulevel'] == $user_roles[DEFAULT_LEVEL])){
	$exit = false;
}
if(($_SESSION['ulevel'] == $user_roles[ADMIN_LEVEL])){
	$exit = false;
}
if($exit){
	 header("Location: logout.php");
	 exit;
}
date_default_timezone_set("Europe/Vilnius");

$conn = new mysqli($server, $user, $password, $dbname);
   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

// $sql =  "SELECT * FROM $lentele";
if ($_SESSION['ulevel'] == 9) $sql =  "SELECT * FROM $lentele";
else  {
    $vardas=$_SESSION['user'];
     $sql =  "SELECT * FROM $lentele WHERE siuntejas = '$vardas' OR gavejas = '$vardas'";
}

if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);

// parodyti
echo "<br><br><a href=\"index.php\"><b>Grįžti į meniu<b></a>";
echo "<table border=\"1\">";
while($row = $result->fetch_assoc()) {
    echo "<tr>
	<td>".$row['id']."</td>
	<td>".$row['siuntejas']."</td>
	<td>".$row['gavejas']."</td>
	<td>".$row['zinute']."</td>
	</tr>";
}
echo "</table>";
echo "<a href=\"ivedimas.php\">Dar kartą</a>";

$conn->close();



?>