<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 12:36
 */

/**
 * Fonction permettant la récupération du fichier de configuration
 * @return array associatif dont les clés, sont les sections
 */
function getConfigFile()
{
    return parse_ini_file("../config.ini.php", true);

}