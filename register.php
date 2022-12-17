<?php
// register.php registracijos forma
// jei pats registruojasi rolė = DEFAULT_LEVEL, jei registruoja ADMIN_LEVEL vartotojas, rolę parenka
// Kaip atsiranda vartotojas: nustatymuose $uregister=
//                                         self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai galimi
// formos laukus tikrins procregister.php

session_start();
if (empty($_SESSION['prev'])) { header("Location: logout.php");exit;} // registracija galima kai nera userio arba adminas
// kitaip kai sesija expirinasi blogai, laikykim, kad prev vistik visada nustatoma
include("include/nustatymai.php");
include("include/functions.php");
if ($_SESSION['prev'] != "procregister")  inisession("part");  // pradinis bandymas registruoti

$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele2 = "miestas";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių


$_SESSION['prev']="register";
?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Registracija</title>
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

            <link href="include/styles.css" rel="stylesheet" type="text/css" >
        </head>
        <body>   
                    <table class="center"><tr><td><img src="include/top2.png" width="1047" height="200"></td></tr><tr><td> 
                        <table><tr><td>
						<a class="btn btn-primary" style="margin-left: 20%" href="index.php" role="button">Atgal</a>
                        </td></tr>
				    </table>   
								<div align="center">
								<div class="container">
                    			<table class="center"> <tr><td>
                                    <form action="procregister.php" method="POST">              
                                                <center style="font-size:18pt;"><b>Registracija</b></center>
										
									<label class="form-label" for="form2Example1">Vartotojo slapyvardis</label>
            						<input class ="s1" name="user" type="text" id="form2Example1" class="form-control" value="<?php echo $_SESSION['name_login'];  ?>"><br>
           							<?php echo $_SESSION['name_error']; ?>
        
       								<label class="form-label" for="form2Example1">Slpatažodis</label>
          							<input class ="s1" name="pass" type="password" id="form2Example1" class="form-control" value="<?php echo $_SESSION['pass_login']; ?>"><br>
            						<?php echo $_SESSION['pass_error']; ?>

									<label class="form-label" for="form2Example1">E-paštas:</label>
                                    <input class ="s1" name="email" type="text" id="form2Example1" class="form-control" value="<?php echo $_SESSION['mail_login']; ?>"><br>
									<?php echo $_SESSION['mail_error']; ?>


									<label class="form-label" for="form2Example1">Vardas:</label>
                                    <input class ="s1" name="vardas" type="text" id="form2Example1" class="form-control"><br>

									<label class="form-label" for="form2Example1">Pavardė:</label>
                                    <input class ="s1" name="pavarde" type="text" id="form2Example1" class="form-control"><br>

									</select>


									<label class="form-label" for="form2Example1">Telefonas:</label>
                                    <input class ="s1" name="tel" type="text" id="form2Example1" class="form-control"><br>
									
									</select>

									<label class="form-label" for="form2Example1">Adresas:</label>
                                    <input class ="s1" name="adresas" type="text" id="form2Example1" class="form-control"><br>

									<label class="form-label" for="form2Example1">Asmens kodas:</label>
                                    <input class ="s1" name="kodas" type="text" id="form2Example1" class="form-control"><br>


									<?php
										 if ($_SESSION['ulevel'] == $user_roles[ADMIN_LEVEL] )
										{echo "<p style=\"text-align:left;\">Rolė<br>";
										 echo "<select class='btn btn-primary btn-block' name=\"role\">";
   									   	 foreach($user_roles as $x=>$x_value)
  											{echo "<option ";
        	 									if ($x == DEFAULT_LEVEL) echo "selected ";
             									echo "value=\"".$x_value."\" ";
         	 									echo ">".$x."</option></p>";
											}
										}
									?>
                                    <p style="text-align:left;">
									<br><input type="submit" value="Registruoti" name="login" class="btn btn-primary btn-block" style="margin-left: 30px;" value="registruoti"/>
                                    </p>
                                    </form>
                                    </td></tr>
									
			                    </table>
								</div>
                            </div>
                </td></tr>
                </table>           
        </body>
    </html>
   
