<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

session_start();
$server = "localhost";
$user = "root";
$password = "";
$dbname = "vartvald";
$lentele = "renginiai";

include("include/functions.php");

if ($_SESSION['user'] == "Svečias"){
    header("Location: logout.php");
	exit;
}

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "SELECT * FROM $lentele where Data_Pabaiga < date(now())";
$sql2 =  "SELECT * FROM $lentele where Data_Pabaiga > date(now()) AND Data_Pradzia < date(now())";

if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
if (!$result2= $conn->query($sql2)) die("Negaliu nuskaityti: " . $conn->error);
$premission = false;
if(($_SESSION['ulevel'] == 9)){
	$premission = true;
}
?>

<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Demo projektas</title>
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
                        <h1 style="color: #343a40">Pasibaigia renginiai</h1>
                        <div class="container">
                            <div class="row">
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="col-md-6 mt-3">
                                    <div class="card" style="background-color: #343a40; color: rgba(255,255,255,.5);">
                                        <div class="card-body">
                                            <h5 class="card-title" style="color: white;"><?php echo  $row['Pavadinimas'] ?></h5>
                                            <h6 class="card-subtitle mb-2 ">Miestas: <?php echo  $row['Miestas'] ?></h6>
                                            <h6 class="card-subtitle mb-2 ">Pradžia: <?php echo  $row['Data_Pradzia'] ?></h6>
                                            <h6 class="card-subtitle mb-2 ">Pabaiga: <?php echo  $row['Data_Pabaiga'] ?></h6>
                                            <h6 class="card-subtitle mb-2 "> Adresas: <?php echo  $row['Adresas'] ?></h6>
                                            <p class="card-text">Aprašymas: <?php echo  $row['Aprasymas'] ?></p>
                                            <?php
                                                if($premission){
                                            ?>  
                                                <a style="color: white;" href="/irankiuNuoma/redaguoti.php?key=<?php echo $row['id']; ?> "class="card-link">Redaguoti</a>
                                                <a style="color: white;" href="/irankiuNuoma/delete.php?key=<?php echo $row['id']; ?> "class="card-link">Ištrinti</a>
                                            <?php
                                                }
                                             ?>
                                            
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }

                                ?>
                            </div>
                        </div>
                        <h1 style="color: #343a40" >Vykstantis Renginiai</h1>
                        <div class="container">
                            <div class="row">
                                <?php
                                while ($row = $result2->fetch_assoc()) {
                                ?>
                                <div class="col-md-6 mt-3">
                                    <div class="card" style="background-color: #343a40; color: rgba(255,255,255,.5);">
                                        <div class="card-body">
                                            <h5 class="card-title" style="color: white;"><?php echo  $row['Pavadinimas'] ?></h5>
                                            <h6 class="card-subtitle mb-2">Miestas: <?php echo  $row['Miestas'] ?></h6>
                                            <h6 class="card-subtitle mb-2">Pradžia: <?php echo  $row['Data_Pradzia'] ?></h6>
                                            <h6 class="card-subtitle mb-2">Pabaiga: <?php echo  $row['Data_Pabaiga'] ?></h6>
                                            <h6 class="card-subtitle mb-2">Adresas: <?php echo  $row['Adresas'] ?></h6>
                                            <p class="card-text">Aprašymas: <?php echo  $row['Aprasymas'] ?></p>
                                            <?php
                                                if($premission){
                                            ?>  
                                                <a style="color: white;" href="/irankiuNuoma/redaguoti.php?key=<?php echo $row['id']; ?> "class="card-link">Redaguoti</a>
                                                <a style="color: white;" href="/irankiuNuoma/delete.php?key=<?php echo $row['id']; ?> "class="card-link">Ištrinti</a>
                                            <?php
                                                }
                                             ?>
                                            
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