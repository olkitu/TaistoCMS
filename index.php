<?php
//Sisällytetään mysql.php 
include_once ("mysql.php");
?>
<html>
<head>
  <title> Test Page </title>
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
  //Pääsisältö verkkosivulla
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
