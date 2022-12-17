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
$lentele="atsiliepimas";

$conn = new mysqli($server, $user, $password, $dbname);
   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

if($_POST !=null){
       $tekstas = htmlspecialchars($_POST['tekstas']);
	   $data = htmlspecialchars(NOW());
	   $atsiliepimoKurejas = htmlspecialchars($_POST['pavadinimas']);
    
      $sql = "INSERT INTO $lentele (sukurimo_data, bukle, kaina, prieinamumas, tipas, klase, gamintojas_fk, modelis_fk, tasymo_fk, pavadinimas) 
             VALUES ( NOW(), '$bukle', '$kaina', 1,  '$tipas', '$klase', '$gamintojas', '$modelis', '$punktas', '$pavadinimas' )";
      if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
		{header("Location:/irankiuNuoma/reviews.php");exit;} 
      //echo "Įrašyta";
}
$conn->close();
?>