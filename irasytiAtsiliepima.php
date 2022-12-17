<?php
session_start();
include("include/nustatymai.php");
include("include/functions.php");

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
       $data = htmlspecialchars($_POST['data']);
       $atsiliepimoKurejas = htmlspecialchars($_SESSION['user']);

      $sql = "INSERT INTO $lentele (tekstas, data, atsiliepimoKurejas) 
             VALUES ('$tekstas', NOW(), '$atsiliepimoKurejas')";
      if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
		{header("Location:/irankiuNuoma/reviews.php");exit;} 
      //echo "Įrašyta";
}
$conn->close();
?>