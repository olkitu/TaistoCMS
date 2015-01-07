Dokumentaatio
=========

Tässä on koko sisällönhallinnan dokumenttaatio.

index.php
=========

Upotetaan mysql.php tiedosto jossa on tietokantaan yhdistäminen scripti
```
<?php
//Sisällytetään mysql.php 
include_once ("mysql.php");
?>
```


Navigointivalikko
```
<?php 
  //Navigointivalikko
  eval('?>' . sqlGetContent(".menu"));
?>
```
Pääsivumme tietokannassamme $uri= home.
```
<?php 
  //Pääsisältö verkkosivulla. Hae oletuksena /home, jos ei ole olemassa niin näytä 404 sivu tietokannasta.
	$uri = substr($_SERVER['REQUEST_URI'], 1);
	if($uri == "") $uri = "home";
	$php = sqlGetContent($uri);
	if($php == null) {$php = sqlGetContent(".404"); header('HTTP/1.0 404 Not Found'); }
	eval('?>' . $php);
?>
```
Footerin jokaisen sivun pohjalle.
```
<?php 
  //Alapalkki
  eval('?>' . sqlGetContent(".footer"));
?>
```
