<?php
session_start();

$isSvecias = true;
if(isset($_SESSION['ulevel'])){
    if(($_SESSION['ulevel'] == 9)){
        $isSvecias = false;
    }
    if(($_SESSION['ulevel'] == 4)){
        $isSvecias = false;
    }
}
if($isSvecias){
	header("Location: logout.php");
	exit;
}
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "uzsakymas";

$value = $_GET['key'];

include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql = "SELECT * FROM $lentele WHERE id='$value'";
if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
$row = $result->fetch_assoc();
$irankio_fk = $row['irankis_fk'];

$lentele5 = "irankis";
$sql =  "UPDATE $lentele5 SET prieinamumas = 1 WHERE id=$irankio_fk";
$conn->query($sql);

$sql =  "DELETE FROM $lentele WHERE id = $value";

$conn->query($sql);
header('Location: /irankiuNuoma');
?>