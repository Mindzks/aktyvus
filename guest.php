<?php
// guest.php
// nustato user="guest", userlevel=""

session_start(); 
// cia sesijos kontrole:
  if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "login"))
	{ header("Location: logout.php");exit;}
  $_SESSION['prev'] = "Svečias";
  $_SESSION['user'] = "Svečias";
  $_SESSION['ulevel'] ="";
header("Location:index.php");exit;
 