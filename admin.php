<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL])) {
	header("Location: logout.php");
	exit;
}
$_SESSION['prev'] = "admin";
date_default_timezone_set("Europe/Vilnius");
?>

<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
	<title>Administratoriaus sąsaja</title>
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
		echo "<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">";

		echo "<div class=\"collapse navbar-collapse\" id=\"navbarText\">";
		echo  "<ul class=\"navbar-nav mr-auto\">";
		echo "<a class=\"nav-link\" href=\"index.php\">Pagrindinis</a>";
		echo "<a class=\"nav-link\" href=\"reviews.php\">Atsiliepimai</a>";

		?>
		<html>

		<li class="nav-item">
               <a class="nav-link"href="orderHistory.php">Užsakymų istorija</a>
            </li>
		<li class="nav-item">
			<a class="nav-link" href="profile.php">Mano paskyra</a>
		</li>
		<!-- <li class="nav-item">
			<a class="nav-link" href="useredit.php">Redaguoti paskyrą</a>
		</li> -->

		</html>
		<?php

		echo "<a class=\"nav-link\" href=\"ivestiIranki.php\">Pridėti įrankį</a>";
		echo "<a class=\"nav-link\" href=\"admin.php\">Administratoriaus sąsaja</a>";

		echo "<a class=\"nav-link\" href=\"logout.php\">Atsijungti</a>";
		echo "</ul>";
		echo "</div>";
		echo "</nav>";

		?>
			
	<center><b><?php echo $_SESSION['message']; ?></b></center>


	<form name="vartotojai" action="procadmin.php" method="post">
		<div class="container align-content-center">
		<table class="center" style=" width:100%; border:none;align-items:center;">

			<tr>
				<td width=30%>
					<?php
					if ($uregister != "self") echo "<a href=\"register.php\"><b>Registruoti naują vartotoją<b></a><td>";
					else echo "</td>";
					?>
			</tr>
		</table> <br>

		<?php

		$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		$sql = "SELECT username,userlevel,email,timestamp "
			. "FROM " . TBL_USERS . " ORDER BY userlevel DESC,username";
		$result = mysqli_query($db, $sql);
		if (!$result || (mysqli_num_rows($result) < 1)) {
			echo "Klaida skaitant lentelę users";
			exit;
		}
		?>
		<table class="center" border="1" cellspacing="0" cellpadding="3">
			<tr>
				<td><b>Vartotojo vardas</b></td>
				<td><b>Rolė</b></td>
				<td><b>E-paštas</b></td>
				<td><b>Paskutinį kartą aktyvus</b></td>
				<td><b>Šalinti?</b></td>
			</tr>
			<?php
			while ($row = mysqli_fetch_assoc($result)) {
				$level = $row['userlevel'];
				$user = $row['username'];
				$email = $row['email'];
				$time = date("Y-m-d G:i", strtotime($row['timestamp']));
				echo "<tr><td>" . $user . "</td><td>";
				echo "<select name=\"role_" . $user . "\">";
				$yra = false;
				foreach ($user_roles as $x => $x_value) {
					echo "<option ";
					if ($x_value == $level) {
						$yra = true;
						echo "selected ";
					}
					echo "value=\"" . $x_value . "\" ";
					echo ">" . $x . "</option>";
				}
				if (!$yra) {
					echo "<option selected value=" . $level . ">Neegzistuoja=" . $level . "</option>";
				}
				$UZBLOKUOTAS = UZBLOKUOTAS;
				echo "<option ";
				if ($level == UZBLOKUOTAS) echo "selected ";
				echo "value=" . $UZBLOKUOTAS . " ";
				echo ">Užblokuotas</option>";      // papildoma opcija
				echo "</select></td>";

				echo "<td>" . $email . "</td><td>" . $time . "</td>";
				echo "<td><input type=\"checkbox\" name=\"naikinti_" . $user . "\">";
			}
			?>
		</table>
		<br>
		<div class="row d-flex justify-content-center align-content-center">
		<input class="btn btn-primary" type="submit" value="Vykdyti">	
		</div> 
		
		</div>
	</form>
	</td>
		</tr>
	</table> <br>
</body>

</html>