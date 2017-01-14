<?php

/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14/01/16
 * Time: 21:10
 */
class DBFactory
{

    public static function getMysqlConnexionWithPDO(){
        //$db = new PDO('mysql:host=localhost;dbname=unisales','root', 'root');

        $db = new PDO('mysql:host=localhost;dbname=HacKriri','root', 'root');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $q = $db->prepare("CREATE TABLE IF NOT EXISTS `snippets` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `publishDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        $q->execute();
        $q = $db->prepare("CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `userType` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `imgURL` varchar(255) DEFAULT NULL,
  `homePageURL` varchar(255) DEFAULT NULL,
  `profileColour` varchar(6) DEFAULT NULL,
  `description` mediumtext,
  `passWord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        $q->execute();

        return $db;
    }
}