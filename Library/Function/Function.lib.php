<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 13:23
 */

/**
 * Fonction servant � g�n�rer un code al�atoire servant au mot de passe oubli� ou � l'activation.
 * @return string : le code g�n�r�.
 */
function genererCode() {
    $characts    = 'abcdefghijklmnopqrstuvwxyz';
    $characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characts   .= '1234567890';
    $code_aleatoire      = '';

    for($i=0;$i < 6;$i++)    //10 est le nombre de caract�res
    {
        $code_aleatoire .= substr($characts,rand()%(strlen($characts)),1);
    }
    return $code_aleatoire;
}

?>