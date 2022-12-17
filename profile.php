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
$lentele = "prisijungimai";

include("include/functions.php");
$tomp = $_SESSION['userid'];
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "users";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "SELECT * FROM $lentele WHERE userid = '$tomp'";
if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
$row = $result->fetch_assoc();

if ($_SESSION['user'] == "Svečias") {
  header("Location: logout.php");
  exit;
}

//Gauna lyti pagal FK
$lentele2 = "lytis";
$lytis_FK = $row['lytis'];
$sql = "SELECT * FROM $lentele2 WHERE id = '$lytis_FK'";
if (!$result2 = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
$row2 = $result2->fetch_assoc();
//----------------------------------------
//Gauti miesta pagal FK
$lentele3 = "miestas";
$miestas_FK = $row['miestas'];
$sql = "SELECT * FROM $lentele3 WHERE id = '$miestas_FK'";
if (!$result3 = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
$row3 = $result3->fetch_assoc();
//Gauti vartotojo uzsakymus
$lentele4 = "uzsakymas";
$sql = "SELECT * FROM $lentele4 WHERE zmogus_fk = '$tomp'";
if (!$result4 = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);


$turi_uzsakymu = false;
if (mysqli_num_rows($result4)) {
  $turi_uzsakymu = true;
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

          <div class="container py-5">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Pilnas vardas</p>
                    </div>
                    <div class="col-sm-9">
                      <p class=" mb-0"><?php echo  $row['vardas'];
                                        echo " ";
                                        echo $row['pavarde']; ?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">El. pastas</p>
                    </div>
                    <div class="col-sm-9">
                      <p class=" mb-0"><?php echo $row['email']; ?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Telefonas</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="mb-0"><?php echo $row['telefonas']; ?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Asmens kodas</p>
                    </div>
                    <div class="col-sm-9">
                      <p class=" mb-0"><?php echo $row['asmens_kodas']; ?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Miestas</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="mb-0"><?php echo $row3['pavadinimas']; ?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Adresas</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="mb-0"><?php echo $row['adresas']; ?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Lytis:</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="mb-0"><?php echo $row2['pavadinimas']; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <button type="button" onclick="location.href='/irankiuNuoma/useredit.php';" class="btn btn-primary">Redaguoti paskyra</button>
                <button type="button" onclick="location.href='/irankiuNuoma/deleteUser.php';" class="btn btn-primary">Istrinti paskyra</button> -->

            <a class="btn btn-info" href='/irankiuNuoma/useredit.php' role="button">Redaguoti paskyrą</a>
            <a class="btn btn-info" onclick="if(window.confirm('Ar tikrai istrinti?') == true){
                            href='/irankiuNuoma/deleteUser.php'
                            }" role="button">Ištrinti paskyrą</a>
          </div>
          <?php
          if ($turi_uzsakymu) {
          ?>
          <center><h1>Mano užsakymai</h1></center>
            <div class="container" style="padding-bottom: 5%">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Irankis</th>
                    <th scope="col">Atsiemimo punkto aresas</th>
                    <th scope="col">Atsiemimo laikas</th>
                    <th scope="col">PLanuojamas grąžinimo laikas</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                while ($row4 = $result4->fetch_assoc()) {
                  $i++;
                  //Iranki paiimti
                  $irankio_fk = $row4['irankis_fk'];
                  $lentele5 = "irankis";
                  $sql =  "SELECT * FROM $lentele5 WHERE id='$irankio_fk'";
                  if (!$result5 = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
                  $row5 = $result5->fetch_assoc();

                  //Atsiiemimo punktas
                  $punkto_fk = $row4['punktas_fk'];
                  $lentele6 = "atsiemimo_punktas";
                  $sql =  "SELECT * FROM $lentele6 WHERE id='$punkto_fk'";
                  if (!$result6 = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
                  $row6 = $result6->fetch_assoc()
                  ?>
                  <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $row5['pavadinimas']; ?></td>
                    <td><?php echo $row6['adresas']; ?></td>
                    <td><?php echo $row4['pradzia']; ?></td>
                    <td><?php echo $row4['pabaiga']; ?></td>
                    <td><a href="/irankiuNuoma/cancelOrder.php?key=<?php echo $row4['id']; ?> " class="btn btn-danger">Atšaukti</a></td>
                  </tr>
                  <?php
                }
                  ?>
                </tbody>
              </table>
            </div>

          <?php
          }else{
            ?>
            <center><h1>Užsakymų nėra</h1></center>
            <?php
          }
          ?>
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