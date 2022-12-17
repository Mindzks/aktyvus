<?php
session_start();
include("include/nustatymai.php");
include("include/functions.php");

if(($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL])){
	header("Location: logout.php");
	exit;
}
date_default_timezone_set("Europe/Vilnius");
$server="localhost";
$user="root";
$password="";
$dbname="irankiunuoma";
$lentele="irankis";

$conn = new mysqli($server, $user, $password, $dbname);
   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

if($_POST !=null){
       $pavadinimas = htmlspecialchars($_POST['pavadinimas']);
       $bukle = htmlspecialchars($_POST['bukle']);
       $kaina = htmlspecialchars($_POST['kaina']);
       $tipas = htmlspecialchars($_POST['tipas']);
       $klase = htmlspecialchars($_POST['klase']);
       $gamintojas =  htmlspecialchars($_POST['gamintojas']);
       $modelis =  htmlspecialchars($_POST['modelis']);
       $punktas =  htmlspecialchars($_POST['punktas']);
      $sql = "INSERT INTO $lentele (sukurimo_data, bukle, kaina, prieinamumas, tipas, klase, gamintojas_fk, modelis_fk, tasymo_fk, pavadinimas) 
             VALUES ( NOW(), '$bukle', '$kaina', 1,  '$tipas', '$klase', '$gamintojas', '$modelis', '$punktas', '$pavadinimas' )";
      if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
		{header("Location:/irankiuNuoma");exit;} 
      //echo "Įrašyta";
}
$conn->close();
?>