# TaistoCMS 1.0


A simple and easy to use content management system (CMS)

## Features

* Simple to edit webpages using phpmyadmin
* Basic elements can be assembled qucikly, all elements in one index.php file
* Expandability

## Requirements


* PHP
* MySQL Server
* phpMyAdmin (recommended)
* Web Server

## Web Server instructions

Modifying the configuration file of Apache2:

You must allow the .htaccess file from Apache configuration
```apache
AllowOverride All
```


Add the following to your Nginx configuration:
```nginx
if (!-e $request_filename) {
  rewrite ^(.+)$ /index.php?q=$1 last;
}
```
[Nginx instructions (in Finnish)](http://taisto.org/Nginx)

[htaccess instructions (in Finnish)](http://taisto.org/Apache2#.htaccess)

## Documentation


Here is the entire documentation of content management.
### index.php


We embed the mysql.php file which cotains the script to connect to the database.
```php
<?php
//Sisällytetään mysql.php 
include_once ("mysql.php");
?>
```


We print the .menu navigation menu from the database.
```php
<?php 
  //Navigation menu
  eval('?>' . sqlGetContent(".menu"));
?>
```
Our main site in the our database $uri= home.
In the database we print the corresponding result for $uri. If $uri is "" then the database displays the home page. If $uri is null, then it shows the database's 404 page (Not Found) and it adds the header 404.

```php
<?php 
  //Main content on the webpage. By default it fetches /home , if it does not exist then it displays the 404 page from the database.
	$uri = substr($_SERVER['REQUEST_URI'], 1);
	if($uri == "") $uri = "home";
	$php = sqlGetContent($uri);
	if($php == null) {$php = sqlGetContent(".404"); header('HTTP/1.0 404 Not Found'); }
	eval('?>' . $php);
?>
```
Print name .footer from the database.
```php
<?php 
  //Footer
  eval('?>' . sqlGetContent(".footer"));
?>
```
### mysql.php

The task of the function sql is to connect the database to the server localhost (127.0.0.1). The database "database" username is "mysql" and password "password". If one can't connect to the database, then it displays an error message. We define the connection's character map to be UTF-8.
```php
<?php
function sql($sql){
  //Establish connection to the MySQL server.
	$con=mysqli_connect("127.0.0.1","mysql","password","database") or die ('ERROR! Cannot Connect Database');
	mysqli_query($con, "SET NAMES utf8");
	$result = mysqli_query($con, $sql);
	mysqli_close($con);
	
	return $result;
}
```
The task of function sqlGetContent is to fetch "website" from the database's table.

$site = your page's name, in the database it is "name".

In the end of the function we return "content", which is the content.
```php
function sqlGetContent($site){
// We select the database table.
	$result = sql("SELECT content FROM website WHERE name='" . $site . "'");
	
	$row = mysqli_fetch_array($result);
	return $row['content'];
}
?>
```

### database.sql


You must first create a database by the name "database".

```sql
CREATE DATABASE database;
```

Copy this to the mysql command line. This will automatically create a table which contains:

id = the numbering order of the page
name = the name of the page and the end of your request $uri. Limited to 30 characters.
content = the content of your page. No character limitation.

Add "Primary Key" to table "id".

This defines the UTF8 character map.
```sql
--
-- Table structure for table `website`
--
CREATE TABLE IF NOT EXISTS `website` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

INSERT INTO `website` (`id`, `name`, `content`) VALUES
(1, '.home', '<h1> Welcome to the page! </h1>'),
(3, '.menu', 'Menu'),
(4, '.footer', '&copy; <?php echo date("Y") ?>  example.com '),

```


## License

Copyright 2015 truong.fi / taisto.org. All of the content on this page is free software published under GNU GPL.
We are happy to receive feedback of the code and page. 


