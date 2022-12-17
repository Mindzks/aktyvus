<?php 
session_start();
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "atsiliepimas";

$tekstas = htmlspecialchars($_POST["tekstas"]);
$id = $_POST["id"];
include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "UPDATE $lentele SET tekstas = '$tekstas' WHERE id=$id";

$conn->query($sql);
header('Location: /irankiuNuoma/reviews.php');

?>