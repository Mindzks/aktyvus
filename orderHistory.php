<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

session_start();


if ($_SESSION['user'] == "Svečias"){
    header("Location: logout.php");
	exit;
}


$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "uzsakymas";
$lentele2 = "irankis";
$userid = $_SESSION['userid'];
include("include/functions.php");


$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "SELECT * FROM $lentele";

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
                        <h1 style="color: #343a40">Užsakymų istorija</h1>
                           
        
                        
                        <?php
                        if($premission==false){
                            ?>
                        
                        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Filtruoti užsakymus pagal kainą </h4>
                    </div>
                    <div class="card-body">

                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Nuo</label>
                                    <input type="text" name="start_price" value="<?php if(isset($_GET['start_price'])){echo $_GET['start_price']; }else{echo "0";} ?>" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Iki</label>
                                    <input type="text" name="end_price" value="<?php if(isset($_GET['end_price'])){echo $_GET['end_price']; }else{echo "0";} ?>" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Filtruoti</label> <br/>
                                    <button type="submit" class="btn btn-primary px-4">Filter</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

  

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Produktai</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <?php
                        
                         if(isset($_GET['start_price']) && isset($_GET['end_price']))
                        {
                            $startprice = $_GET['start_price'];
                            $endprice = $_GET['end_price'];
                            $query = "SELECT * 
	                        FROM uzsakymas as p 
		                    LEFT JOIN irankis as g on g.id = p.irankis_fk 
		                    LEFT JOIN users as u on u.userid = p.zmogus_fk 
                            WHERE u.userid = '".$_SESSION['userid']."'
                            AND 
                            (g.kaina BETWEEN $startprice AND $endprice)";
                        }
                        else
                        {
                            $query = "SELECT * 
	                        FROM uzsakymas as p 
		                    LEFT JOIN irankis as g on g.id = p.irankis_fk
		                    LEFT JOIN users as u on u.userid = p.zmogus_fk WHERE u.userid = '".$_SESSION['userid']."'";
                        }
                        

                        // $result = mysqli_query($db, $sql);
	                    // if (!$result || (mysqli_num_rows($result) < 1))  
			            //     {echo "Klaida skaitant lentelę products"; exit;}

                         $query_run = mysqli_query($conn, $query);
                         

                        if(mysqli_num_rows($query_run) > 0)
                        {

                            // $irankio_fk = $row['irankis_fk'];
                                    // $sql =  "SELECT * FROM $lentele2 WHERE id='$irankio_fk'";
                                    // if (!$result2 = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
                                    // $row2 = $result2->fetch_assoc()

                            foreach($query_run as $items)
                            {
                                  ?>
                                 <div class="col-md-4 mb-3">
                                 <div class="border p-2">
                                     <h5><?php echo $items['pavadinimas']; ?></h5>
                                    
                                     <h6>Buklė: <?php echo $items['bukle']; ?></h6>
                                     <h6>Kaina: <?php echo $items['kaina']; ?>€</h6>
                                     <h6>Įrankio sukūrimo data: <?php echo $items['sukurimo_data'];?></h6>
                                     <h6>Užsakymo pabaiga: <?php echo $items['pabaiga'];?></h6>

                                 
                                 <?php
                                  if ($userlevel == $user_roles[ADMIN_LEVEL]){
                                    echo "<a class=\"nav-link\" href=\"editOrder.php\">Redaguoti užsakymą</a>";
                                    echo "<a class=\"nav-link\" href=\"deleteOrder.php\">Ištrinti užsakymą</a>";
                                }
                                ?>
                                </div>
                                 </div>
                                
                                <?php
                            }
                        }
                         else
                         {
                            echo "No Record Found";
                         }
                        }else{
                            ?>

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">

                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Nuo</label>
                                    <input type="text" name="start_price" value="<?php if(isset($_GET['start_price'])){echo $_GET['start_price']; }else{echo "100";} ?>" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Iki</label>
                                    <input type="text" name="end_price" value="<?php if(isset($_GET['end_price'])){echo $_GET['end_price']; }else{echo "900";} ?>" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Filtruoti</label> <br/>
                                    <button type="submit" class="btn btn-primary px-4">Filter</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Užsakymai</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <?php  
                        if(isset($_GET['start_price']) && isset($_GET['end_price']))
                        {
                            $startprice = $_GET['start_price'];
                            $endprice = $_GET['end_price'];

                            $query = "SELECT * 
	                        FROM uzsakymas as p 
		                    LEFT JOIN irankis as g on g.id = p.irankis_fk 
		                    LEFT JOIN users as u on u.userid = p.zmogus_fk 
                            WHERE 
                            (g.kaina BETWEEN $startprice AND $endprice)";
                        }
                        else
                        {

                            $query = "SELECT p.id, p.pabaiga, g.kaina, g.bukle, g.sukurimo_data, g.pavadinimas
	                        FROM uzsakymas as p 
		                    LEFT JOIN irankis as g on g.id = p.irankis_fk 
		                    LEFT JOIN users as u on u.userid = p.zmogus_fk";
                        }
                        
                        $query_run = mysqli_query($conn, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            foreach($query_run as $items)
                            {
                                // 
                                ?>
                                 <div class="col-md-4 mb-3">
                                 <div class="border p-2">
                                     <h5><?php echo $items['pavadinimas']; ?></h5>
                                    
                                     <h6>Buklė: <?php echo $items['bukle']; ?></h6>
                                     <h6>Kaina: <?php echo $items['kaina']; ?>€</h6>
                                     <h6>Įrankio sukūrimo data: <?php echo $items['sukurimo_data'];?></h6>
                                     <h6>Užsakymo pabaiga: <?php echo $items['pabaiga'];?></h6>
                                     <a style="color: black;" href="editOrder.php?key=<?php echo $items['id']; ?> "class="card-link">Redaguoti</a>
                                     <a style="color: black;" href="deleteOrder.php?key=<?php echo $items['id']; ?> "class="card-link">Ištrinti</a>
                                </div>
                                 </div>
                                <?php
                            }
                        }
                        else
                        {
                            echo "No Record Found";
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

                            <?php
                        }


                        ?>


 

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    <?php
                } 
                    ?>
</body>

</html>