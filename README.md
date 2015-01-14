<h1> TaistoCMS 1.0 </h1>


Yksinkertainen ja helppokäyttöinen sisällönhallintajärjestelmä (CMS)


<h2> Ominaisuudet </h2>

* Yksinkertaista muokata phpmyadminin avulla verkkosivuja
* Peruselementti saa nopeasti kasaan... yksi index.php tiedostossa kaikki sivuston elementit.
* Laajennattavuus

<h2> Vaatimukset </h2>


* PHP
* MySQL Server
* phpMyAdmin (suositus)
* Web Server

<h2> Webbipalvelimen ohjeet </h2>


Esimerkki verkkosivu http://www.datatekniikka.fi

Asennus Apache2:

Sinun tulee sallia Apachen konfiguraatiosta .htaccess tiedosto

  ```
  AllowOverride All
```
  

Lisää seuraava Nginx konfiguraatioon:
```
   if (!-e $request_filename) {
    rewrite ^(.+)$ /index.php?q=$1 last;
  }
  
```
<a href="http://helenius.dy.fi/taisto/Nginx"> Nginx ohje </a>

<a href="http://helenius.dy.fi/taisto/Apache2#.htaccess"> htaccess ohje</a>

<h2>Dokumentaatio </h2>


Tässä on koko sisällönhallinnan dokumenttaatio.

<h3>index.php</h3>


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
<h3> mysql.php </h3>


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
<h3> database.sql </h3>


Sinun tulee luoda ensin tietokanta nimellä "database"

```
CREATE DATABASE database;
```

Kopioi tämä mysql komentoriville. Tämä luo automaattisesti taulukon jossa on

id = Sivun numerointi järjestys
name = sivusi nimi ja verkko-osoitteen pääte. Rajoitettu 30 merkkiin.
content = sivusi sisältö. Ei merkistörajoituksia.

Lisää "Primary Key" tauluun "id".

Määrittää UTF8 merkistökoodauksen.
```
--
-- Table structure for table `website`
--
CREATE TABLE IF NOT EXISTS `website` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;
```


<h2> Lisenssi </h2>


Copyright 2015 datatekniikka.fi. Kaikki tämä materiaali on täysin muokattavissa avointa lähdekoodia. Otamme mielellämme palautetta tästä koodista ja sivusta. Parannusehdotukset kannattaa lähettää support@datatekniikka.fi tai jättää kommenttina.


