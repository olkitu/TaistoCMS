--
-- Table structure for table `Website`
--
CREATE TABLE IF NOT EXISTS `website` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

INSERT INTO `website` (`id`, `name`, `content`) VALUES
(1, '.home', '<h1> Tervettuloa sivulle! </h1>'),
(3, '.menu', 'Valikko'),
(4, '.footer', '&copy; <?php echo date("Y") ?>  example.com '),
