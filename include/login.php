<?php 
// login.php - tai prisijungimo forma, index.php puslapio dalis 
// formos reikšmes tikrins proclogin.php. Esant klaidų pakartotinai rodant formą rodomos klaidos
// formos laukų reikšmės ir klaidų pranešimai grįžta per sesijos kintamuosius
// taip pat iš čia išeina priminti slaptažodžio.
// perėjimas į registraciją rodomas jei nustatyta $uregister kad galima pačiam registruotis

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
$_SESSION['prev'] = "login";
include("include/nustatymai.php");
?>
<div class="container">


<form action="proclogin.php" method="POST">
    <center style="font-size:18pt;"><b>Prisijungimas</b></center>
  <!-- Email input -->
  <div class="form-outline mb-4">
  <label class="form-label" for="form2Example1">Vartotojo vardas</label>
  <input class ="s1" name="user" type="text" id="form2Example1" class="form-control" value="<?php echo $_SESSION['name_login'];  ?>"/><br>
            <?php echo $_SESSION['name_error']; 
			?>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
  <label class="form-label" for="form2Example2">Slaptažodis</label>
  <input class ="s1" name="pass" type="password" id="form2Example2" class="form-control" value="<?php echo $_SESSION['pass_login']; ?>"/><br>
            <?php echo $_SESSION['pass_error']; 
			?>
  </div>

  <!-- 2 column grid layout for inline styling -->
  <!-- Submit button -->
  <button type="submit" name="login" value="Prisijungti" class="btn btn-primary btn-block mb-4">Prisijungti</button>
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <!-- Checkbox -->

        <?php
             echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"guest.php\">Svečias</a>";
             
        ?>
    </div>

    <div class="col">

      <!-- <input type="submit" name="problem" class="btn btn-primary btn-block mb-4" value="Pamiršote slaptažodį?"/>    -->
    </div>
  </div>
  <!-- Register buttons -->
  <div class="text-center">
    <p>Neregistruotas? 
        <?php
        if ($uregister != "admin") { echo "<a href=\"register.php\">Registracija</a>";}
        ?>
  </div>
<!-- </form>
</div>

		<form action="proclogin.php" method="POST" class="login">             
        <center style="font-size:18pt;"><b>Prisijungimas</b></center>
        <p style="text-align:left;">Vartotojo vardas:<br>
            <input class ="s1" name="user" type="text" value="<?php echo $_SESSION['name_login'];  ?>"/><br>
            <?php //echo $_SESSION['name_error']; 
			?>
        </p>
        <p style="text-align:left;">Slaptažodis:<br>
            <input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"/><br>
            <?php //echo $_SESSION['pass_error']; 
			?>
        </p>  
        <p style="text-align:left;">
            <input type="submit" name="login" value="Prisijungti"/>   
            <input type="submit" name="problem" value="Pamiršote slaptažodį?"/>   
        </p>
        <p>
 <?php
			//if ($uregister != "admin") { echo "<a href=\"register.php\">Registracija</a>";}
			//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"guest.php\">Svečias</a>";
?>
        </p>     
    </form> -->
	


