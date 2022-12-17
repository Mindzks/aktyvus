<?php
session_start();
if (($_SESSION['ulevel'] != 9)) {
    header("Location: logout.php");
    exit;
}
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "irankis";
$lentele2 = "modelis";
$lentele3 = "gamintojas";

$value = $_GET['key'];

include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
echo $value;
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "SELECT * FROM uzsakymas WHERE id = $value";

if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
$row = $result->fetch_assoc()
?>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Užsakymo redagavimas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="include/styles.css" rel="stylesheet" type="text/css">
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

                if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
                {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                    // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']

                    inisession("part");   //   pavalom prisijungimo etapo kintamuosius
                    $_SESSION['prev'] = "index";

                    include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
                ?>
                    <div class="container" style="padding: 5%;">
                        <h1 style="color: #343a40">Redaguoti užsakymą</h1>
                        <form action=updateOrder.php method=post>
    
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Užsakymo pradžia</label>
                                    <input type="text" name="pradzia" value="<?php echo $row['pradzia'] ?>" class="form-control" id="inputPassword4" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Užsakymo pabaiga</label>
                                    <input type="text" name="pabaiga" value="<?php echo $row['pabaiga'] ?>" class="form-control" id="inputAddress" required>
                                </div>
                            </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <button type="submit" name="update" value="Submit" class="btn btn-primary">Patvirtinti</button>
                        </form>
                        <!-- <?php
                                //echo "<br><br><a href=\"index.php\"><b>Grįžti į meniu<b></a>";
                                ?> -->
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
                <!-- <form action=update.php method=post>
    <input type="text" name="Pavadinimas" value="<?php echo $row['Pavadinimas'] ?>">
    <input type="text" name="bukle" value="<?php echo $row['bukle'] ?>">
    <input type="datetime-local" name="tipas" value="<?php echo $row['tipas'] ?>">
    <input type="datetime-local" name="kalse" value="<?php echo $row['kalse'] ?>">
    <input type="text" name="kaina" value="<?php echo $row['kaina'] ?>">
    <textarea name='Aprasymas'><?php echo $row['Aprasymas'] ?></textarea>
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
    <a href="update.php"><input type="submit" name="update" value="Submit"></a>
</form> -->



</body>

</html>