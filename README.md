Taisto-CMS-1.0
==============

Yksinkertainen ja helppokäyttöinen CMS.

Vaatimukset

* PHP
* MySQL Server
* Web Server

Esimerkki verkkosivu http://www.datatekniikka.fi

Asennus Apache2:

Sinun tulee sallia Apachen konfiguraatiosta .htaccess tiedosto

  /etc/apache2/sites-available/[sivusi_nimi]

  AllowOverride None -> AllowOverride All

Asennus Nginx:

  if (-f $request_filename) {
              expires 30d;
              break;
          }
          if (!-e $request_filename) {
              rewrite ^(.+)$ /index.php?q=$1 last;
          }
