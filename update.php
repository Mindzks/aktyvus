<?php 
session_start();
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "irankis";

$pavadinimas = htmlspecialchars($_POST["pavadinimas"]);
$bukle = htmlspecialchars($_POST["bukle"]);
$kaina = htmlspecialchars($_POST["kaina"]);
$tipas = htmlspecialchars($_POST["tipas"]);
$klase = htmlspecialchars($_POST["klase"]);
$prieinamumas = htmlspecialchars($_POST["prieinamumas"]);
$id = $_POST["id"];
include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "UPDATE $lentele SET pavadinimas = '$pavadinimas', bukle = '$bukle', kaina = '$kaina', tipas = '$tipas', klase = '$klase', prieinamumas = '$prieinamumas' WHERE id=$id";

$conn->query($sql);
header('Location: /irankiuNuoma');

?>