<?php
// procadmin.php  kai adminas keičia vartotojų įgaliojimus ir padaro atžymas lentelėje per admin.php
// ji suformuoja numatytų pakeitimų aiškią lentelę ir prašo patvirtinimo, toliau į procadmindb, kuri įrašys į DB

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "admin") && ($_SESSION['prev'] != "procadmin")))
{ header("Location: logout.php");exit;}

include("include/nustatymai.php");
include("include/functions.php");
$_SESSION['prev'] = "procadmin";

$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT username,userlevel,email,timestamp "
            . "FROM " . TBL_USERS . " ORDER BY userlevel DESC,username";
	$result = mysqli_query($db, $sql);
	if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę users"; exit;}
?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Administratoriaus sąsaja</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
	<table class="center" >
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

		?>
		<html>

		<li class="nav-item">
			<a class="nav-link" href="priminimai.php">Priminimai</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="prisijungimai.php">Prisijungimai</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="useredit.php">Redaguoti paskyrą</a>
		</li>

		</html>
		<?php

		echo "<a class=\"nav-link\" href=\"admin.php\">Administratoriaus sąsaja</a>";
		echo "<a class=\"nav-link\" href=\"ivestiIranki.php\">ivestiIranki</a>";

		echo "<a class=\"nav-link\" href=\"logout.php\">Atsijungti</a>";
		echo "</ul>";
		echo "</div>";
		echo "</nav>";

		?>
		<form name="vartotojai" action="procadmindb.php" method="post">
			<br>
		<a class="btn btn-primary" href="admin.php" role="button">Atgal</a>
	
		
    <table class="center" border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Vartotojo vardas</b></td><td><b>Buvusi rolė</b></td><td><b>Nauja rolė</b></td></tr>
<?php
		$naikpoz=false;   // ar bus naikinamu vartotoju
        while($row = mysqli_fetch_assoc($result)) 
	{	 
	    $level=$row['userlevel']; 
	  	$user= $row['username'];
		$nlevel=$_POST['role_'.$user];
		$naikinti=(isset($_POST['naikinti_'.$user]));
		if ($naikinti || ($nlevel != $level)) 
		{ 	$keisti[]=$user;                    // cia isiminti kuriuos keiciam, ka keiciam bus irasyta i $pakeitimai
      		echo "<tr><td>".$user. "</td><td>";    // rodyti sia eilute patvirtinimui
 			if ($level == UZBLOKUOTAS) echo "Užblokuotas";
			else
				{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $level) echo $x;}
				} 
			echo "</td><td>";
      		if ($naikinti)
			    {      echo "<font color=red>PAŠALINTI</color>";
				       $pakeitimai[]=-1; // ir isiminti  kad salinam
				       $naikpoz=true;
			} else 
				{      $pakeitimai[]=$nlevel;    // isiminti i kokia role
				if ($nlevel == UZBLOKUOTAS) echo "UŽBLOKUOTAS";
				else
					{foreach($user_roles as $x=>$x_value)
			      		{if ($x_value == $nlevel) echo $x;}
        			}
				}
				
				echo "</td></tr>";
		}
  }
  ?>
  <div style="text-align: center;">
  <?php
  if ($naikpoz) {echo "<br >Dėmesio! Bus šalinami tik įrašai iš lentelės 'users'.<br>";
  				 echo "Kitose lentelėse gali likti susietų įrašų.";
				}
			?>
			</div>
			<br>
			<?php
// pakeitimus irasysim i sesija 
	if (empty($keisti)){header("Location:index.php");exit;}  //nieko nekeicia
		
   $_SESSION['ka_keisti']=$keisti; $_SESSION['pakeitimai']=$pakeitimai;
?>
	  </table>
	  <br>
	  <div class="row d-flex justify-content-center align-content-center">
	  <input class="btn btn-primary" type="submit" value="Atlikti">
	  </div>
    </form>
			</table>
  </body></html>
