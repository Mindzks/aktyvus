<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) {
   header("Location: logout.php");
   exit;
}
include("include/nustatymai.php");
$user = $_SESSION['user'];
$userlevel = $_SESSION['ulevel'];
$role = ""; {
   foreach ($user_roles as $x => $x_value) {
      if ($x_value == $userlevel) $role = $x;
   }
}


// echo "[<a href=\"index.php\">Pagrindinis</a>] &nbsp;&nbsp;";

// if ($_SESSION['user'] != "guest") {
//    echo "[<a href=\"priminimai.php\">Priminimai</a>] &nbsp;&nbsp;";
//    echo "[<a href=\"useredit.php\">Redaguoti paskyrą</a>] &nbsp;&nbsp;";
//    echo "[<a href=\"prisijungimai.php\">Prisijungimai</a>] &nbsp;&nbsp;";
// }
// //Trečia operacija tik rodoma pasirinktu kategoriju vartotojams, pvz.:
// // if (($userlevel == $user_roles["Dalyvis"]) || ($userlevel == $user_roles[ADMIN_LEVEL] )) {
// //     echo "[<a href=\"skaitau.php\">Žinutės</a>] &nbsp;&nbsp;";
// // 	}   
// //Administratoriaus sąsaja rodoma tik administratoriui
// if ($userlevel == $user_roles[ADMIN_LEVEL]) {
//    echo "[<a href=\"admin.php\">Administratoriaus sąsaja</a>] &nbsp;&nbsp;";
//    echo "[<a href=\"ivestiIranki.php\">ivestiIranki</a>] &nbsp;&nbsp;";
// }
// echo "[<a href=\"logout.php\">Atsijungti</a>]";


echo "<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">";

echo "<div class=\"collapse navbar-collapse\" id=\"navbarText\">";
echo  "<ul class=\"navbar-nav mr-auto\">";
echo "<a class=\"nav-link\" href=\"index.php\">Pagrindinis</a>";
echo "<a class=\"nav-link\" href=\"reviews.php\">Atsiliepimai</a>";
if ($_SESSION['user'] != "Svečias") {
?>
   <html>

            <li class="nav-item">
               <a class="nav-link"href="orderHistory.php">Užsakymų istorija</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="profile.php">Mano paskyra</a>
            </li>
            <!-- <li class="nav-item">
               <a class="nav-link"  href="useredit.php">Redaguoti paskyrą</a>
            </li> -->
            
   </html>
<?php
}
if ($userlevel == $user_roles[ADMIN_LEVEL]) {
   echo "<a class=\"nav-link\" href=\"ivestiIranki.php\">Pridėti įrankį</a>";
   echo "<a class=\"nav-link\" href=\"admin.php\">Administratoriaus sąsaja</a>";
}
echo "<a class=\"nav-link\" href=\"logout.php\">Atsijungti</a>";
echo "</ul>";
echo "</div>";
echo "</nav>";

echo "<table width=100% border=\"0\"  cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
echo "<tr><td >";
if ($_SESSION['user'] != "Svečias"){
echo "<span style='padding-left: 20px;'>Vartotojas: <b >" . $user . "</b>     Rolė: <b>" . $role . "</b></span> <br>";
}else{
   echo "<span style='padding-left: 20px;'>Rolė: <b >" . $user . "</b>";
}
echo "</td></tr><tr><td>";
echo "</td></tr></table>";
?>