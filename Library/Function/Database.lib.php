<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 12:35
 */

/**
 * Fonction permettant la connexion à la base de donnée
 * @return PDO la base de donnée
 */
function connexionDb()
{
    $confDb = getConfigFile()['DATABASE'];

    $type = $confDb['type'];
    $host = $confDb['host'];
    $servername = "$type:host=$host";
    $username = $confDb['username'];
    $password = $confDb['password'];
    $dbname = $confDb['dbname'];

    $db = new PDO("$servername;dbname=$dbname", $username, $password);
    return $db;
}