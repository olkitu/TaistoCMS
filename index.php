<?php
//Include mysql.php file
include_once ("mysql.php");
?>
<html>
<head>
  <title> Test Page </title>
</head>
<body>
<?php 
  //Navigation bar
  eval('?>' . sqlGetContent(".menu"));
?>
<?php 
  //Content
	$uri = substr($_SERVER['REQUEST_URI'], 1);
	if($uri == "") $uri = "home";
	$php = sqlGetContent($uri);
	if($php == null) {$php = sqlGetContent(".404"); header('HTTP/1.0 404 Not Found'); }
	eval('?>' . $php);
?>
<?php 
  //Footer
		eval('?>' . sqlGetContent(".footer"));
?>
</body>
</html>
