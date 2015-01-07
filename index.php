<?php
//Sisällytetään mysql.php 
include_once ("mysql.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title> Test Page </title>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
<nav>
<?php 
  //Navigointivalikko
  eval('?>' . sqlGetContent(".menu"));
?>
<nav>
<div>
<?php 
  //Pääsisältö verkkosivulla. Hae oletuksena /home, jos ei ole olemassa niin näytä 404 sivu tietokannasta.
	$uri = substr($_SERVER['REQUEST_URI'], 1);
	if($uri == "") $uri = "home";
	$php = sqlGetContent($uri);
	if($php == null) {$php = sqlGetContent(".404"); header('HTTP/1.0 404 Not Found'); }
	eval('?>' . $php);
?>
</div>
<footer>
<?php 
  //Alapalkki
  eval('?>' . sqlGetContent(".footer"));
?>
</footer>
</body>
</html>
