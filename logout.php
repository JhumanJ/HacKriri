<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 30/01/16
 * Time: 16:20
 */

    require("header.php");

    session_destroy();

    header("Location: index.php");