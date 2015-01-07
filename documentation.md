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


Tulostetaan tietokannasta .menu navigointivalikko.
```
<?php 
  //Navigointivalikko
  eval('?>' . sqlGetContent(".menu"));
?>
```
Pääsivumme tietokannassamme $uri= home.

Tietokannassa tulostetaan $uri vastaava tulos. Jos $uri on "" eli / niin näytetään tietokannassa home sivu. Jos on null niin tulostetaan tietokannassa oleva .404 sivu (Not Found) ja lisätään header 404. 
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
Tulostetaan tietokannasta name .footer.
```
<?php 
  //Alapalkki
  eval('?>' . sqlGetContent(".footer"));
?>
```
mysql.php
===========

Funtio sql tehtävänä on yhdistää tietokanta palvelimeen localhost (127.0.0.1) tietokantaan "database" käyttäjätunnuksena "mysql" ja salasanalla "password". Jos tietokantaan ei saa yhteyttä niin näytetään virheilmoitus. Määritetään yhteyden merkistökoodaukseksi utf8.
```
<?php
function sql($sql){
  //Muodostetaan yhteys MySQL palvelimeen. 
	$con=mysqli_connect("127.0.0.1","mysql","password","database") or die ('ERROR! Cannot Connect Database');
	mysqli_query($con, "SET NAMES utf8");
	$result = mysqli_query($con, $sql);
	mysqli_close($con);
	
	return $result;
}
```
Funktio sqlGetContent tehtävänä on hakea tietokannan taulusta "website". 

$site = sivusi nimi, tietokannassa "name"

Funktion lopuksi palautetaan "content", eli sisältö
```
function sqlGetContent($site){
//Valitaan tietokantataulu.
	$result = sql("SELECT content FROM website WHERE name='" . $site . "'");
	
	$row = mysqli_fetch_array($result);
	return $row['content'];
}
?>
```

