<?php
session_start();
if(($_SESSION['ulevel'] != 9)){
	header("Location: logout.php");
	exit;
}
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "irankis";

$value = $_GET['key'];

include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "DELETE FROM $lentele WHERE id = $value";

$conn->query($sql);
header('Location: /irankiuNuoma');
?>