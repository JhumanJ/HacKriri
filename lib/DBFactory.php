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

        $db = new PDO("sqlsrv:server = tcp:hackririsql.database.windows.net,1433; Database = HacKririSQL", "hackriri", "Romain96");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        return $db;
    }
}