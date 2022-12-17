<?php
session_start();

//include("include/nustatymai.php");
include("include/functions.php");

// if(($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL])){
// 	header("Location: logout.php");
// 	exit;
// }
if(($_SESSION['ulevel'] != 9)){
	header("Location: logout.php");
	exit;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Sistema</title>
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

<!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<div class="container" style="padding: 5%;">
    <h1 style="color: #343a40">Įvesti gamintoja</h1>
<form method='post' action='irasytiIranki.php'>
  <div class="form-row" >
    <div class="form-group col-md-12">
      <label for="inputEmail4">Renginio pavadinimas</label>
      <input type="text" name='pavadinimas' class="form-control" id="inputEmail4" placeholder="Renginys" required>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPassword4">Miestas</label>
      <input type="text" name='miestas' class="form-control" id="inputPassword4" placeholder="Kaunas" required>
    </div>
  
  <div class="form-group col-md-6">
    <label for="inputAddress">Adresas</label>
    <input type="text" name='adresas' class="form-control" id="inputAddress" placeholder="Studentų g. 50" required>
  </div>
  </div>
  <div class="form-row ">
  <div class="form-group col-md-6">
    <label for="inputAddress2">Renginio pradžios laikas</label>
    <input type="datetime-local" name='data_pradzia' class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" required>
  </div>
  <div class="form-group col-md-6">
      <label for="inputCity">Renginio pabaigos laikas</label>
      <input type="datetime-local" name='data_pabaiga' class="form-control" id="inputCity" required>
    </div>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Aprašymas</label>
    <textarea class="form-control" name='aprasymas' id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" name='ok' value='patvirtinti' class="btn btn-primary">Patvirtinti</button>
</form>
    </div>
<!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="container" style="padding: 5%;">
    <h1 style="color: #343a40">Įvesti modelį</h1>
<form method='post' action='irasytiIranki.php'>
  <div class="form-row" >
    <div class="form-group col-md-12">
      <label for="inputEmail4">Renginio pavadinimas</label>
      <input type="text" name='pavadinimas' class="form-control" id="inputEmail4" placeholder="Renginys" required>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPassword4">Miestas</label>
      <input type="text" name='miestas' class="form-control" id="inputPassword4" placeholder="Kaunas" required>
    </div>
  
  <div class="form-group col-md-6">
    <label for="inputAddress">Adresas</label>
    <input type="text" name='adresas' class="form-control" id="inputAddress" placeholder="Studentų g. 50" required>
  </div>
  </div>
  <div class="form-row ">
  <div class="form-group col-md-6">
    <label for="inputAddress2">Renginio pradžios laikas</label>
    <input type="datetime-local" name='data_pradzia' class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" required>
  </div>
  <div class="form-group col-md-6">
      <label for="inputCity">Renginio pabaigos laikas</label>
      <input type="datetime-local" name='data_pabaiga' class="form-control" id="inputCity" required>
    </div>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Aprašymas</label>
    <textarea class="form-control" name='aprasymas' id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" name='ok' value='patvirtinti' class="btn btn-primary">Patvirtinti</button>
</form>
    </div>
<!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
         
    <div class="container" style="padding: 5%;">
    <h1 style="color: #343a40">Įvesti Miestą</h1>
<form method='post' action='irasytiIranki.php'>
  <div class="form-row" >
    <div class="form-group col-md-12">
      <label for="inputEmail4">Renginio pavadinimas</label>
      <input type="text" name='pavadinimas' class="form-control" id="inputEmail4" placeholder="Renginys" required>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPassword4">Miestas</label>
      <input type="text" name='miestas' class="form-control" id="inputPassword4" placeholder="Kaunas" required>
    </div>
  
  <div class="form-group col-md-6">
    <label for="inputAddress">Adresas</label>
    <input type="text" name='adresas' class="form-control" id="inputAddress" placeholder="Studentų g. 50" required>
  </div>
  </div>
  <div class="form-row ">
  <div class="form-group col-md-6">
    <label for="inputAddress2">Renginio pradžios laikas</label>
    <input type="datetime-local" name='data_pradzia' class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" required>
  </div>
  <div class="form-group col-md-6">
      <label for="inputCity">Renginio pabaigos laikas</label>
      <input type="datetime-local" name='data_pabaiga' class="form-control" id="inputCity" required>
    </div>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Aprašymas</label>
    <textarea class="form-control" name='aprasymas' id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" name='ok' value='patvirtinti' class="btn btn-primary">Patvirtinti</button>
</form>
    </div>

<!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<div class="container" style="padding: 5%;">
    <h1 style="color: #343a40">Įvesti punkto darbuotoją</h1>
<form method='post' action='irasytiIranki.php'>
  <div class="form-row" >
    <div class="form-group col-md-12">
      <label for="inputEmail4">Renginio pavadinimas</label>
      <input type="text" name='pavadinimas' class="form-control" id="inputEmail4" placeholder="Renginys" required>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPassword4">Miestas</label>
      <input type="text" name='miestas' class="form-control" id="inputPassword4" placeholder="Kaunas" required>
    </div>
  
  <div class="form-group col-md-6">
    <label for="inputAddress">Adresas</label>
    <input type="text" name='adresas' class="form-control" id="inputAddress" placeholder="Studentų g. 50" required>
  </div>
  </div>
  <div class="form-row ">
  <div class="form-group col-md-6">
    <label for="inputAddress2">Renginio pradžios laikas</label>
    <input type="datetime-local" name='data_pradzia' class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" required>
  </div>
  <div class="form-group col-md-6">
      <label for="inputCity">Renginio pabaigos laikas</label>
      <input type="datetime-local" name='data_pabaiga' class="form-control" id="inputCity" required>
    </div>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Aprašymas</label>
    <textarea class="form-control" name='aprasymas' id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" name='ok' value='patvirtinti' class="btn btn-primary">Patvirtinti</button>
</form>
    </div>

  <!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
  <div class="container" style="padding: 5%;">
    <h1 style="color: #343a40">Įvesti atsiemimo punktą</h1>
<form method='post' action='irasytiIranki.php'>
  <div class="form-row" >
    <div class="form-group col-md-12">
      <label for="inputEmail4">Renginio pavadinimas</label>
      <input type="text" name='pavadinimas' class="form-control" id="inputEmail4" placeholder="Renginys" required>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPassword4">Miestas</label>
      <input type="text" name='miestas' class="form-control" id="inputPassword4" placeholder="Kaunas" required>
    </div>
  
  <div class="form-group col-md-6">
    <label for="inputAddress">Adresas</label>
    <input type="text" name='adresas' class="form-control" id="inputAddress" placeholder="Studentų g. 50" required>
  </div>
  </div>
  <div class="form-row ">
  <div class="form-group col-md-6">
    <label for="inputAddress2">Renginio pradžios laikas</label>
    <input type="datetime-local" name='data_pradzia' class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" required>
  </div>
  <div class="form-group col-md-6">
      <label for="inputCity">Renginio pabaigos laikas</label>
      <input type="datetime-local" name='data_pabaiga' class="form-control" id="inputCity" required>
    </div>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Aprašymas</label>
    <textarea class="form-control" name='aprasymas' id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" name='ok' value='patvirtinti' class="btn btn-primary">Patvirtinti</button>
</form>
    </div>
   <!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

   <div class="container" style="padding: 5%;">
    <h1 style="color: #343a40">Įvesti taisymo punktą</h1>
<form method='post' action='irasytiIranki.php'>
  <div class="form-row" >
    <div class="form-group col-md-12">
      <label for="inputEmail4">Renginio pavadinimas</label>
      <input type="text" name='pavadinimas' class="form-control" id="inputEmail4" placeholder="Renginys" required>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPassword4">Miestas</label>
      <input type="text" name='miestas' class="form-control" id="inputPassword4" placeholder="Kaunas" required>
    </div>
  
  <div class="form-group col-md-6">
    <label for="inputAddress">Adresas</label>
    <input type="text" name='adresas' class="form-control" id="inputAddress" placeholder="Studentų g. 50" required>
  </div>
  </div>
  <div class="form-row ">
  <div class="form-group col-md-6">
    <label for="inputAddress2">Renginio pradžios laikas</label>
    <input type="datetime-local" name='data_pradzia' class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" required>
  </div>
  <div class="form-group col-md-6">
      <label for="inputCity">Renginio pabaigos laikas</label>
      <input type="datetime-local" name='data_pabaiga' class="form-control" id="inputCity" required>
    </div>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Aprašymas</label>
    <textarea class="form-control" name='aprasymas' id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" name='ok' value='patvirtinti' class="btn btn-primary">Patvirtinti</button>
</form>
    </div>
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