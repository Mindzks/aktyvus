<?php 
session_start();
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "users";

$tomp=$_SESSION['user'];

echo $tomp;
include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "DELETE FROM $lentele WHERE username = '$tomp'";
$conn->query($sql);
header("Location: logout.php");

?>