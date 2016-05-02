<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 02/05/2016
 * Time: 11:35
 */

include("../Library/Function/Require.lib.php");
include("../HTML/Head.php");
include("../HTML/Header.php");
?>

<?php

if (isConnect()) {
    include("../HTML/Compte/CompteContent.php");
} else {
    header("Location :../Deconnexion");
}

include "../HTML/Footer.php";
?>