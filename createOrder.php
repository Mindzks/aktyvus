<?php 
session_start();
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "uzsakymas";
$lentele2 = "irankis";

$zmogus = htmlspecialchars($_POST["zmogus"]);
$irankis = htmlspecialchars($_POST["irankis"]);
$adresas = htmlspecialchars($_POST["adresas"]);
$data_a = htmlspecialchars($_POST["data_a"]);
$data_b = htmlspecialchars($_POST["data_b"]);


include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql = "INSERT INTO $lentele (pradzia, pabaiga, zmogus_fk, punktas_fk, irankis_fk) 
             VALUES ( '$data_a', '$data_b', '$zmogus',  '$adresas', '$irankis')";

$sql2 =  "UPDATE $lentele2 SET prieinamumas = 0 WHERE id=$irankis";

$conn->query($sql2);
$conn->query($sql);
header('Location: /irankiuNuoma');

?>