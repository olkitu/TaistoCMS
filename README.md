TaistoCMS 1.0
==============

Yksinkertainen ja helppokäyttöinen CMS.


Ominaisuudet
==============
* Yksinkertaista muokata phpmyadminin avulla verkkosivuja
* Peruselementti saa nopeasti kasaan... yksi index.php tiedostossa kaikki sivuston elementit.
* Laajennattavuus

Vaatimukset
==============

* PHP
* MySQL Server
* phpMyAdmin
* Web Server

Webbipalvelimen ohjeet
==============

Esimerkki verkkosivu http://www.datatekniikka.fi

Asennus Apache2:

Sinun tulee sallia Apachen konfiguraatiosta .htaccess tiedosto

  /etc/apache2/sites-available/[sivusi_nimi]

  AllowOverride None -> AllowOverride All
  
Lisäohjeita: http://helenius.dy.fi/taisto/index.php/Apache2#.htaccess

Asennus Nginx:

   if (!-e $request_filename) {
    rewrite ^(.+)$ /index.php?q=$1 last;
  }
  
Lisenssi
==============  

Copyright 2015 datatekniikka.fi


