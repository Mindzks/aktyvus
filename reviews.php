<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

session_start();
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "atsiliepimas";

include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "SELECT * FROM $lentele";
$city = '';

//Dadeti kiek kartu is kokio miesto atidare puslapi
if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);

$premission = false;
if(isset($_SESSION['ulevel'])){
    if(($_SESSION['ulevel'] == 9)){
        $premission = true;
    }
}

?>

<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Renginių administravimas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="include/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <table class="center">
        <tr>
            <td>
                <center><img src="include/top2.png" width="1047" height="200"></center>
            </td>
        </tr>
        <tr>
            <td>
                <?php

                if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
                {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                    // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']

                    inisession("part");   //   pavalom prisijungimo etapo kintamuosius
                    $_SESSION['prev'] = "index";

                    include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
                ?>

                    <div style="text-align: center;color:green">
                        <br><br>
						<a class="float-right btn text-white btn-danger" href="/irankiuNuoma/sukurtiAtsiliepima.php"> <i class="fa fa-heart"></i> Sukurti atsiliepimą </a>
                        <h1 style="color: #343a40"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  Atsiliepimai</h1>
                        <div class="container" >
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                ?>
                    <div class="card card-inner">
            	    <div class="card-body">
            	        <div class="row">
                    	    <div class="col-md-2">
                    	        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                    	        <p class="text-secondary text-center">  <?php echo  $row['data'] ?></p>
                    	    </div>
                    	    <div class="col-md-10">
                    	        <p><a href=""><strong>  <?php echo  $row['atsiliepimoKurejas'] ?></strong></a></p>
                    	        <p> <?php echo  $row['tekstas'] ?></p>
                    	        <p>
									<div style="text-align: right">
									<a target="_blank" href="http://twitter.com/share?text=Atsiliepimas: <?php echo $row['tekstas'];?>&url=http://localhost/irankiuNuoma/"> <img src="include/twitter.png" >
									</div>
									<br>
                                    
                    	            <a class="float-right btn btn-outline-primary ml-2" onclick="if(window.confirm('Ar tikrai istrinti?') == true){
										href='/irankiuNuoma/istrintiAtsiliepima.php?key=<?php echo $row['id']; ?>'
										}" role="button"><i class="fa fa-reply"></i> Ištrinti</a>
										
									<a class="float-right btn text-white btn-danger" href="/irankiuNuoma/redaguotiAtsiliepima.php?key=<?php echo $row['id']; ?>"> <i class="fa fa-heart"></i> Redaguoti</a>

                    	       </p>						
                    	    </div>
            	        </div>
            	    </div>
	            </div>
                                <?php
                                    // echo "<tr>
                                    // <td>".$row['id']."</td>
                                    // <td>".$row['Pavadinimas']."</td>
                                    // </tr>";
                                }

                                ?>


                        </div>
                        <br>
                    <?php
                } else {

                    if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes 
                    else {
                        if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
                    }
                    // jei ankstesnis puslapis perdavė $_SESSION['message']
                    echo "<div align=\"center\">";
                    echo "<font size=\"4\" color=\"#ff0000\">" . $_SESSION['message'] . "<br></font>";
                   
                    echo "<table class=\"center\"><tr><td>";
                   
                    include("include/login.php");                    // prisijungimo forma
                    echo "</td></tr></table></div><br>";
                }
                    ?>
</body>

</html>