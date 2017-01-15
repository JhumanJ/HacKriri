<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 15/01/17
 * Time: 18:55
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo 'start';

$db = new PDO("sqlsrv:server = tcp:hackririsql.database.windows.net,1433; Database = HacKririSQL", "hackriri", "Romain96");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("CREATE TABLE snippets (
  id int NOT NULL IDENTITY PRIMARY KEY,
  userId int NOT NULL,
  title varchar(255) NOT NULL,
  content text NOT NULL,
  publishDate datetime NOT NULL
);");

echo 'done ed';

//$db->exec("CREATE TABLE snippets (
//  id int NOT NULL IDENTITY PRIMARY KEY,
//  userId int NOT NULL,
//  title varchar(255) NOT NULL,
//  content text NOT NULL,
//  publishDate datetime NOT NULL
//);");