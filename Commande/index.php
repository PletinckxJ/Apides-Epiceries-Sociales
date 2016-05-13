<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13/05/2016
 * Time: 10:30
 */

include("../Library/Function/Require.lib.php");
include("../HTML/Head.php");
include("../HTML/Header.php");
?>

<?php

if (isConnect()) {
    include("../HTML/Commande/commandeContent.php");
} else {
    header("Location :../Deconnexion");
}

include "../HTML/Footer.php";
?>