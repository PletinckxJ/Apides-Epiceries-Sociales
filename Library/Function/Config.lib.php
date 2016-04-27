<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06-04-16
 * Time: 12:36
 */

/**
 * Fonction permettant la r�cup�ration du fichier de configuration
 * @return array associatif dont les cl�s, sont les sections
 */
function getConfigFile()
{
    if (file_exists("../config.ini.php")) {
        return parse_ini_file("../config.ini.php", true);
    } else {
        return parse_ini_file("../../config.ini.php", true);
    }

}