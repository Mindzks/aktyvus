<?php 
// useredit.php 
// vartotojas gali pasikeisti slaptažodį ar email
// formos reikšmes tikrins procuseredit.php. Esant klaidų pakartotinai rodant formą rodomos ir klaidos

session_start();
if ($_SESSION['user'] == "Svečias"){
    header("Location: logout.php");
	exit;
}
$tomp=$_SESSION['user'];
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "users";
$lentele2 = "lytis";
$lentele3 = "miestas";
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "SELECT * FROM $lentele WHERE username = '$tomp'";
if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
$row = $result->fetch_assoc();

//Paimti lytis

$sql =  "SELECT * FROM $lentele2";

if (!$result2 = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);

$sql =  "SELECT * FROM $lentele3";

if (!$result3 = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);

// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "procuseredit")  && ($_SESSION['prev'] != "useredit")))
{header("Location: logout.php");exit;
}
if ($_SESSION['prev'] == "index")								  
	{$_SESSION['mail_login'] = $_SESSION['umail'];
	$_SESSION['passn_error'] = "";      // papildomi kintamieji naujam password įsiminti
	$_SESSION['passn_login'] = ""; }  //visos kitos turetų būti tuščios
$_SESSION['prev'] = "useredit"; 
?>

 <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Registracija</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

            <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
            <link href="include/styles.css" rel="stylesheet" type="text/css" >
        </head>
        <body>  
      <table class="center" style="text-align:center;">
        <tr>
            <td>
                <center><img src="include/top2.png" width="1047" height="200"></center>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                    include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
                ?>
        <tr><td>
            <div class="container">
		<form action="procuseredit.php" method="POST" class="login">             
        <center style="font-size:18pt;"><b>Paskyros redagavimas</b></center><br>
		<center style="font-size:14pt;"><b>Vartotojas: <?php echo $_SESSION['user'];  ?></b></center>
        
        
        <p  style="text-align:left;">Dabartinis slaptažodis:<br>
            <input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"><br>
            <?php echo $_SESSION['pass_error']; ?>
        </p>
			
		<p style="text-align:left;">Naujas slaptažodis:<br>
            <input class ="s1" name="passn" type="password" value="<?php echo $_SESSION['passn_login']; ?>"><br>
            <?php echo $_SESSION['passn_error']; ?>
        </p>	
			
		<p style="text-align:left;">E-paštas:<br>
			<input class ="s1" name="email" type="text" value="<?php echo $_SESSION['mail_login']; ?>"><br>
			<?php echo $_SESSION['mail_error']; ?>
        </p> 
		
        <p style="text-align:left;">Vardas:<br>
			<input class ="s1" name="vardas" type="text"  value="<?php echo  $row['vardas']; ?>"><br>
        </p> 

        <p style="text-align:left;">Pavarde:<br>
			<input class ="s1" name="pavarde" type="text" value="<?php echo  $row['pavarde']; ?>"><br>
        </p> 
        
        <p style="text-align:left;">Lytis:<br>
        <select class="form-select" name="lytis" aria-label="Default select example">
        <?php
        while ($row2 = $result2->fetch_assoc()) {
        ?>
        <option
        <?php
        if($row['lytis'] ==  $row2['id']){ ?>selected<?php } ?>
        value=<?php echo  $row2['id'] ?>><?php echo  $row2['pavadinimas'] ?></option>
        <?php
        }
        ?>
        </select>
        <!-- <p style="text-align:left;">Lytis:<br>
			<input class ="s1" name="lytis" type="text" value="<?php echo  $row['lytis']; ?>"><br>
        </p>  -->
        <p style="text-align:left;">Telefonas:<br>
			<input class ="s1" name="tel" type="text" value="<?php echo  $row['telefonas']; ?>"><br>
        </p> 

        <p style="text-align:left;">Miestas:<br>
        <select class="form-select" name="miestas" aria-label="Default select example">
        <?php
        while ($row3 = $result3->fetch_assoc()) {
        ?>
        <option
        <?php
        if($row['miestas'] ==  $row3['id']){ ?>selected<?php } ?>
        value=<?php echo  $row3['id'] ?>><?php echo  $row3['pavadinimas'] ?></option>
        <?php
        }
        ?>
        </select>



        <p style="text-align:left;">Adresas:<br>
			<input class ="s1" name="adresas" type="text" value="<?php echo  $row['adresas']; ?>"><br>
        </p> 
        <p style="text-align:left;">Asmens kodas:<br>
			<input class ="s1" name="kodas" type="text" value="<?php echo  $row['asmens_kodas']; ?>"><br>
        </p> 


        <p style="text-align:left;">
            <input type="submit" name="login" class="btn btn-primary" value="Atnaujinti"/>     
        </p>  
        </form>
        </div>
        </td></tr>
	 </table>
  </div>
  </td></tr>
  <?php

            
     ?>

  
  <!-- </table>     -->

 </body>
</html>
	


