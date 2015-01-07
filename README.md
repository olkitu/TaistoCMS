TaistoCMS 1.0
==============

Yksinkertainen ja helppokäyttöinen sisällönhallintajärjestelmä (CMS)


Ominaisuudet
==============
* Yksinkertaista muokata phpmyadminin avulla verkkosivuja
* Peruselementti saa nopeasti kasaan... yksi index.php tiedostossa kaikki sivuston elementit.
* Laajennattavuus

Vaatimukset
==============

* PHP
* MySQL Server
* phpMyAdmin (suositus)
* Web Server

Webbipalvelimen ohjeet
==============

Esimerkki verkkosivu http://www.datatekniikka.fi

Asennus Apache2:

Sinun tulee sallia Apachen konfiguraatiosta .htaccess tiedosto

  ```
  AllowOverride All
```
  
Lisäohjeita: http://helenius.dy.fi/taisto/index.php/Apache2#.htaccess


Lisää seuraava Nginx konfiguraatioon:
```
   if (!-e $request_filename) {
    rewrite ^(.+)$ /index.php?q=$1 last;
  }
```

  
Lisenssi
==============  

Copyright 2015 datatekniikka.fi


